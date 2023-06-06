<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;

//Master Data
use App\Models\renstras;
use App\Models\renops;
use App\Models\kinerjaUnit;
use App\Models\buktiKinerja;
use App\Models\dokumenInduk;
use App\Models\pimpinans;
use App\Models\dokumenChecklist;
use App\Models\pengelolaUnitKerja;

//AMI
use App\Models\CAR;
use App\Models\jadwalAudit;
use App\Models\laporanAudit;

//Tinjauan Manajemen
use App\Models\hasilRapatTM;
use App\Models\bahanRapatTM;
use App\Models\tindakLanjutTM;
use App\Models\tinjauanManajemen;

//Second Model
use App\Models\User;
use App\Models\unitKerjas;

class chart extends Controller
{

    public function index()
    {
        //DATA
        $unitKerja = unitKerjas::get();
        $jadwalAudits = jadwalAudit::get();

        $renstra = renstras::count();
        $dokInduk = dokumenInduk::count();
        $dokChecklist = dokumenChecklist::count();
        $dokumen = [$dokInduk, $dokChecklist, $renstra];

        $unit = auth()->user()->unitkerja_id;
        
        $tahun = \Carbon\Carbon::now()->format('Y');
        
        if(auth()->user()->unitkerja_id == null && auth()->user()->role_id == "4" || auth()->user()->role_id == 1){
            $renop = renops::whereYear('created_at', '=', $tahun)->count();
            $kinerja = kinerjaUnit::whereYear('created_at', '=', $tahun)->count();
            $bukti = buktiKinerja::whereYear('created_at', '=', $tahun)->count();
            $renstraRenop = [$renop, $kinerja, $bukti];

            $jadwalAudit = jadwalAudit::whereYear('created_at', '=', $tahun)->count();
            $laporanAudit = laporanAudit::whereYear('created_at', '=', $tahun)->count();
            $CAR = CAR::whereYear('created_at', '=', $tahun)->count();
            $ami = [$jadwalAudit, $laporanAudit, $CAR];

            $jadwalTM = tinjauanManajemen::whereYear('created_at', '=', $tahun)->count();
            $laporanTM = hasilRapatTM::whereYear('created_at', '=', $tahun)->count();
            $bahanTM = bahanRapatTM::whereYear('created_at', '=', $tahun)->count();
            $tindakTM = tindakLanjutTM::whereYear('created_at', '=', $tahun)->count();
            $tm = [$jadwalTM, $bahanTM, $laporanTM, $tindakTM];
        }else{
            $renop = renops::where('unitkerja_id', $unit)->whereYear('created_at', '=', $tahun)->count();
            $kinerja = kinerjaUnit::where('unitkerja_id', $unit)->whereYear('created_at', '=', $tahun)->count();
            $bukti = buktiKinerja::where('unitkerja_id', $unit)->whereYear('created_at', '=', $tahun)->count();
            $renstraRenop = [$renop, $kinerja, $bukti];

            $jadwalAudit = jadwalAudit::where('unitkerja_id', $unit)->whereYear('created_at', '=', $tahun)->count();

            $getSelesai = laporanAudit::with('jadwalAudit')->whereYear('created_at', '=', $tahun)->get();
            $selesai = 0;
            foreach($getSelesai as $getSelesaih){
                if($getSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                    $selesai++;
                }
            }
            $laporanAudit = $selesai;

            $getAll = CAR::with('laporanAudit')->whereYear('created_at', '=', $tahun)->get();
            $all = 0;
            foreach($getAll as $getAllh){
                if($getAllh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                    $all++;
                }
            }
            $CAR = $all;
            $ami = [$jadwalAudit, $laporanAudit, $CAR];

            $getAll = tinjauanManajemen::with('jadwalAudit')->whereYear('created_at', '=', $tahun)->get();
            $all = 0;
            foreach($getAll as $getAllh){
                if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                    $all++;
                }
            }
            $jadwalTM = $all;

            $getAll = hasilRapatTM::with('tinjauanManajemen')->whereYear('created_at', '=', $tahun)->get();
            $all = 0;
            foreach($getAll as $getAllh){
                if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                    $all++;
                }
            }
            $laporanTM = $all;

