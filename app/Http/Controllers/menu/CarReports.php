<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;
use PDF;

use App\Models\CAR;
use App\Models\User;
use App\Models\unitKerjas;
use App\Models\laporanAudit;
use App\Models\standars;

class CarReports extends Controller
{
    // public function index()
    // {
    //     $CARs = CAR::get();
    //     $user = User::get();
    //     return view('menu.CarReports.index', compact('CARs', 'user'));
    // }

    public function history()
    {
        $users = User::get();
        $Audits = laporanAudit::get();
        $UnitKerja = unitKerjas::get();
        $standars = standars::get();

        if (auth()->user()->role_id == 1){
            // $CARs = CAR::whereIn('status',  ['open', 'process', 'closed'])->orderBy('created_at', 'desc')->get();
            $CARs = DB::table('jadwal_audit')
                    ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                    ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
                    ->whereIn('jadwal_audit.status', ['aktif', 'nonaktif'])
                    // ->where('jadwal_audit.status', "nonaktif")
                    // ->orWhere('jadwal_audit.status', "aktif")
                    ->where('car.status', "closed")
                    ->orderBy('car.created_at', 'desc')
                    ->get();
            $laporanaudits = laporanAudit::get();
            $exportBahanTM = laporanAudit::get();               
        }else{
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                    ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    ->whereIn('jadwal_audit.status', ['aktif', 'nonaktif'])
                    // ->where('jadwal_audit.status', "nonaktif")
                    // ->where('jadwal_audit.status', "aktif")
                    ->where('car.status', "closed")
                    ->orderBy('car.created_at', 'desc')
                    ->get();

            $pivot1 = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    // ->where('jadwal_audit.status', "aktif")
                    // ->where('car.status', "closed")
                    ->get()
                    ->groupBy('audit_id');
            // $pivot2 = DB::table('users_jadwalaudit')
            //         ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
            //         ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
            //         ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
            //         ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
            //         ->where('users_jadwalaudit.user_id', auth()->user()->id)
            //         ->where('jadwal_audit.status', "aktif")
            //         ->where('car.status', "closed")
            //         ->where('car.hasilPemeriksaan', "nonsesuai")
            //         ->get();
            $pivot2 = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    // ->where('jadwal_audit.status', "aktif")
                    // ->where('car.status', "closed")
                    ->get();
            // dd($pivot);
            // $pivot2 = laporanAudit::get();
            if($pivot){
                $CARs = $pivot;
                $laporanaudits = $pivot1;
                $exportBahanTM = $pivot2;
            }else{
                $CARs = [];
                $laporanaudits = [];
                $exportBahanTM = [];
            }
        }
        // dd($CARs);

        return view('menu.CarReports.history', compact('CARs', 'laporanaudits', 'exportBahanTM', 'Audits', 'users', 'UnitKerja', 'standars'));
    }