            $getAll = bahanRapatTM::with('tinjauanManajemen')->whereYear('created_at', '=', $tahun)->get();
            $all = 0;
            foreach($getAll as $getAllh){
                if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                    $all++;
                }
            }
            $bahanTM = $all;

            $getAll = tindakLanjutTM::with('hasilRapatTM')->whereYear('created_at', '=', $tahun)->get();
            $all = 0;
            foreach($getAll as $getAllh){
                if($getAllh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                    $all++;
                }
            }
            $tindakTM = $all;
            $tm = [$jadwalTM, $bahanTM, $laporanTM, $tindakTM];
        }







        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $tahun = \Carbon\Carbon::now()->format('Y');
        for($bulan=1;$bulan < 13;$bulan++){
            $unit = auth()->user()->unitkerja_id;

            if(auth()->user()->unitkerja_id == null && auth()->user()->role_id == 4 || auth()->user()->role_id == 1){
                $alldokInd = collect(DB::SELECT("SELECT count(id) AS jumlah from dokumeninduk where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $dokIndukline[] = $alldokInd->jumlah;
    
                $alldokCheck = collect(DB::SELECT("SELECT count(id) AS jumlah from dokumencheklist where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $dokCheckline[] = $alldokCheck->jumlah;

                $allrens   = collect(DB::SELECT("SELECT count(id) AS jumlah from renstra where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $renstraline[] = $allrens->jumlah;

                $allrenp = collect(DB::SELECT("SELECT count(id) AS jumlah from renop where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $renopline[] = $allrenp->jumlah;

                $allkinerja = collect(DB::SELECT("SELECT count(id) AS jumlah from kinerja_unit where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $kinerjaline[] = $allkinerja->jumlah;
                
                $allbukti = collect(DB::SELECT("SELECT count(id) AS jumlah from bukti_kinerja where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $buktiline[] = $allbukti->jumlah;

                $alljadwalAudit = collect(DB::SELECT("SELECT count(id) AS jumlah from jadwal_audit where month(tglAudit)='$bulan' AND year(created_at)='$tahun'"))->first();
                $jadwalAuditline[] = $alljadwalAudit->jumlah;
                
                $alllaporanAudit = collect(DB::SELECT("SELECT count(id) AS jumlah from laporan_audit where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $laporanAuditline[] = $alllaporanAudit->jumlah;

                $allCAR = collect(DB::SELECT("SELECT count(id) AS jumlah from car where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $CARline[] = $allCAR->jumlah;

                $alljadwalTM = collect(DB::SELECT("SELECT count(id) AS jumlah from tinjauan_manajemen where month(tglTM)='$bulan' AND year(created_at)='$tahun'"))->first();
                $jadwalTMline[] = $alljadwalTM->jumlah;
                
                $allbahanTM = collect(DB::SELECT("SELECT count(id) AS jumlah from bahan_rapattm where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $bahanTMline[] = $allbahanTM->jumlah;

                $allhasilTM = collect(DB::SELECT("SELECT count(id) AS jumlah from hasil_rapattm where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $hasilTMline[] = $allhasilTM->jumlah;

                $alltindakTM = collect(DB::SELECT("SELECT count(id) AS jumlah from tindak_lanjuttm where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
                $tindakTMline[] = $alltindakTM->jumlah;
            }else{
                $dokIndukline[] = 0;
                $dokCheckline[] = 0;
                $renstraline[]  = 0;

                $allrenp = collect(DB::SELECT("SELECT count(id) AS jumlah from renop where month(created_at)='$bulan' AND unitkerja_id='$unit' AND year(created_at)='$tahun'"))->first();
                $renopline[] = $allrenp->jumlah;

                $allkinerja = collect(DB::SELECT("SELECT count(id) AS jumlah from kinerja_unit where month(created_at)='$bulan' AND unitkerja_id='$unit' AND year(created_at)='$tahun'"))->first();
                $kinerjaline[] = $allkinerja->jumlah;

                $allbukti = collect(DB::SELECT("SELECT count(id) AS jumlah from bukti_kinerja where month(created_at)='$bulan' AND unitkerja_id='$unit' AND year(created_at)='$tahun'"))->first();
                $buktiline[] = $allbukti->jumlah;

                $alljadwalAudit = collect(DB::SELECT("SELECT count(id) AS jumlah from jadwal_audit where month(tglAudit)='$bulan' AND unitkerja_id='$unit' AND year(created_at)='$tahun'"))->first();
                $jadwalAuditline[] = $alljadwalAudit->jumlah;

                $getSelesai = laporanAudit::with('jadwalAudit')->whereMonth('created_at', $bulan)->whereYear('created_at', '=', $tahun)->get();
                $selesai = 0;
                foreach($getSelesai as $getSelesaih){
                    if($getSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $selesai++;
                    }
                }
                $laporanAuditline[] = $selesai;

                $getAll = CAR::with('laporanAudit')->whereMonth('created_at', $bulan)->whereYear('created_at', '=', $tahun)->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $CARline[] = $all;

                $getAll = tinjauanManajemen::with('jadwalAudit')->whereMonth('tglTM', $bulan)->whereYear('created_at', '=', $tahun)->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $jadwalTMline[] = $all;

                $getAll = bahanRapatTM::with('tinjauanManajemen')->whereMonth('created_at', $bulan)->whereYear('created_at', '=', $tahun)->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $bahanTMline[] = $all;

                $getAll = hasilRapatTM::with('tinjauanManajemen')->whereMonth('created_at', $bulan)->whereYear('created_at', '=', $tahun)->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $hasilTMline[] = $all;

                $getAll = tindakLanjutTM::with('hasilRapatTM')->whereMonth('created_at', $bulan)->whereYear('created_at', '=', $tahun)->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $tindakTMline[] = $all;
            }
        }

        return view('menu.chart.index', compact('unitKerja', 'jadwalAudits', 'dokIndukline', 'dokCheckline', 'renstraline', 'renopline', 'kinerjaline', 'buktiline', 'jadwalAuditline', 'laporanAuditline', 'CARline', 'jadwalTMline', 'bahanTMline', 'hasilTMline', 'tindakTMline', 'dokumen', 'renstraRenop', 'ami', 'tm', 'label', 'renstra', 'renop'));
    }

    public function create()
    {
        //DATA
        $unitKerja = unitKerjas::get();
        $jadwalAudits = jadwalAudit::get();

        // return view('menu.chart.periode', compact('unitKerja', 'jadwalAudits', 'renstraline', 'renopline', 'kinerjaline', 'buktiline', 'dokumen', 'renstraRenop', 'ami', 'tm', 'label', 'renstra', 'renop'));
        return view('menu.chart.periode', compact('unitKerja', 'jadwalAudits'));
    }

    //DOKUMEN INDUK
    public function chartDateTimeDokumenIndukget(Request $request)
    {
        // dd($request);
        try{
            if(auth()->user()->unitkerja_id == null && auth()->user()->role_id == "4" || auth()->user()->role_id == 1){
                $getAktif = dokumenInduk::whereBetween('tahun_aktif', array($request->mulai, $request->selesai))->whereBetween('tahun_selesai', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->status == "aktif"){
                        $aktif++;
                    }
                }
                $getNonAktif = dokumenInduk::whereBetween('tahun_selesai', array($request->mulai, $request->selesai))->whereBetween('tahun_selesai', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->status == "nonaktif"){
                        $nonaktif++;
                    }
                }
                $getAll = dokumenInduk::whereBetween('tahun_aktif', array($request->mulai, $request->selesai))->whereBetween('tahun_selesai', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    $all++;
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartDateTimeDokumenInduk')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function chartStatusDokumenIndukget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                if(auth()->user()->role_id == "4" && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $aktif = dokumenInduk::where('status', $request->name)->count();
                    $data0 = [$aktif,null];
                    $data1 = null;
                }

                return view('menu.chart.chartStatusDokumenInduk')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $nonaktif = dokumenInduk::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null,$nonaktif];
                }else{

                }

                return view('menu.chart.chartStatusDokumenInduk')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function dokumenIndukread(Request $request)
    {
        try{
            
            if(auth()->user()->role_id == "4" && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                $aktif = dokumenInduk::where('status', 'aktif')->count();
                $nonaktif = dokumenInduk::where('status', 'nonaktif')->count();
                $all = dokumenInduk::count();
                // $faqs = [$aktif, $nonaktif];
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartDokumenIndukread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    //DOKUMEN CHECKLIST
    public function chartUnitKerjaDokumenChecklistget(Request $request)
    {
        try{
            if(auth()->user()->role_id == "4" && auth()->user()->unitkerja_id != null){
                $getAktif = dokumenChecklist::where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = dokumenChecklist::where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = dokumenChecklist::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = dokumenChecklist::where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->unitkerja_id == $request->name){
                        $aktif++;
                    }
                }
                $getNonAktif = dokumenChecklist::where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->unitkerja_id == $request->name){
                        $nonaktif++;
                    }
                }
                $getAll = dokumenChecklist::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->unitkerja_id == $request->name){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartUnitKerjaDokumenChecklist')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartDateTimeDokumenChecklistget(Request $request)
    {
        // dd($request);
        try{
            if(auth()->user()->role_id == "4" && auth()->user()->unitkerja_id != null){
                $getAktif = dokumenChecklist::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getAktifh->status == "aktif"){
                            $aktif++;
                        }
                    }
                }
                $getNonAktif = dokumenChecklist::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getNonAktifh->status == "nonaktif"){
                            $nonaktif++;
                        }
                    }
                }
                $getAll = dokumenChecklist::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = dokumenChecklist::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->status == "aktif"){
                        $aktif++;
                    }
                }
                $getNonAktif = dokumenChecklist::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->status == "nonaktif"){
                        $nonaktif++;
                    }
                }
                $getAll = dokumenChecklist::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    $all++;
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartDateTimeDokumenChecklist')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusDokumenChecklistget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                if(auth()->user()->role_id == "4" && auth()->user()->unitkerja_id != null){
                    $getAktif = dokumenChecklist::where('status', $request->name)->get();
                    $aktif = 0;
                    foreach($getAktif as $getAktifh){
                        if($getAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                            $aktif++;
                        }
                    }
                    $data0 = [$aktif, null];
                    $data1 = null;
                }else{
                    $aktif = dokumenChecklist::where('status', $request->name)->count();
                    $data0 = [$aktif, null];
                    $data1 = null;
                }

                return view('menu.chart.chartStatusDokumenChecklist')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getNonAktif = dokumenChecklist::where('status', $request->name)->get();
                    $nonaktif = 0;
                    foreach($getNonAktif as $getNonAktifh){
                        if($getNonAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                            $nonaktif++;
                        }
                    }
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }else{
                    $nonaktif = dokumenChecklist::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }

                return view('menu.chart.chartStatusDokumenChecklist')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function dokumenChecklistread(Request $request)
    {
        try{

            if(auth()->user()->role_id == "4" && auth()->user()->unitkerja_id != null){
                $aktif = dokumenChecklist::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'status' => 'aktif'
                        ])->count();
                $nonaktif = dokumenChecklist::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'status' => 'nonaktif'
                        ])->count();
                $all = dokumenChecklist::where('unitkerja_id',auth()->user()->unitkerja_id)->count();
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $aktif = dokumenChecklist::where('status', 'aktif')->count();
                $nonaktif = dokumenChecklist::where('status', 'nonaktif')->count();
                $all = dokumenChecklist::count();
                // $faqs = [$aktif, $nonaktif];
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
                // dd($faqs);
            }

            return view('menu.chart.chartDokumenChecklistread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    //DOKUMEN ACUAN
    public function chartJenisDokumenAcuanget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                $aktif = renstras::where([
                                'jenis' => $request->name,
                                'status' => 'aktif'
                        ])->count();
                $nonaktif = renstras::where([
                                'jenis' => $request->name,
                                'status' => 'nonaktif'
                        ])->count();
                $all = renstras::where('jenis', $request->name)->count();
                // $faqs = [$aktif, $nonaktif];
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
                // dd($faqs);
            }

            return view('menu.chart.chartJenisDokumenAcuan')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartDateTimeDokumenAcuanget(Request $request)
    {
        // dd($request);
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                $getAktif = renstras::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->status == "aktif"){
                        $aktif++;
                    }
                }
                $getNonAktif = renstras::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->status == "nonaktif"){
                        $nonaktif++;
                    }
                }
                $getAll = renstras::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    $all++;
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartDateTimeDokumenAcuan')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusDokumenAcuanget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                $aktif = renstras::where('status', $request->name)->count();
                $data0 = [$aktif, null];
                $data1 = null;

                return view('menu.chart.chartStatusDokumenAcuan')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                $nonaktif = renstras::where('status', $request->name)->count();
                $data0 = null;
                $data1 = [null, $nonaktif];

                return view('menu.chart.chartStatusDokumenAcuan')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function dokumenAcuanread(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                $aktif = renstras::where('status', 'aktif')->count();
                $nonaktif = renstras::where('status', 'nonaktif')->count();
                $all = renstras::count();
                // $faqs = [$aktif, $nonaktif];
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
                // dd($faqs);
            }

            return view('menu.chart.chartDokumenAcuanread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    //RENOP
    public function chartUnitKerjaRenopget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = renops::where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = renops::where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = renops::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = renops::where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->unitkerja_id == $request->name){
                        $aktif++;
                    }
                }
                $getNonAktif = renops::where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->unitkerja_id == $request->name){
                        $nonaktif++;
                    }
                }
                $getAll = renops::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->unitkerja_id == $request->name){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartUnitKerjaRenop')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartDateTimeRenopget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = renops::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getAktifh->status == "aktif"){
                            $aktif++;
                        }
                    }
                }
                $getNonAktif = renops::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getNonAktifh->status == "nonaktif"){
                            $nonaktif++;
                        }
                    }
                }
                $getAll = renops::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = renops::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->status == "aktif"){
                        $aktif++;
                    }
                }
                $getNonAktif = renops::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->status == "nonaktif"){
                        $nonaktif++;
                    }
                }
                $getAll = renops::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    $all++;
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartDateTimeRenop')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusRenopget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getAktif = renops::where('status', $request->name)->get();
                    $aktif = 0;
                    foreach($getAktif as $getAktifh){
                        if($getAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                            $aktif++;
                        }
                    }
                    $data0 = [$aktif, null];
                    $data1 = null;
                }else{
                    $aktif = renops::where('status', $request->name)->count();
                    $data0 = [$aktif, null];
                    $data1 = null;
                }

                return view('menu.chart.chartStatusRenop')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getNonAktif = renops::where('status', $request->name)->get();
                    $nonaktif = 0;
                    foreach($getNonAktif as $getNonAktifh){
                        if($getNonAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                            $nonaktif++;
                        }
                    }
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }else{
                    $nonaktif = renops::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }

                return view('menu.chart.chartStatusRenop')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function Renopread(Request $request)
    {
        try{

            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $aktif = renops::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'status' => 'aktif'
                        ])->count();
                $nonaktif = renops::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'status' => 'nonaktif'
                        ])->count();
                $all = renops::where('unitkerja_id',auth()->user()->unitkerja_id)->count();
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $aktif = renops::where('status', 'aktif')->count();
                $nonaktif = renops::where('status', 'nonaktif')->count();
                $all = renops::count();
                // $faqs = [$aktif, $nonaktif];
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
                // dd($faqs);
            }

            return view('menu.chart.chartRenopread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    //KINERJA UNIT
    public function chartUnitKerjaKinerjaUnitget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = kinerjaUnit::with('renops')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = kinerjaUnit::with('renops')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = kinerjaUnit::with('renops')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = kinerjaUnit::with('renops')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->renops->unitkerja_id == $request->name){
                        $aktif++;
                    }
                }
                $getNonAktif = kinerjaUnit::with('renops')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->renops->unitkerja_id == $request->name){
                        $nonaktif++;
                    }
                }
                $getAll = kinerjaUnit::with('renops')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->renops->unitkerja_id == $request->name){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartUnitKerjaKinerjaUnit')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartDateTimeKinerjaUnitget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = kinerjaUnit::with('renops')->whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getTerbaikh->status == "aktif"){
                            $aktif++;
                        }
                    }
                }
                $getNonAktif = kinerjaUnit::with('renops')->whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getTerjelekh->status == "nonaktif"){
                            $nonaktif++;
                        }
                    }
                }
                $getAll = kinerjaUnit::with('renops')->whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = kinerjaUnit::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->status == "aktif"){
                        $aktif++;
                    }
                }
                $getNonAktif = kinerjaUnit::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->status == "nonaktif"){
                        $nonaktif++;
                    }
                }
                $getAll = kinerjaUnit::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    $all++;
                }

                $faqs = [$all,null,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartDateTimeKinerjaUnit')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusKinerjaUnitget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getAktif = kinerjaUnit::with('renops')->where('status', $request->name)->get();
                    $aktif = 0;
                    foreach($getAktif as $getAktifh){
                        if($getAktifh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                            $aktif++;
                        }
                    }
                    $data0 = [$aktif, null];
                    $data1 = null;
                }else{
                    $aktif = kinerjaUnit::where('status', $request->name)->count();
                    $data0 = [$aktif, null];
                    $data1 = null;
                }

                return view('menu.chart.chartStatusKinerjaUnit')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getNonAktif = kinerjaUnit::with('renops')->where('status', $request->name)->get();
                    $nonaktif = 0;
                    foreach($getNonAktif as $getNonAktifh){
                        if($getNonAktifh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                            $nonaktif++;
                        }
                    }
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }else{
                    $nonaktif = kinerjaUnit::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }

                return view('menu.chart.chartStatusKinerjaUnit')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function kinerjaUnitread(Request $request)
    {
        try{

            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = kinerjaUnit::with('renops')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = kinerjaUnit::with('renops')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = kinerjaUnit::with('renops')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->renops->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $aktif = kinerjaUnit::where('status', 'aktif')->count();
                $nonaktif = kinerjaUnit::where('status', 'nonaktif')->count();
                $all = kinerjaUnit::count();
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartKinerjaUnitread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    //BUKTI KINERJA UNIT
    public function chartUnitKerjaBuktiKinerjaget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = buktiKinerja::where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = buktiKinerja::where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = buktiKinerja::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = buktiKinerja::where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->unitkerja_id == $request->name){
                        $aktif++;
                    }
                }
                $getNonAktif = buktiKinerja::where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->unitkerja_id == $request->name){
                        $nonaktif++;
                    }
                }
                $getAll = buktiKinerja::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->unitkerja_id == $request->name){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartUnitKerjaBuktiKinerja')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartDateTimeBuktiKinerjaget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = buktiKinerja::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getAktifh->status == "aktif"){
                            $aktif++;
                        }
                    }
                }
                $getNonAktif = buktiKinerja::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getNonAktifh->status == "nonaktif"){
                            $nonaktif++;
                        }
                    }
                }
                $getAll = buktiKinerja::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = buktiKinerja::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->status == "aktif"){
                        $aktif++;
                    }
                }
                $getNonAktif = buktiKinerja::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->status == "nonaktif"){
                        $nonaktif++;
                    }
                }
                $getAll = buktiKinerja::whereBetween('tahun', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    $all++;
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartDateTimeBuktiKinerja')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusBuktiKinerjaget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getAktif = buktiKinerja::where('status', $request->name)->get();
                    $aktif = 0;
                    foreach($getAktif as $getAktifh){
                        if($getAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                            $aktif++;
                        }
                    }
                    $data0 = [$aktif, null];
                    $data1 = null;
                }else{
                    $aktif = buktiKinerja::where('status', $request->name)->count();
                    $data0 = [$aktif, null];
                    $data1 = null;
                }

                return view('menu.chart.chartStatusBuktiKinerja')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getNonAktif = buktiKinerja::where('status', $request->name)->get();
                    $nonaktif = 0;
                    foreach($getNonAktif as $getNonAktifh){
                        if($getNonAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                            $nonaktif++;
                        }
                    }
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }else{
                    $nonaktif = buktiKinerja::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }

                return view('menu.chart.chartStatusBuktiKinerja')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function buktiKinerjaread(Request $request)
    {
        try{

            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = buktiKinerja::where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = buktiKinerja::where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = buktiKinerja::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $aktif = buktiKinerja::where('status', 'aktif')->count();
                $nonaktif = buktiKinerja::where('status', 'nonaktif')->count();
                $all = buktiKinerja::count();
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartBuktiKinerjaread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    //AMI
    public function AMIread(Request $request)
    {
        try{
            $year2 = \Carbon\Carbon::now()->format('Y')-1;
            $year3 = \Carbon\Carbon::now()->format('Y')-2;
            $year4 = \Carbon\Carbon::now()->format('Y')-3;
            $year5 = \Carbon\Carbon::now()->format('Y')-4;
            $yearnow = \Carbon\Carbon::now()->format('Y');
            $label = [$year5, $year4, $year3, $year2, $yearnow];

            for($bulan=$year5;$bulan <=$yearnow; $bulan++){
            $unit = auth()->user()->unitkerja_id;
                if(auth()->user()->role_id == "4" && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $linesesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                // ->select('car.id as jumlah')
                                ->where('car.hasilPemeriksaan', "sesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.created_at',$bulan)
                                // ->whereNotBetween('car.created_at', [$yearold, $yearnow])
                                ->count('car.id');
                                // ->first();
                    $Sesuailine[] = $linesesuai;
                    
                    $linenonsesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                // ->select('car.id as jumlah')
                                ->where('car.hasilPemeriksaan', "nonsesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.created_at',$bulan)
                                // ->whereNotBetween('car.created_at', [$yearold, $yearnow])
                                ->count('car.id');
                                // ->first();
                    $NonSesuailine[] = $linenonsesuai;

                    $sesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('car.hasilPemeriksaan', "sesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $nonsesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('car.hasilPemeriksaan', "nonsesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $open = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('car.status', "open")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $process = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('car.status', "process")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $data0 = $sesuai;
                    $data1 = $nonsesuai;
                    $data2 = $open;
                    $data3 = $process;
        
                }else{
                    $linesesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                // ->select('car.id as jumlah')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.hasilPemeriksaan', "sesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.created_at',$bulan)
                                // ->whereNotBetween('car.created_at', [$yearold, $yearnow])
                                ->count('car.id');
                                // ->first();
                    $Sesuailine[] = $linesesuai;
                    
                    $linenonsesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                // ->select('car.id as jumlah')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.hasilPemeriksaan', "nonsesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.created_at',$bulan)
                                // ->whereNotBetween('car.created_at', [$yearold, $yearnow])
                                ->count('car.id');
                                // ->first();
                    $NonSesuailine[] = $linenonsesuai;

                    $sesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.hasilPemeriksaan', "sesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $nonsesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.hasilPemeriksaan', "nonsesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $open = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.status', "open")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $process = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.status', "process")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $data0 = $sesuai;
                    $data1 = $nonsesuai;
                    $data2 = $open;
                    $data3 = $process;
                }
            }
            

            return view('menu.chart.chartAMIread')
            ->with([
                'data_Sesuai' => $data0,
                'data_NonSesuai' => $data1,
                'data_Open' => $data2,
                'data_Process' => $data3,
                'Sesuailine' => $Sesuailine,
                'NonSesuailine' => $NonSesuailine,
                'label' => $label,
                'yearnow' => $yearnow,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartUKAMIget(Request $request)
    {
        try{
            $year2 = \Carbon\Carbon::now()->format('Y')-1;
            $year3 = \Carbon\Carbon::now()->format('Y')-2;
            $year4 = \Carbon\Carbon::now()->format('Y')-3;
            $year5 = \Carbon\Carbon::now()->format('Y')-4;
            $yearnow = \Carbon\Carbon::now()->format('Y');
            $label = [$year5, $year4, $year3, $year2, $yearnow];

            for($bulan=$year5;$bulan <=$yearnow; $bulan++){
            $unit = auth()->user()->unitkerja_id;
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $linesesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                // ->select('car.id as jumlah')
                                ->where('jadwal_audit.unitkerja_id', $request->name)
                                ->where('car.hasilPemeriksaan', "sesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.created_at',$bulan)
                                // ->whereNotBetween('car.created_at', [$yearold, $yearnow])
                                ->count('car.id');
                                // ->first();
                    $Sesuailine[] = $linesesuai;
                    
                    $linenonsesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                // ->select('car.id as jumlah')
                                ->where('jadwal_audit.unitkerja_id', $request->name)
                                ->where('car.hasilPemeriksaan', "nonsesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.created_at',$bulan)
                                // ->whereNotBetween('car.created_at', [$yearold, $yearnow])
                                ->count('car.id');
                                // ->first();
                    $NonSesuailine[] = $linenonsesuai;

                    $sesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $request->name)
                                ->where('car.hasilPemeriksaan', "sesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $nonsesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $request->name)
                                ->where('car.hasilPemeriksaan', "nonsesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $open = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $request->name)
                                ->where('car.status', "open")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $process = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $request->name)
                                ->where('car.status', "process")
                                ->whereYear('car.updated_at', date('Y'))
                                ->count();
                                // ->distinct()->count('laporan_audit.id');
                    $data0 = $sesuai;
                    $data1 = $nonsesuai;
                    $data2 = $open;
                    $data3 = $process;
                }
            }

            return view('menu.chart.chartUKAMI')
            ->with([
                'data_Sesuai' => $data0,
                'data_NonSesuai' => $data1,
                'data_Open' => $data2,
                'data_Process' => $data3,
                'Sesuailine' => $Sesuailine,
                'NonSesuailine' => $NonSesuailine,
                'label' => $label,
                'yearnow' => $yearnow,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function chartDateTimeAMIget(Request $request)
    {
        try{
            for($bulan=$request->mulai;$bulan <=$request->selesai; $bulan++){
            $unit = auth()->user()->unitkerja_id;
            $label[] = $bulan;
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $linesesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                // ->select('car.id as jumlah')
                                ->where('car.hasilPemeriksaan', "sesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.created_at',$bulan)
                                // ->whereNotBetween('car.created_at', [$yearold, $yearnow])
                                ->count('car.id');
                                // ->first();
                    $Sesuailine[] = $linesesuai;
                    
                    $linenonsesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                // ->select('car.id as jumlah')
                                ->where('car.hasilPemeriksaan', "nonsesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.created_at',$bulan)
                                // ->whereNotBetween('car.created_at', [$yearold, $yearnow])
                                ->count('car.id');
                                // ->first();
                    $NonSesuailine[] = $linenonsesuai;
                }else{
                    $linesesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                // ->select('car.id as jumlah')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.hasilPemeriksaan', "sesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.created_at',$bulan)
                                // ->whereNotBetween('car.created_at', [$yearold, $yearnow])
                                ->count('car.id');
                                // ->first();
                    $Sesuailine[] = $linesesuai;
                    
                    $linenonsesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                // ->select('car.id as jumlah')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.hasilPemeriksaan', "nonsesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.created_at',$bulan)
                                // ->whereNotBetween('car.created_at', [$yearold, $yearnow])
                                ->count('car.id');
                                // ->first();
                    $NonSesuailine[] = $linenonsesuai;
                }
            }

            return view('menu.chart.chartDateTimeAMI')
            ->with([
                'Sesuailine' => $Sesuailine,
                'NonSesuailine' => $NonSesuailine,
                'label' => $label,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartSelectAMISesuaiget(Request $request)
    {
        try{
            $unit = auth()->user()->unitkerja_id;
            $unitKerja = unitKerjas::get();
            $users = User::get();
            $NonSesuai = [];
            $Open = [];
            $Process = [];
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $Sesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('car.hasilPemeriksaan', "sesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.updated_at', date('Y'))
                                ->get();
                }else{
                    $Sesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.hasilPemeriksaan', "sesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.updated_at', date('Y'))
                                ->get();
                }

            return view('menu.chart.dataAMI', compact('Sesuai', 'NonSesuai', 'Open', 'Process', 'unitKerja', 'users'));

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartSelectAMINonSesuaiget(Request $request)
    {
        try{
            $unit = auth()->user()->unitkerja_id;
            $unitKerja = unitKerjas::get();
            $users = User::get();
            $Sesuai = [];
            $Open = [];
            $Process = [];
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $NonSesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('car.hasilPemeriksaan', "nonsesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.updated_at', date('Y'))
                                ->get();
                }else{
                    $NonSesuai = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.hasilPemeriksaan', "nonsesuai")
                                ->where('car.status', "closed")
                                ->whereYear('car.updated_at', date('Y'))
                                ->get();
                }
            
            return view('menu.chart.dataAMI', compact('Sesuai', 'NonSesuai', 'Open', 'Process', 'unitKerja', 'users'));

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartSelectAMIOpenget(Request $request)
    {
        try{
            $unit = auth()->user()->unitkerja_id;
            $unitKerja = unitKerjas::get();
            $users = User::get();
            $Sesuai = [];
            $NonSesuai = [];
            $Process = [];
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $Open = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('car.status', "open")
                                ->whereYear('car.updated_at', date('Y'))
                                ->get();
                }else{
                    $Open = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.status', "open")
                                ->whereYear('car.updated_at', date('Y'))
                                ->get();
                }
            
            return view('menu.chart.dataAMI', compact('Sesuai', 'NonSesuai', 'Open', 'Process', 'unitKerja', 'users'));

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartSelectAMIProcessget(Request $request)
    {
        try{
            $unit = auth()->user()->unitkerja_id;
            $unitKerja = unitKerjas::get();
            $users = User::get();
            $Sesuai = [];
            $NonSesuai = [];
            $Open = [];
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $Process = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('car.status', "process")
                                ->whereYear('car.updated_at', date('Y'))
                                ->get();
                }else{
                    $Process = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('car.status', "process")
                                ->whereYear('car.updated_at', date('Y'))
                                ->get();
                }
            
            return view('menu.chart.dataAMI', compact('Sesuai', 'NonSesuai', 'Open', 'Process', 'unitKerja', 'users'));

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    //TM
    public function TMread(Request $request)
    {
        try{
            $year2 = \Carbon\Carbon::now()->format('Y')-1;
            $year3 = \Carbon\Carbon::now()->format('Y')-2;
            $year4 = \Carbon\Carbon::now()->format('Y')-3;
            $year5 = \Carbon\Carbon::now()->format('Y')-4;
            $yearnow = \Carbon\Carbon::now()->format('Y');
            $label = [$year5, $year4, $year3, $year2, $yearnow];

            for($bulan=$year5;$bulan <=$yearnow; $bulan++){
            $unit = auth()->user()->unitkerja_id;
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $lineselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "selesai")
                                ->whereYear('tindak_lanjuttm.created_at',$bulan)
                                ->count('tindak_lanjuttm.id');
                    $Selesailine[] = $lineselesai;
                    
                    $linenonselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "nonselesai")
                                ->whereYear('tindak_lanjuttm.created_at',$bulan)
                                ->count('tindak_lanjuttm.id');
                    $NonSelesailine[] = $linenonselesai;

                    $selesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "selesai")
                                ->whereYear('tindak_lanjuttm.updated_at', date('Y'))
                                ->count();
                    $nonselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "nonselesai")
                                ->whereYear('tindak_lanjuttm.updated_at', date('Y'))
                                ->count();
                    $data0 = $selesai;
                    $data1 = $nonselesai;
        
                }else{
                    $lineselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "selesai")
                                ->whereYear('tindak_lanjuttm.created_at',$bulan)
                                ->count('tindak_lanjuttm.id');
                    $Selesailine[] = $lineselesai;
                    
                    $linenonselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "nonselesai")
                                ->whereYear('tindak_lanjuttm.created_at',$bulan)
                                ->count('tindak_lanjuttm.id');
                    $NonSelesailine[] = $linenonselesai;

                    $selesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "selesai")
                                ->whereYear('tindak_lanjuttm.updated_at', date('Y'))
                                ->count();
                    $nonselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "nonselesai")
                                ->whereYear('tindak_lanjuttm.updated_at', date('Y'))
                                ->count();
                    $data0 = $selesai;
                    $data1 = $nonselesai;
                }
            }
            

            return view('menu.chart.chartTMread')
            ->with([
                'data_Selesai' => $data0,
                'data_NonSelesai' => $data1,
                'Selesailine' => $Selesailine,
                'NonSelesailine' => $NonSelesailine,
                'label' => $label,
                'yearnow' => $yearnow,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartUKTMget(Request $request)
    {
        try{
            $year2 = \Carbon\Carbon::now()->format('Y')-1;
            $year3 = \Carbon\Carbon::now()->format('Y')-2;
            $year4 = \Carbon\Carbon::now()->format('Y')-3;
            $year5 = \Carbon\Carbon::now()->format('Y')-4;
            $yearnow = \Carbon\Carbon::now()->format('Y');
            $label = [$year5, $year4, $year3, $year2, $yearnow];

            for($bulan=$year5;$bulan <=$yearnow; $bulan++){
            $unit = auth()->user()->unitkerja_id;
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $lineselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $request->name)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "selesai")
                                ->whereYear('tindak_lanjuttm.created_at',$bulan)
                                ->count('tindak_lanjuttm.id');
                    $Selesailine[] = $lineselesai;
                    
                    $linenonselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $request->name)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "nonselesai")
                                ->whereYear('tindak_lanjuttm.created_at',$bulan)
                                ->count('tindak_lanjuttm.id');
                    $NonSelesailine[] = $linenonselesai;

                    $selesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $request->name)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "selesai")
                                ->whereYear('tindak_lanjuttm.updated_at', date('Y'))
                                ->count();
                    $nonselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $request->name)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "nonselesai")
                                ->whereYear('tindak_lanjuttm.updated_at', date('Y'))
                                ->count();
                    $data0 = $selesai;
                    $data1 = $nonselesai;
                }
                
            }

            return view('menu.chart.chartUKTM')
            ->with([
                'data_Selesai' => $data0,
                'data_NonSelesai' => $data1,
                'Selesailine' => $Selesailine,
                'NonSelesailine' => $NonSelesailine,
                'label' => $label,
                'yearnow' => $yearnow,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartDateTimeTMget(Request $request)
    {
        try{
            for($bulan=$request->mulai;$bulan <=$request->selesai; $bulan++){
            $unit = auth()->user()->unitkerja_id;
            $label[] = $bulan;
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $lineselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "selesai")
                                ->whereYear('tindak_lanjuttm.created_at',$bulan)
                                ->count('tindak_lanjuttm.id');
                    $Selesailine[] = $lineselesai;
                    
                    $linenonselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "nonselesai")
                                ->whereYear('tindak_lanjuttm.created_at',$bulan)
                                ->count('tindak_lanjuttm.id');
                    $NonSelesailine[] = $linenonselesai;
                }else{
                    $lineselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "selesai")
                                ->whereYear('tindak_lanjuttm.created_at',$bulan)
                                ->count('tindak_lanjuttm.id');
                    $Selesailine[] = $lineselesai;
                    
                    $linenonselesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "nonselesai")
                                ->whereYear('tindak_lanjuttm.created_at',$bulan)
                                ->count('tindak_lanjuttm.id');
                    $NonSelesailine[] = $linenonselesai;
                }
            }

            return view('menu.chart.chartDateTimeTM')
            ->with([
                'Selesailine' => $Selesailine,
                'NonSelesailine' => $NonSelesailine,
                'label' => $label,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartSelectTMSelesaiget(Request $request)
    {
        try{
            $unit = auth()->user()->unitkerja_id;
            $unitKerja = unitKerjas::get();
            $users = User::get();
            $NonSelesai = [];
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $Selesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "selesai")
                                ->whereYear('tindak_lanjuttm.updated_at', date('Y'))
                                ->get();
                }else{
                    $Selesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "selesai")
                                ->whereYear('tindak_lanjuttm.updated_at', date('Y'))
                                ->get();
                }
            return view('menu.chart.dataTM', compact('Selesai', 'NonSelesai', 'unitKerja', 'users'));

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartSelectTMNonSelesaiget(Request $request)
    {
        try{
            $unit = auth()->user()->unitkerja_id;
            $unitKerja = unitKerjas::get();
            $users = User::get();
            $Selesai = [];
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id == null || auth()->user()->role_id == 1){
                    $NonSelesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "nonselesai")
                                ->whereYear('tindak_lanjuttm.updated_at', date('Y'))
                                ->get();
                }else{
                    $NonSelesai = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->where('jadwal_audit.unitkerja_id', $unit)
                                ->where('tinjauan_manajemen.status', "aktif")
                                ->where('hasil_rapattm.status', "aktif")
                                ->where('tindak_lanjuttm.status', "nonselesai")
                                ->whereYear('tindak_lanjuttm.updated_at', date('Y'))
                                ->get();
                }

            return view('menu.chart.dataTM', compact('Selesai', 'NonSelesai', 'unitKerja', 'users'));

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    //JADWAL AUDIT
    public function chartUnitKerjaJadwalAuditget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $aktif = jadwalAudit::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'status' => 'aktif'
                        ])->count();
                $nonaktif = jadwalAudit::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'status' => 'nonaktif'
                        ])->count();
                $all = jadwalAudit::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id
                        ])->count();
                // $faqs = [$aktif, $nonaktif];
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $aktif = jadwalAudit::where([
                                'unitkerja_id' => $request->name,
                                'status' => 'aktif'
                        ])->count();
                $nonaktif = jadwalAudit::where([
                                'unitkerja_id' => $request->name,
                                'status' => 'nonaktif'
                        ])->count();
                $all = jadwalAudit::where([
                                'unitkerja_id' => $request->name
                        ])->count();
                // $faqs = [$aktif, $nonaktif];
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartUnitKerjaJadwalAudit')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartJadwalAuditget(Request $request)
    {
        try{
            $pisah = explode( ',', $request->name);
            
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $aktif = jadwalAudit::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'periode' => $pisah[0],
                                'tahun' => $pisah[1],
                                'status' => 'aktif'
                        ])->count();
                $nonaktif = jadwalAudit::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'periode' => $pisah[0],
                                'tahun' => $pisah[1],
                                'status' => 'nonaktif'
                        ])->count();
                $all = jadwalAudit::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'periode' => $pisah[0],
                                'tahun' => $pisah[1],
                        ])->count();
                // $faqs = [$aktif, $nonaktif];
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
                // dd($faqs);
            }else{
                $aktif = jadwalAudit::where([
                                'periode' => $pisah[0],
                                'tahun' => $pisah[1],
                                'status' => 'aktif'
                        ])->count();
                $nonaktif = jadwalAudit::where([
                                'periode' => $pisah[0],
                                'tahun' => $pisah[1],
                                'status' => 'nonaktif'
                        ])->count();
                $all = jadwalAudit::where([
                                'periode' => $pisah[0],
                                'tahun' => $pisah[1],
                        ])->count();
                // $faqs = [$aktif, $nonaktif];
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
                // dd($faqs);
            }

            return view('menu.chart.chartJadwalAudit')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusJadwalAuditget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $aktif = jadwalAudit::where([
                                    'unitkerja_id' => auth()->user()->unitkerja_id,
                                    'status' => $request->name
                            ])->count();
                    $data0 = [$aktif,null];
                    $data1 = null;
                }else{
                    $aktif = jadwalAudit::where('status', $request->name)->count();
                    $data0 = [$aktif,null];
                    $data1 = null;
                    // dd($faqs);
                }

                return view('menu.chart.chartStatusJadwalAudit')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $nonaktif = jadwalAudit::where([
                                    'unitkerja_id' => auth()->user()->unitkerja_id,
                                    'status' => $request->name
                            ])->count();
                    $data0 = null;
                    $data1 = [null,$nonaktif];
                }else{
                    $nonaktif = jadwalAudit::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null,$nonaktif];
                }

                return view('menu.chart.chartStatusJadwalAudit')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function jadwalAuditread(Request $request)
    {
        try{
            
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $aktif = jadwalAudit::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'status' => 'aktif'
                        ])->count();
                $nonaktif = jadwalAudit::where([
                                'unitkerja_id' => auth()->user()->unitkerja_id,
                                'status' => 'nonaktif'
                        ])->count();
                $all = jadwalAudit::where('unitkerja_id',auth()->user()->unitkerja_id)->count();
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $aktif = jadwalAudit::where('status', 'aktif')->count();
                $nonaktif = jadwalAudit::where('status', 'nonaktif')->count();
                $all = jadwalAudit::count();
                // $faqs = [$aktif, $nonaktif];
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
                // dd($faqs);
            }

            return view('menu.chart.chartJadwalAuditread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }


    //LAPORAN AUDIT
    public function chartUnitKerjaLaporanAuditget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                // $getSelesai = laporanAudit::with('jadwalAudit')->where('status', 'selesai')->get();
                // $selesai = 0;
                // foreach($getSelesai as $getSelesaih){
                //     if($getSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                //         $selesai++;
                //     }
                // }
                // $getNonSelesai = laporanAudit::with('jadwalAudit')->where('status', 'nonselesai')->get();
                // $nonselesai = 0;
                // foreach($getNonSelesai as $getNonSelesaih){
                //     if($getNonSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                //         $nonselesai++;
                //     }
                // }
                $getAll = laporanAudit::with('jadwalAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                
                $faqs = [$all];
                // $faqs = [$all,null,null];
                // $data0 = [null,$selesai,null];
                // $data1 = [null,null,$nonselesai];
            }else{
                // $getSelesai = laporanAudit::with('jadwalAudit')->where('status', 'selesai')->get();
                // $selesai = 0;
                // foreach($getSelesai as $getSelesaih){
                //     if($getSelesaih->jadwalAudit->unitkerja_id == $request->name){
                //         $selesai++;
                //     }
                // }
                // $getNonSelesai = laporanAudit::with('jadwalAudit')->where('status', 'nonselesai')->get();
                // $nonselesai = 0;
                // foreach($getNonSelesai as $getNonSelesaih){
                //     if($getNonSelesaih->jadwalAudit->unitkerja_id == $request->name){
                //         $nonselesai++;
                //     }
                // }
                $getAll = laporanAudit::with('jadwalAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == $request->name){
                        $all++;
                    }
                }
                
                $faqs = [$all];
                // $faqs = [$all,null,null];
                // $data0 = [null,$selesai,null];
                // $data1 = [null,null,$nonselesai];
            }

            return view('menu.chart.chartUnitKerjaLaporanAudit')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                // 'data_Selesai' => $data0,
                // 'data_NonSelesai' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStandarLaporanAuditget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                // $getSelesai = laporanAudit::with('jadwalAudit')->where('status', 'selesai')->get();
                // $selesai = 0;
                // foreach($getSelesai as $getSelesaih){
                //     if($getSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                //         $tes = explode('.', $getSelesaih->standar);
                //         if($tes[0] == $request->name){
                //             $selesai++;
                //         }
                //     }
                // }
                // $getNonSelesai = laporanAudit::with('jadwalAudit')->where('status', 'nonselesai')->get();
                // $nonselesai = 0;
                // foreach($getNonSelesai as $getNonSelesaih){
                //     if($getNonSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                //         $tes = explode('.', $getNonSelesaih->standar);
                //         if($tes[0] == $request->name){
                //             $nonselesai++;
                //         }
                //     }
                // }
                $getAll = laporanAudit::with('jadwalAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $tes = explode('.', $getAllh->standar);
                        if($tes[0] == $request->name){
                            $all++;
                        }
                    }
                }
                
                $faqs = [$all];
                // $faqs = [$all,null,null];
                // $data0 = [null,$selesai,null];
                // $data1 = [null,null,$nonselesai];
            }else{
                // $getSelesai = laporanAudit::where('status', 'selesai')->get();
                // $selesai = 0;
                // foreach($getSelesai as $getSelesaih){
                //     $tes = explode('.', $getSelesaih->standar);
                //     if($tes[0] == $request->name){
                //         $selesai++;
                //     }
                // }
                // $getNonSelesai = laporanAudit::where('status', 'nonselesai')->get();
                // $nonselesai = 0;
                // foreach($getNonSelesai as $getNonSelesaih){
                //     $tes = explode('.', $getNonSelesaih->standar);
                //     if($tes[0] == $request->name){
                //         $nonselesai++;
                //     }
                // }
                $getAll = laporanAudit::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    $tes = explode('.', $getAllh->standar);
                    if($tes[0] == $request->name){
                        $all++;
                    }
                }
                
                $faqs = [$all];
                // $faqs = [$all,null,null];
                // $data0 = [null,$selesai,null];
                // $data1 = [null,null,$nonselesai];
            }

            return view('menu.chart.chartStandarLaporanAudit')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                // 'data_Selesai' => $data0,
                // 'data_NonSelesai' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartKategoriLaporanAuditget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                // $getSelesai = laporanAudit::with('jadwalAudit')->where('status', 'selesai')->get();
                // $selesai = 0;
                // foreach($getSelesai as $getSelesaih){
                //     if($getSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                //         if($getSelesaih->kategoriTemuan == $request->name){
                //             $selesai++;
                //         }
                //     }
                // }
                // $getNonSelesai = laporanAudit::with('jadwalAudit')->where('status', 'nonselesai')->get();
                // $nonselesai = 0;
                // foreach($getNonSelesai as $getNonSelesaih){
                //     if($getNonSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                //         if($getNonSelesaih->kategoriTemuan == $request->name){
                //             $nonselesai++;
                //         }
                //     }
                // }
                $getAll = laporanAudit::with('jadwalAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getAllh->kategoriTemuan == $request->name){
                            $all++;
                        }
                    }
                }
                
                $faqs = [$all];
                // $faqs = [$all,null,null];
                // $data0 = [null,$selesai,null];
                // $data1 = [null,null,$nonselesai];
            }else{
                // $getSelesai = laporanAudit::where('status', 'selesai')->get();
                // $selesai = 0;
                // foreach($getSelesai as $getSelesaih){
                //     if($getSelesaih->kategoriTemuan == $request->name){
                //         $selesai++;
                //     }
                // }
                // $getNonSelesai = laporanAudit::where('status', 'nonselesai')->get();
                // $nonselesai = 0;
                // foreach($getNonSelesai as $getNonSelesaih){
                //     if($getNonSelesaih->kategoriTemuan == $request->name){
                //         $nonselesai++;
                //     }
                // }
                $getAll = laporanAudit::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->kategoriTemuan == $request->name){
                        $all++;
                    }
                }
                
                $faqs = [$all];
                // $faqs = [$all,null,null];
                // $data0 = [null,$selesai,null];
                // $data1 = [null,null,$nonselesai];
            }

            return view('menu.chart.chartKategoriLaporanAudit')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                // 'data_Selesai' => $data0,
                // 'data_NonSelesai' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartLaporanAuditget(Request $request)
    {
        try{
            $pisah = explode( ',', $request->name);
            
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                // $getSelesai = laporanAudit::with('jadwalAudit')->where('status', 'selesai')->get();
                // $selesai = 0;
                // foreach($getSelesai as $getSelesaih){
                //     if($getSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                //         if($getSelesaih->jadwalAudit->periode == $pisah[0] && $getSelesaih->jadwalAudit->tahun == $pisah[1]){
                //             $selesai++;
                //         }
                //     }
                // }
                // $getNonSelesai = laporanAudit::with('jadwalAudit')->where('status', 'nonselesai')->get();
                // $nonselesai = 0;
                // foreach($getNonSelesai as $getNonSelesaih){
                //     if($getNonSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                //         if($getNonSelesaih->jadwalAudit->periode == $pisah[0] && $getNonSelesaih->jadwalAudit->tahun == $pisah[1]){
                //             $nonselesai++;
                //         }
                //     }
                // }
                $getAll = laporanAudit::with('jadwalAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getAllh->jadwalAudit->periode == $pisah[0] && $getAllh->jadwalAudit->tahun == $pisah[1]){
                            $all++;
                        }
                    }
                }
                $faqs = [$all];
                // $faqs = [$all,null,null];
                // $data0 = [null,$selesai,null];
                // $data1 = [null,null,$nonselesai];
            }else{
                // $getSelesai = laporanAudit::with('jadwalAudit')->where('status', 'selesai')->get();
                // $selesai = 0;
                // foreach($getSelesai as $getSelesaih){
                //     if($getSelesaih->jadwalAudit->periode == $pisah[0] && $getSelesaih->jadwalAudit->tahun == $pisah[1]){
                //         $selesai++;
                //     }
                // }
                // $getNonSelesai = laporanAudit::with('jadwalAudit')->where('status', 'nonselesai')->get();
                // $nonselesai = 0;
                // foreach($getNonSelesai as $getNonSelesaih){
                //     if($getNonSelesaih->jadwalAudit->periode == $pisah[0] && $getNonSelesaih->jadwalAudit->tahun == $pisah[1]){
                //         $nonselesai++;
                //     }
                // }
                $getAll = laporanAudit::with('jadwalAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->periode == $pisah[0] && $getAllh->jadwalAudit->tahun == $pisah[1]){
                        $all++;
                    }
                }
                
                $faqs = [$all];
                // $faqs = [$all,null,null];
                // $data0 = [null,$selesai,null];
                // $data1 = [null,null,$nonselesai];
            }

            return view('menu.chart.chartLaporanAudit')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                // 'data_Selesai' => $data0,
                // 'data_NonSelesai' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function chartStatusLaporanAuditget(Request $request)
    {
        try{
            if($request->name == "selesai"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getSelesai = laporanAudit::with('jadwalAudit')->where('status', $request->name)->get();
                    $selesai = 0;
                    foreach($getSelesai as $getSelesaih){
                        if($getSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $selesai++;
                        }
                    }
                    $data0 = [$selesai, null];
                    $data1 = null;
                }else{
                    $selesai = laporanAudit::where('status', $request->name)->count();
                    $data0 = [$selesai,null];
                    $data1 = null;
                }

                return view('menu.chart.chartStatusLaporanAudit')
                // ->compact('faqs');
                ->with([
                    'data_Selesai' => $data0,
                    'data_NonSelesai' => $data1
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getNonSelesai = laporanAudit::with('jadwalAudit')->where('status', $request->name)->get();
                    $nonselesai = 0;
                    foreach($getNonSelesai as $getNonSelesaih){
                        if($getNonSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $nonselesai++;
                        }
                    }
                    $data0 = null;
                    $data1 = [null,$nonselesai];
                }else{
                    $nonselesai = laporanAudit::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null,$nonselesai];
                }

                return view('menu.chart.chartStatusLaporanAudit')
                // ->compact('faqs');
                ->with([
                    'data_Selesai' => $data0,
                    'data_NonSelesai' => $data1
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function laporanAuditread(Request $request)
    {
        try{
            
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                // $getSelesai = laporanAudit::with('jadwalAudit')->where('status', 'selesai')->get();
                // $selesai = 0;
                // foreach($getSelesai as $getSelesaih){
                //     if($getSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                //         $selesai++;
                //     }
                // }
                // $getNonSelesai = laporanAudit::with('jadwalAudit')->where('status', 'nonselesai')->get();
                // $nonselesai = 0;
                // foreach($getNonSelesai as $getNonSelesaih){
                //     if($getNonSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                //         $nonselesai++;
                //     }
                // }
                $getAll = laporanAudit::with('jadwalAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $faqs = [$all];
                // $faqs = [$all,null,null];
                // $data0 = [null,$selesai,null];
                // $data1 = [null,null,$nonselesai];
            }else{
                // $selesai = laporanAudit::where('status', 'selesai')->count();
                // $nonselesai = laporanAudit::where('status', 'nonselesai')->count();
                $all = laporanAudit::count();
                $faqs = [$all];
                // $faqs = [$all,null,null];
                // $data0 = [null,$selesai,null];
                // $data1 = [null,null,$nonselesai];
            }

            return view('menu.chart.chartLaporanAuditread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                // 'data_Selesai' => $data0,
                // 'data_NonSelesai' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    

    //CAR
    public function chartUnitKerjaCARget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getOpen = CAR::with('laporanAudit')->where('status', 'open')->get();
                $open = 0;
                foreach($getOpen as $getOpenh){
                    if($getOpenh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $open++;
                    }
                }
                $getProcess = CAR::with('laporanAudit')->where('status', 'process')->get();
                $process = 0;
                foreach($getProcess as $getProcessh){
                    if($getProcessh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $process++;
                    }
                }
                $getClosed = CAR::with('laporanAudit')->where('status', 'closed')->get();
                $closed = 0;
                foreach($getClosed as $getClosedh){
                    if($getClosedh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $closed++;
                    }
                }
                $getAll = CAR::with('laporanAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null,null];
                $data0 = [null,$open,null,null];
                $data1 = [null,null,$process,null];
                $data2 = [null,null,null,$closed];
            }else{
                $getOpen = CAR::with('laporanAudit')->where('status', 'open')->get();
                $open = 0;
                foreach($getOpen as $getOpenh){
                    if($getOpenh->laporanAudit->jadwalAudit->unitkerja_id == $request->name){
                        $open++;
                    }
                }
                $getProcess = CAR::with('laporanAudit')->where('status', 'process')->get();
                $process = 0;
                foreach($getProcess as $getProcessh){
                    if($getProcessh->laporanAudit->jadwalAudit->unitkerja_id == $request->name){
                        $process++;
                    }
                }
                $getClosed = CAR::with('laporanAudit')->where('status', 'closed')->get();
                $closed = 0;
                foreach($getClosed as $getClosedh){
                    if($getClosedh->laporanAudit->jadwalAudit->unitkerja_id == $request->name){
                        $closed++;
                    }
                }
                $getAll = CAR::with('laporanAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->laporanAudit->jadwalAudit->unitkerja_id == $request->name){
                        $all++;
                    }
                }

                $faqs = [$all,null,null,null];
                $data0 = [null,$open,null,null];
                $data1 = [null,null,$process,null];
                $data2 = [null,null,null,$closed];
            }

            return view('menu.chart.chartUnitKerjaCAR')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Open' => $data0,
                'data_Process' => $data1,
                'data_Closed' => $data2,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function chartStandarCARget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getOpen = CAR::with('laporanAudit')->where('status', 'open')->get();
                $open = 0;
                foreach($getOpen as $getOpenh){
                    if($getOpenh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $tes = explode('.', $getOpenh->laporanAudit->standar);
                        if($tes[0] == $request->name){
                            $open++;
                        }
                    }
                }
                $getProcess = CAR::with('laporanAudit')->where('status', 'process')->get();
                $process = 0;
                foreach($getProcess as $getProcessh){
                    if($getProcessh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $tes = explode('.', $getProcessh->laporanAudit->standar);
                        if($tes[0] == $request->name){
                            $process++;
                        }
                    }
                }
                $getClosed = CAR::with('laporanAudit')->where('status', 'closed')->get();
                $closed = 0;
                foreach($getClosed as $getClosedh){
                    if($getClosedh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $tes = explode('.', $getClosedh->laporanAudit->standar);
                        if($tes[0] == $request->name){
                            $closed++;
                        }
                    }
                }
                $getAll = CAR::with('laporanAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $tes = explode('.', $getAllh->laporanAudit->standar);
                        if($tes[0] == $request->name){
                            $all++;
                        }
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$open,null,null];
                $data1 = [null,null,$process,null];
                $data2 = [null,null,null,$closed];
            }else{
                $getOpen = CAR::with('laporanAudit')->where('status', 'open')->get();
                $open = 0;
                foreach($getOpen as $getOpenh){
                    $tes = explode('.', $getOpenh->laporanAudit->standar);
                    if($tes[0] == $request->name){
                        $open++;
                    }
                }
                $getProcess = CAR::with('laporanAudit')->where('status', 'process')->get();
                $process = 0;
                foreach($getProcess as $getProcessh){
                    $tes = explode('.', $getProcessh->laporanAudit->standar);
                    if($tes[0] == $request->name){
                        $process++;
                    }
                }
                $getClosed = CAR::with('laporanAudit')->where('status', 'closed')->get();
                $closed = 0;
                foreach($getClosed as $getClosedh){
                    $tes = explode('.', $getClosedh->laporanAudit->standar);
                    if($tes[0] == $request->name){
                        $closed++;
                    }
                }
                $getAll = CAR::with('laporanAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    $tes = explode('.', $getAllh->laporanAudit->standar);
                    if($tes[0] == $request->name){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$open,null,null];
                $data1 = [null,null,$process,null];
                $data2 = [null,null,null,$closed];
            }

            return view('menu.chart.chartStandarCAR')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Open' => $data0,
                'data_Process' => $data1,
                'data_Closed' => $data2,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusCARget(Request $request)
    {
        try{
            if($request->name == "open"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getOpen = CAR::with('laporanAudit')->where('status', $request->name)->get();
                    $open = 0;
                    foreach($getOpen as $getOpenh){
                        if($getOpenh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $open++;
                        }
                    }
                    $data0 = [$open, null, null];
                    $data1 = null;
                    $data2 = null;
                }else{
                    $open = CAR::where('status', $request->name)->count();
                    $data0 = [$open, null, null];
                    $data1 = null;
                    $data2 = null;
                }

                return view('menu.chart.chartStatusCAR')
                // ->compact('faqs');
                ->with([
                    'data_Open' => $data0,
                    'data_Process' => $data1,
                    'data_Closed' => $data2,
                ]);
            }else if($request->name == "process"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getProcess = CAR::with('jadwalAudit')->where('status', $request->name)->get();
                    $process = 0;
                    foreach($getProcess as $getProcessh){
                        if($getProcessh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $process++;
                        }
                    }
                    $data0 = null;
                    $data1 = [null, $process, null];
                    $data2 = null;
                }else{
                    $process = CAR::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null, $process, null];
                    $data2 = null;
                }

                return view('menu.chart.chartStatusCAR')
                // ->compact('faqs');
                ->with([
                    'data_Open' => $data0,
                    'data_Process' => $data1,
                    'data_Closed' => $data2,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getClosed = CAR::with('jadwalAudit')->where('status', $request->name)->get();
                    $closed = 0;
                    foreach($getClosed as $getClosedh){
                        if($getClosedh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $closed++;
                        }
                    }
                    $data0 = null;
                    $data1 = null;
                    $data2 = [null, null, $closed];
                }else{
                    $closed = CAR::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = null;
                    $data2 = [null, null, $closed];
                }

                return view('menu.chart.chartStatusCAR')
                // ->compact('faqs');
                ->with([
                    'data_Open' => $data0,
                    'data_Process' => $data1,
                    'data_Closed' => $data2,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function CARread(Request $request)
    {
        try{
            
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getOpen = CAR::where('status', 'open')->get();
                $open = 0;
                foreach($getOpen as $getOpenh){
                    if($getOpenh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $open++;
                    }
                }
                $getProcess = CAR::where('status', 'process')->get();
                $process = 0;
                foreach($getProcess as $getProcessh){
                    if($getProcessh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $process++;
                    }
                }
                $getClosed = CAR::where('status', 'closed')->get();
                $closed = 0;
                foreach($getClosed as $getClosedh){
                    if($getClosedh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $closed++;
                    }
                }
                $getAll = CAR::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $faqs = [$all,null,null,null];
                $data0 = [null,$open,null,null];
                $data1 = [null,null,$process,null];
                $data2 = [null,null,null,$closed];
            }else{
                $open = CAR::where('status', 'open')->count();
                $process = CAR::where('status', 'process')->count();
                $closed = CAR::where('status', 'closed')->count();
                $all = CAR::count();
                // $faqs = [$selesai, $nonselesai];
                $faqs = [$all,null,null,null];
                $data0 = [null,$open,null,null];
                $data1 = [null,null,$process,null];
                $data2 = [null,null,null,$closed];
            }

            return view('menu.chart.chartCARread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Open' => $data0,
                'data_Process' => $data1,
                'data_Closed' => $data2,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    //JADWAL TM
    public function chartUnitKerjaJadwalTMget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = tinjauanManajemen::with('jadwalAudit')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = tinjauanManajemen::with('jadwalAudit')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = tinjauanManajemen::with('jadwalAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = tinjauanManajemen::with('jadwalAudit')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->jadwalAudit->unitkerja_id == $request->name){
                        $aktif++;
                    }
                }
                $getNonAktif = tinjauanManajemen::with('jadwalAudit')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->jadwalAudit->unitkerja_id == $request->name){
                        $nonaktif++;
                    }
                }
                $getAll = tinjauanManajemen::with('jadwalAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == $request->name){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartUnitKerjaJadwalTM')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusJadwalTMget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getAktif = tinjauanManajemen::with('jadwalAudit')->where('status', $request->name)->get();
                    $aktif = 0;
                    foreach($getAktif as $getAktifh){
                        if($getAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $aktif++;
                        }
                    }
                    $data0 = [$aktif, null];
                    $data1 = null;
                }else{
                    $aktif = tinjauanManajemen::where('status', $request->name)->count();
                    $data0 = [$aktif, null];
                    $data1 = null;
                }

                return view('menu.chart.chartStatusJadwalTM')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getNonAktif = tinjauanManajemen::with('jadwalAudit')->where('status', $request->name)->get();
                    $nonaktif = 0;
                    foreach($getNonAktif as $getNonAktifh){
                        if($getNonAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $nonaktif++;
                        }
                    }
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }else{
                    $nonaktif = tinjauanManajemen::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }

                return view('menu.chart.chartStatusJadwalTM')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function jadwalTMread(Request $request)
    {
        try{
            
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = tinjauanManajemen::with('jadwalAudit')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = tinjauanManajemen::with('jadwalAudit')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = tinjauanManajemen::with('jadwalAudit')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $aktif = tinjauanManajemen::where('status', 'aktif')->count();
                $nonaktif = tinjauanManajemen::where('status', 'nonaktif')->count();
                $all = tinjauanManajemen::count();
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartJadwalTMread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartDateTimeJadwalTMget(Request $request)
    {
        // dd($request);
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = tinjauanManajemen::with('jadwalAudit')->whereBetween('tglTM', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getAktifh->status == "aktif"){
                            $aktif++;
                        }
                    }
                }
                $getNonAktif = tinjauanManajemen::with('jadwalAudit')->whereBetween('tglTM', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        if($getNonAktifh->status == "nonaktif"){
                            $nonaktif++;
                        }
                    }
                }
                $getAll = tinjauanManajemen::with('jadwalAudit')->whereBetween('tglTM', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = tinjauanManajemen::with('jadwalAudit')->whereBetween('tglTM', array($request->mulai, $request->selesai))->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->status == "aktif"){
                        $aktif++;
                    }
                }
                $getNonAktif = tinjauanManajemen::with('jadwalAudit')->whereBetween('tglTM', array($request->mulai, $request->selesai))->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->status == "nonaktif"){
                        $nonaktif++;
                    }
                }
                $getAll = tinjauanManajemen::with('jadwalAudit')->whereBetween('tglTM', array($request->mulai, $request->selesai))->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    $all++;
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartDateTimeJadwalTM')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    //BAHAN TM
    public function chartUnitKerjaBahanTMget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = bahanRapatTM::with('tinjauanManajemen')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = bahanRapatTM::with('tinjauanManajemen')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = bahanRapatTM::with('tinjauanManajemen')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = bahanRapatTM::with('tinjauanManajemen')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == $request->name){
                        $aktif++;
                    }
                }
                $getNonAktif = bahanRapatTM::with('tinjauanManajemen')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == $request->name){
                        $nonaktif++;
                    }
                }
                $getAll = bahanRapatTM::with('tinjauanManajemen')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == $request->name){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartUnitKerjaBahanTM')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusBahanTMget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getAktif = bahanRapatTM::with('tinjauanManajemen')->where('status', $request->name)->get();
                    $aktif = 0;
                    foreach($getAktif as $getAktifh){
                        if($getAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $aktif++;
                        }
                    }
                    $data0 = [$aktif, null];
                    $data1 = null;
                }else{
                    $aktif = bahanRapatTM::where('status', $request->name)->count();
                    $data0 = [$aktif, null];
                    $data1 = null;
                }

                return view('menu.chart.chartStatusBahanTM')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getNonAktif = bahanRapatTM::with('tinjauanManajemen')->where('status', $request->name)->get();
                    $nonaktif = 0;
                    foreach($getNonAktif as $getNonAktifh){
                        if($getNonAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $nonaktif++;
                        }
                    }
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }else{
                    $nonaktif = bahanRapatTM::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }

                return view('menu.chart.chartStatusBahanTM')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function BahanTMread(Request $request)
    {
        try{
            
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = bahanRapatTM::with('tinjauanManajemen')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = bahanRapatTM::with('tinjauanManajemen')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = bahanRapatTM::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $aktif = bahanRapatTM::where('status', 'aktif')->count();
                $nonaktif = bahanRapatTM::where('status', 'nonaktif')->count();
                $all = bahanRapatTM::count();
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartBahanTMread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    //HASIL TM
    public function chartUnitKerjaHasilTMget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = hasilRapatTM::with('tinjauanManajemen')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = hasilRapatTM::with('tinjauanManajemen')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = hasilRapatTM::with('tinjauanManajemen')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = hasilRapatTM::with('tinjauanManajemen')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == $request->name){
                        $aktif++;
                    }
                }
                $getNonAktif = hasilRapatTM::with('tinjauanManajemen')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == $request->name){
                        $nonaktif++;
                    }
                }
                $getAll = hasilRapatTM::with('tinjauanManajemen')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == $request->name){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartUnitKerjaHasilTM')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusHasilTMget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getAktif = hasilRapatTM::with('tinjauanManajemen')->where('status', $request->name)->get();
                    $aktif = 0;
                    foreach($getAktif as $getAktifh){
                        if($getAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $aktif++;
                        }
                    }
                    $data0 = [$aktif, null];
                    $data1 = null;
                }else{
                    $aktif = hasilRapatTM::where('status', $request->name)->count();
                    $data0 = [$aktif, null];
                    $data1 = null;
                }

                return view('menu.chart.chartStatusHasilTM')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getNonAktif = hasilRapatTM::with('tinjauanManajemen')->where('status', $request->name)->get();
                    $nonaktif = 0;
                    foreach($getNonAktif as $getNonAktifh){
                        if($getNonAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $nonaktif++;
                        }
                    }
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }else{
                    $nonaktif = hasilRapatTM::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }

                return view('menu.chart.chartStatusHasilTM')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function HasilTMread(Request $request)
    {
        try{
            
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = hasilRapatTM::with('tinjauanManajemen')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = hasilRapatTM::with('tinjauanManajemen')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = hasilRapatTM::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $aktif = hasilRapatTM::where('status', 'aktif')->count();
                $nonaktif = hasilRapatTM::where('status', 'nonaktif')->count();
                $all = hasilRapatTM::count();
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartHasilTMread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    //TINDAK TM
    public function chartUnitKerjaTindakTMget(Request $request)
    {
        try{
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = tindakLanjutTM::with('hasilRapatTM')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = tindakLanjutTM::with('hasilRapatTM')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = tindakLanjutTM::with('hasilRapatTM')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $getAktif = tindakLanjutTM::with('hasilRapatTM')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == $request->name){
                        $aktif++;
                    }
                }
                $getNonAktif = tindakLanjutTM::with('hasilRapatTM')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == $request->name){
                        $nonaktif++;
                    }
                }
                $getAll = tindakLanjutTM::with('hasilRapatTM')->get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == $request->name){
                        $all++;
                    }
                }

                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartUnitKerjaTindakTM')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function chartStatusTindakTMget(Request $request)
    {
        try{
            if($request->name == "aktif"){
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getAktif = tindakLanjutTM::with('hasilRapatTM')->where('status', $request->name)->get();
                    $aktif = 0;
                    foreach($getAktif as $getAktifh){
                        if($getAktifh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $aktif++;
                        }
                    }
                    $data0 = [$aktif, null];
                    $data1 = null;
                }else{
                    $aktif = tindakLanjutTM::where('status', $request->name)->count();
                    $data0 = [$aktif, null];
                    $data1 = null;
                }

                return view('menu.chart.chartStatusTindakTM')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }else{
                if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                    $getNonAktif = tindakLanjutTM::with('hasilRapatTM')->where('status', $request->name)->get();
                    $nonaktif = 0;
                    foreach($getNonAktif as $getNonAktifh){
                        if($getNonAktifh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                            $nonaktif++;
                        }
                    }
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }else{
                    $nonaktif = tindakLanjutTM::where('status', $request->name)->count();
                    $data0 = null;
                    $data1 = [null, $nonaktif];
                }

                return view('menu.chart.chartStatusTindakTM')
                // ->compact('faqs');
                ->with([
                    'data_Aktif' => $data0,
                    'data_NonAktif' => $data1,
                ]);
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function TindakTMread(Request $request)
    {
        try{
            
            if(auth()->user()->role_id == 4 && auth()->user()->unitkerja_id != null){
                $getAktif = tindakLanjutTM::with('hasilRapatTM')->where('status', 'aktif')->get();
                $aktif = 0;
                foreach($getAktif as $getAktifh){
                    if($getAktifh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $aktif++;
                    }
                }
                $getNonAktif = tindakLanjutTM::with('hasilRapatTM')->where('status', 'nonaktif')->get();
                $nonaktif = 0;
                foreach($getNonAktif as $getNonAktifh){
                    if($getNonAktifh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $nonaktif++;
                    }
                }
                $getAll = tindakLanjutTM::get();
                $all = 0;
                foreach($getAll as $getAllh){
                    if($getAllh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
                        $all++;
                    }
                }
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }else{
                $aktif = tindakLanjutTM::where('status', 'aktif')->count();
                $nonaktif = tindakLanjutTM::where('status', 'nonaktif')->count();
                $all = tindakLanjutTM::count();
                $faqs = [$all,null,null];
                $data0 = [null,$aktif,null];
                $data1 = [null,null,$nonaktif];
            }

            return view('menu.chart.chartTindakTMread')
            // ->compact('faqs');
            ->with([
                'data' => $faqs,
                'data_Aktif' => $data0,
                'data_NonAktif' => $data1,
            ]);

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    

}