    public function CARget(Request $request)
    {
        try{
            $keywordRaw = $request->name;
            // dd($keywordRaw);

            // if(auth()->user()->role_id == 3){
            //     $faqs = renops::whereHas('renstra', function($query) use($keywordRaw){
            //         $query->where('renstra.id', $keywordRaw);
            //     })->where('unitkerja_id',auth()->user()->unitkerja_id)->get();
            // }else{
            //     $faqs = renops::whereHas('renstra', function($query) use($keywordRaw){
            //         $query->where('renstra.id', $keywordRaw);
            //     })->get();
            // }

            $get = laporanAudit::where('id', $keywordRaw)->first();

            // $c = count($get);

            if($get == null){
                return '<p class="text-muted"> Maaf data tidak ditemukan </p>';
            }else{
                return view('menu.CarReports.CARget')->with([
                    'data' => $get,
                    // 'user' => $user
                ]);
            }
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function create()
    {
        $standars = standars::get();
        if (auth()->user()->role_id == 1){
                    $laporanaudits = DB::table('jadwal_audit')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->where('jadwal_audit.status', "aktif")
                        ->whereIn('laporan_audit.kategoriTemuan', ["AOC","NC"])
                        ->get()
                        ->groupBy('audit_id');
            // $Audits = laporanAudit::get();
        }else{
                    $laporanaudits = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->where('users_jadwalaudit.user_id', auth()->user()->id)
                        ->where('jadwal_audit.status', "aktif")
                        ->whereIn('laporan_audit.kategoriTemuan', ["AOC","NC"])
                        ->get()
                        ->groupBy('audit_id');
                        
                // $Audits = DB::table('users_jadwalaudit')
                //         ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                //         ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                //         ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                //         ->where('users_jadwalaudit.user_id', auth()->user()->id)
                //         ->where('jadwal_audit.status', "aktif")
                //         ->get()
                //         ->groupBy('audit_id');
                
            // $cekjadwal = laporanAudit::with('jadwalAudit')->get();
            //     if($cekjadwal->count() > 0){
            //         foreach($cekjadwal as $cekkk){
            //             foreach($cekkk->jadwalAudit->users as $tes1){
            //                 if($tes1->id == auth()->user()->id){
            //                     $Audits[] = $cekkk;
            //                 }
            //             }
            //         }
            //     }else{
            //         $Audits = array();
            //     }
        }
        // dd($Audits);
        
        $Audits = laporanAudit::get();
        $unitkerja = unitKerjas::get();
        return view('menu.CarReports.create', compact('Audits', 'unitkerja', 'laporanaudits', 'standars'));
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $valid = [
                'laporanaudit_id' => 'required',
                'laporanTemuan' => 'required',
                // 'tindakanPenyelesaian' => 'required',
                // 'tindakanPencegahan' => 'required|min:3|max:255',
                // 'file' => 'required|mimes:pdf,jpg,jpeg,png',
            ];
            
            $request->validate($valid);

            $unitKerja = unitKerjas::get();
            $laporan = laporanAudit::with('jadwalAudit')->get();
            
            // if(!empty($request->status)){
            //     $request->merge(['status' => "open"]);
            // }
            $status = "open";

            if(auth()->user()->role_id == 1){
                foreach($laporan as $lap){
                    if($lap->id == $request->laporanaudit_id){
                        // dd($lap->jadwalAudit);
                        foreach($unitKerja as $UK){
                            // dd($lap->jadwalAudit->unitkerja_id);
                            if($UK->id == $lap->jadwalAudit->unitkerja_id){
                                $nameUK = $UK->namaRepo;
                                // dd($nameUK);
                            }
                        }
                    }
                }
                                        
                // foreach($unitKerja as $UK){
                //     if(auth()->user()->role_id == 3){
                //         if($UK->id == auth()->user()->unitkerja_id){
                //             $nameUK = $UK->namaRepo;
                //         }
                //     }else{
                //         if($UK->id == $request->unitkerja_id){
                //             $nameUK = $UK->namaRepo;
                //         }
                //     }
                // }


                if(!empty($request->hasfile('file'))){
                    $file  = $request->file('file');
                    
                    if($file->getSize() <= 3145728){
                        $fileName   = $file->getClientOriginalName();
                        $date = \Carbon\Carbon::now()->format('Y');
                        $request->file('file')->move($nameUK."/"."CAR"."/".$date."/",$fileName);
                        $fileBukti = $nameUK."/"."CAR"."/".$date."/".$fileName;
        
                    }else{
                        return back()->with('error', 'File dokumen terlalu besar dari 3 MB, CAR Reports gagal ditambah');
                    }

                }

                $car = CAR::create([
                    'laporanaudit_id' => $request->laporanaudit_id,
                    'laporanTemuan'=> $request->laporanTemuan,
                    'analisiPenyebabMasalah'=> $request->analisiPenyebabMasalah,
                    'tindakanPenyelesaian'=> $request->tindakanPenyelesaian,
                    'tindakanPencegahan'=> $request->tindakanPencegahan,
                    'hasilPemeriksaan'=> $request->hasilPemeriksaan,
                    'rekomendasi'=> $request->rekomendasi,
                    'file' => $fileBukti,
                    'status'=> $status,
                ]);
            }else{
                $car = CAR::create([
                    'laporanaudit_id' => $request->laporanaudit_id,
                    'laporanTemuan'=> $request->laporanTemuan,
                    'hasilPemeriksaan'=> $request->hasilPemeriksaan,
                    'rekomendasi'=> $request->rekomendasi,
                    'status'=> $status,
                ]);
            }




            return redirect()->route('CarReports.show', $car->id)->with('success', 'CAR Reports berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function CarReportsSaveMulti(Request $request)
    {
        try{
            // dd($request);
            foreach ($request->addmore as $key => $value) {
                if ($value['laporanaudit_id'] != null){
                    // if($value['analisiPenyebabMasalah'] != null){

                                    $unitKerja = unitKerjas::get();
                                    $laporan = laporanAudit::with('jadwalAudit')->get();

                                    // if(!empty($request->status)){
                                    //     $status = "open";
                                    //     // $request->merge(['status' => "open"]);
                                    // }
                                    if(auth()->user()->role_id == 1){
                                        $status = "open";
                                        foreach($laporan as $lap){
                                            if($lap->id == $value['laporanaudit_id']){
                                                // dd($lap->jadwalAudit);
                                                foreach($unitKerja as $UK){
                                                    // dd($lap->jadwalAudit->unitkerja_id);
                                                    if($UK->id == $lap->jadwalAudit->unitkerja_id){
                                                        $nameUK = $UK->namaRepo;
                                                        // dd($nameUK);
                                                    }
                                                }
                                            }
                                        }
                                    
                                        if(!empty($value['file'])){
                                            $file  = $value['file'];
                                            if($file->getSize() <= 3145728){

                                                $fileName   = $file->getClientOriginalName();
                                                $date = \Carbon\Carbon::now()->format('Y');
                                                $value['file']->move($nameUK."/"."CAR"."/".$date."/",$fileName);
                                                $fileBukti = $nameUK."/"."CAR"."/".$date."/".$fileName;

                                            }else{
                                                return back()->with('error', 'File dokumen terlalu besar dari 3 MB, CAR Reports gagal ditambah');
                                            }
                                        }else{
                                            $fileBukti = null;
                                        }
                                    
                                        CAR::create([
                                            'laporanaudit_id' => $value['laporanaudit_id'],
                                            // 'analisiPenyebabMasalah'=> $value['analisiPenyebabMasalah'],
                                            'tindakanPenyelesaian'=> $value['tindakanPenyelesaian'],
                                            'tindakanPencegahan'=> $value['tindakanPencegahan'],
                                            'hasilPemeriksaan'=> $value['hasilPemeriksaan'],
                                            'rekomendasi'=> $value['rekomendasi'],
                                            'file' => $fileBukti,
                                            'status'=> $status,
                                        ]);

                                    }else{
                                        $status = "open";
                                        
                                        CAR::create([
                                            'laporanaudit_id' => $value['laporanaudit_id'],
                                            'hasilPemeriksaan'=> $value['hasilPemeriksaan'],
                                            'rekomendasi'=> $value['rekomendasi'],
                                            'status'=> $status,
                                        ]);
                                    }

                    // }else{
                    //     return back()->with('error', 'Analisis Penyebab Masalah wajib di isi, Jadwal Audit gagal ditambah');
                    // }

                }else{
                    return back()->with('error', 'Laporan Audit wajib di isi, Jadwal Audit gagal ditambah');
                }
            }
            
            // return redirect()->to('AMI#CAR')->with('success', 'CAR berhasil ditambah');
            return back()->with('success', 'CAR Reports berhasil ditambah');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $CARs = CAR::findOrFail($id);
        $users = User::where('role_id', 2)->get();
        return view('menu.CarReports.show', compact('CARs', 'users'));
    }

    public function edit($id)
    {
        $CARs = CAR::findOrFail($id);
        if (auth()->user()->role_id == 1){
            $Audits = laporanAudit::get();
        }else{
                $Audits = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->where('users_jadwalaudit.user_id', auth()->user()->id)
                        ->where('jadwal_audit.status', "aktif")
                        ->get()
                        ->groupBy('audit_id');
        }
        // dd($Audits);
        $unitkerja = unitKerjas::get();
        // dd($Audits);
        // $Audits = laporanAudit::get();
        $users = User::where('role_id', 2)->get();
        $standars = standars::get();
        return view('menu.CarReports.edit', compact('CARs', 'Audits', 'users', 'unitkerja', 'standars'));
    }

    public function update(Request $request, $id)
    {
        try{
            // dd($request);
            $valid = [
                'laporanaudit_id' => 'required',
                'analisiPenyebabMasalah' => 'required',
                'tindakanPenyelesaian' => 'required',
                'tindakanPencegahan' => 'required',
                'file' => 'required|mimes:pdf,jpg,jpeg,png',
            ];
            
            // $request->validate($valid);
            $unitKerja = unitKerjas::get();    
            $CARs = CAR::findOrFail($id);
            
            if(auth()->user()->role_id == 1){

                
                if($CARs->file != null || !empty($CARs->file)){
                    $pecah = explode("/", $CARs->file);
                    $tes0 = $pecah[0];
                    $tes1 = $pecah[1];
                    $tes2 = $pecah[2];
                    $tes3 = $pecah[3];
                    $tes4 = $pecah[4];
        
                    $hasil = $tes0.'/'.$tes1.'/'.$tes2.'/'.$tes3.'/'.$tes4;
                    $nameUK = $hasil;
                    
                }else{
                    foreach($unitKerja as $UK){
                        if($UK->id == $CARs->laporanAudit->jadwalAudit->unitkerja_id){
                            $nameUK = $UK->namaRepo;
                        }
                    }
                }
                // dd($nameUK);
    
                
                // foreach($unitKerja as $UK){
                //     if(auth()->user()->role_id == 3){
                //         if($UK->id == auth()->user()->unitkerja_id){
                //             $nameUK = $UK->namaRepo;
                //         }
                //     }else{
                //             $nameUK = $hasil;
                //     }
                // }
    
                // $CARs = CAR::where('id', $id)->first();
                // dd($CARs);
                if(!empty($request->hasfile('file'))){
                    File::delete($CARs->file);
                    $file  = $request->file('file');
                    if($file->getSize() <= 3145728){
                        $fileName   = $file->getClientOriginalName();
                        $date = \Carbon\Carbon::now()->format('Y');
                        $request->file('file')->move($nameUK."/"."CAR"."/".$date."/",$fileName);
                        $fileBukti = $nameUK."/"."CAR"."/".$date."/".$fileName;
    
                    }else{
                        return back()->with('error', 'File dokumen terlalu besar dari 3 MB, CAR Reports gagal diubah');
                    }
                }else{
                    $fileBukti = $CARs->file;
                }
                
                $CARs->update([
                    'laporanaudit_id' => $request->laporanaudit_id,
                    'laporanTemuan'=> $request->laporanTemuan,
                    'analisiPenyebabMasalah'=> $request->analisiPenyebabMasalah,
                    'tindakanPenyelesaian'=> $request->tindakanPenyelesaian,
                    'tindakanPencegahan'=> $request->tindakanPencegahan,
                    'hasilPemeriksaan'=> $request->hasilPemeriksaan,
                    'rekomendasi'=> $request->rekomendasi,
                    'file' => $fileBukti,
                    'status'=> $request->status,
                    'acc'=> $request->acc,
                ]);
                
                return redirect()->route('CarReports.show', $CARs->id)->with('success', 'CAR Reports berhasil diubah');
                
            }elseif(auth()->user()->role_id == 2){
                    if($request->status == "process" || $request->status == "closed"){
                        // $request->merge(['acc' => auth()->user()->id]);
                        $Approv = auth()->user()->id;
                        
                        $CARs->update([
                            'laporanaudit_id' => $request->laporanaudit_id,
                            'laporanTemuan'=> $request->laporanTemuan,
                            // 'analisiPenyebabMasalah'=> $request->analisiPenyebabMasalah,
                            'hasilPemeriksaan'=> $request->hasilPemeriksaan,
                            'rekomendasi'=> $request->rekomendasi,
                            'status'=> $request->status,
                            'acc'=> $Approv,
                        ]);
                    }else{
                        $CARs->update([
                            'laporanaudit_id' => $request->laporanaudit_id,
                            'laporanTemuan'=> $request->laporanTemuan,
                            // 'analisiPenyebabMasalah'=> $request->analisiPenyebabMasalah,
                            'hasilPemeriksaan'=> $request->hasilPemeriksaan,
                            'rekomendasi'=> $request->rekomendasi,
                            'status'=> $request->status,
                        ]);
                    }
                    
                return redirect()->route('CarReports.show', $CARs->id)->with('success', 'CAR Reports berhasil diubah');
                
            }else{
                $unitKerja = unitKerjas::get();
                                    
                $CARs = CAR::with('laporanAudit')->findOrFail($id);
                
                foreach($unitKerja as $UK){
                    if($UK->id == $CARs->laporanAudit->jadwalAudit->unitkerja_id){
                        $nameUK = $UK->namaRepo;
                    }
                }
                
                if(!empty($request->hasfile('file'))){
                    File::delete($CARs->file);
                    $file  = $request->file('file');
                    if($file->getSize() <= 3145728){
                        $fileName   = $file->getClientOriginalName();
                        $date = \Carbon\Carbon::now()->format('Y');
                        $request->file('file')->move($nameUK."/"."CAR"."/".$date."/",$fileName);
                        $fileBukti = $nameUK."/"."CAR"."/".$date."/".$fileName;
    
                    }else{
                        return back()->with('error', 'File dokumen terlalu besar dari 3 MB, CAR Reports gagal diubah');
                    }
                    
                }else{
                    $fileBukti = $CARs->file;
                }
                
                $CARs->update([
                    'analisiPenyebabMasalah'=> $request->analisiPenyebabMasalah,
                    'tindakanPenyelesaian'=> $request->tindakanPenyelesaian,
                    'tindakanPencegahan'=> $request->tindakanPencegahan,
                    'status'=> $request->status,
                    'file' => $fileBukti,
                ]);
                
                return redirect()->route('CarReports.show', $CARs->id)->with('success', 'CAR Reports berhasil diubah');
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $CARs = CAR::findOrFail($id);
            $CARs->delete();

            return back()->with('success', 'CAR Reports berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function Change(Request $request)
    {
        try{
            // dd($request);
            $id =  $request->id;
            $data['hasilPemeriksaan'] =  $request->status;
                
            DB::table('car')->where('id',$id)->update($data);
            return redirect()->back();

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
