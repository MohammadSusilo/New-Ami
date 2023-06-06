<?php
   
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\unitKerjas;

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
   
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        if(auth()->user()->unitkerja_id == null && auth()->user()->role_id == 4 || auth()->user()->role_id == 4 || auth()->user()->role_id == 1){
            $jadwalAudit0 = DB::table('jadwal_audit')
                        ->where('jadwal_audit.status', "aktif")
                        ->orderBy('jadwal_audit.tglAudit', 'desc')
                        ->get()
                        ->count();
            $laporanAudit0 = DB::table('jadwal_audit')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->where('jadwal_audit.status', "aktif")
                        ->orderBy('laporan_audit.created_at', 'desc')
                        ->get()
                        ->count();
            $CAR0 = DB::table('jadwal_audit')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
                        ->where('jadwal_audit.status', "aktif")
                        ->where('car.status', "open")
                        ->orderBy('car.created_at', 'desc')
                        ->get()
                        ->count();

            $jadwalTM0 = DB::table('jadwal_audit')
                        ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                        ->where('jadwal_audit.status', "aktif")
                        ->where('tinjauan_manajemen.status', "aktif")
                        ->orderBy('tinjauan_manajemen.created_at', 'desc')
                        ->get()
                        ->count();
                    
            $bahanTM0 = DB::table('jadwal_audit')
                        ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                        ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                        ->where('jadwal_audit.status', "aktif")
                        ->where('tinjauan_manajemen.status', "aktif")
                        ->where('bahan_rapattm.status', "aktif")
                        ->orderBy('bahan_rapattm.created_at', 'desc')
                        ->get()
                        ->count();

            $hasilTM0 = DB::table('jadwal_audit')
                        ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                        ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                        ->where('jadwal_audit.status', "aktif")
                        ->where('tinjauan_manajemen.status', "aktif")
                        ->where('hasil_rapattm.status', "aktif")
                        ->orderBy('hasil_rapattm.created_at', 'desc')
                        ->get()
                        ->count();

            $tindakTM0 = DB::table('jadwal_audit')
                        ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                        ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                        ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', '=', 'hasil_rapattm.id')
                        ->where('jadwal_audit.status', "aktif")
                        ->where('tinjauan_manajemen.status', "aktif")
                        ->where('hasil_rapattm.status', "aktif")
                        ->where('tindak_lanjuttm.status', "aktif")
                        ->orderBy('tindak_lanjuttm.created_at', 'desc')
                        ->get()
                        ->count();

            $tile = [
                'dokInduk' => dokumenInduk::where('status', "aktif")->get()->count(),
                'dokChecklist' => dokumenChecklist::where('status', "aktif")->get()->count(),
                'pimpinan' => pimpinans::get()->count(),
                'pengelola' => pengelolaUnitKerja::get()->count(),
                'renstra' => renstras::where('status', "aktif")->get()->count(),
                'renop' => renops::where('status', "aktif")->get()->count(), 
                'unitKerja' => unitKerjas::get()->count(),
                'users' => User::get()->count(),
                'kinerjaUnit' => kinerjaUnit::where('status', "aktif")->get()->count(),
                'buktiKinerja' => buktiKinerja::where('status', "aktif")->get()->count(),
                'jadwalAudit' => $jadwalAudit0,
                'laporanAudit' => $laporanAudit0,
                'CAR' => $CAR0,
                'jadwalTM' => $jadwalTM0,
                'hasilTM' => $hasilTM0,
                'bahanTM' => $bahanTM0,
                'tindakTM' => $tindakTM0,

                // 'jadwalAudit' => jadwalAudit::get()->count(),
                // 'laporanAudit' => laporanAudit::get()->count(),
                // 'CAR' => CAR::get()->count(),
                // 'jadwalTM' => tinjauanManajemen::get()->count(),
                // 'hasilTM' => hasilRapatTM::get()->count(),
                // 'bahanTM' => bahanRapatTM::get()->count(),
                // 'tindakTM' => tindakLanjutTM::get()->count(),
            ];
        }else{
            $unit = auth()->user()->unitkerja_id;
            $renop1 = renops::where('unitkerja_id', $unit)->count();
            $kinerja1 = kinerjaUnit::where('unitkerja_id', $unit)->count();
            $bukti1 = buktiKinerja::where('unitkerja_id', $unit)->count();
            
            $jadwalAudit1 = DB::table('users_jadwalaudit')
                            ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                            ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                            ->where('users_jadwalaudit.user_id', auth()->user()->id)
                            ->where('jadwal_audit.status', "aktif")
                            ->orderBy('jadwal_audit.tglAudit', 'desc')
                            ->get()
                            ->count();
            $laporanAudit1 = DB::table('users_jadwalaudit')
                            ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                            ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                            ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                            ->where('users_jadwalaudit.user_id', auth()->user()->id)
                            ->where('jadwal_audit.status', "aktif")
                            ->orderBy('laporan_audit.created_at', 'desc')
                            ->get()
                            ->count();
            $CAR1 = DB::table('users_jadwalaudit')
                            ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                            ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                            ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                            ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
                            ->where('users_jadwalaudit.user_id', auth()->user()->id)
                            ->where('jadwal_audit.status', "aktif")
                            ->where('car.status', "open")
                            ->orderBy('car.created_at', 'desc')
                            ->get()
                            ->count();

            $jadwalTM1 = DB::table('users_jadwalaudit')
                            ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                            ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->where('users_jadwalaudit.user_id', auth()->user()->id)
                            ->where('jadwal_audit.status', "aktif")
                            ->where('tinjauan_manajemen.status', "aktif")
                            ->orderBy('tinjauan_manajemen.created_at', 'desc')
                            ->get()
                            ->count();
                        
            $bahanTM1 = DB::table('users_jadwalaudit')
                            ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                            ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                            ->where('users_jadwalaudit.user_id', auth()->user()->id)
                            ->where('jadwal_audit.status', "aktif")
                            ->where('tinjauan_manajemen.status', "aktif")
                            ->where('bahan_rapattm.status', "aktif")
                            ->orderBy('bahan_rapattm.created_at', 'desc')
                            ->get()
                            ->count();

            $laporanTM1 = DB::table('users_jadwalaudit')
                            ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                            ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                            ->where('users_jadwalaudit.user_id', auth()->user()->id)
                            ->where('jadwal_audit.status', "aktif")
                            ->where('tinjauan_manajemen.status', "aktif")
                            ->where('hasil_rapattm.status', "aktif")
                            ->orderBy('hasil_rapattm.created_at', 'desc')
                            ->get()
                            ->count();

            $tindakTM1 = DB::table('users_jadwalaudit')
                            ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                            ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                            ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', '=', 'hasil_rapattm.id')
                            ->where('users_jadwalaudit.user_id', auth()->user()->id)
                            ->where('jadwal_audit.status', "aktif")
                            ->where('tinjauan_manajemen.status', "aktif")
                            ->where('hasil_rapattm.status', "aktif")
                            ->where('tindak_lanjuttm.status', "aktif")
                            ->orderBy('tindak_lanjuttm.created_at', 'desc')
                            ->get()
                            ->count();

            // $jadwalAudit1 = jadwalAudit::where('unitkerja_id', $unit)->count();

            // $getSelesai = laporanAudit::with('jadwalAudit')->get();
            // $selesai = 0;
            // foreach($getSelesai as $getSelesaih){
            //     if($getSelesaih->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
            //         $selesai++;
            //     }
            // }
            // $laporanAudit1 = $selesai;

            // $getAll = CAR::with('laporanAudit')->get();
            // $all = 0;
            // foreach($getAll as $getAllh){
            //     if($getAllh->laporanAudit->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
            //         $all++;
            //     }
            // }
            // $CAR1 = $all;

            // $getAll = tinjauanManajemen::with('jadwalAudit')->get();
            // $all = 0;
            // foreach($getAll as $getAllh){
            //     if($getAllh->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
            //         $all++;
            //     }
            // }
            // $jadwalTM1 = $all;

            // $getAll = hasilRapatTM::with('tinjauanManajemen')->get();
            // $all = 0;
            // foreach($getAll as $getAllh){
            //     if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
            //         $all++;
            //     }
            // }
            // $laporanTM1 = $all;

            // $getAll = bahanRapatTM::with('tinjauanManajemen')->get();
            // $all = 0;
            // foreach($getAll as $getAllh){
            //     if($getAllh->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
            //         $all++;
            //     }
            // }
            // $bahanTM1 = $all;

            // $getAll = tindakLanjutTM::with('hasilRapatTM')->get();
            // $all = 0;
            // foreach($getAll as $getAllh){
            //     if($getAllh->hasilRapatTM->tinjauanManajemen->jadwalAudit->unitkerja_id == auth()->user()->unitkerja_id){
            //         $all++;
            //     }
            // }
            // $tindakTM1 = $all;

            $renstra1 = renstras::count();
            $dokInduk1 = dokumenInduk::count();
            $dokChecklist1 = dokumenChecklist::where('unitkerja_id', $unit)->count();

            $tile = [
                'dokInduk' => $dokInduk1,
                'dokChecklist' => $dokChecklist1,
                'pimpinan' => 0,
                'pengelola' => 0,
                'renstra' => $renstra1,
                'renop' => $renop1,
                'unitKerja' => 0,
                'users' => 0,
                'kinerjaUnit' => $kinerja1,
                'buktiKinerja' => $bukti1,
                'jadwalAudit' => $jadwalAudit1,
                'laporanAudit' => $laporanAudit1,
                'CAR' => $CAR1,
                'jadwalTM' => $jadwalTM1,
                'hasilTM' => $laporanTM1,
                'bahanTM' => $bahanTM1,
                'tindakTM' => $tindakTM1,
            ]; 
        }

        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $tahun = \Carbon\Carbon::now()->format('Y');

        for($bulan=1;$bulan < 13;$bulan++){
            $allrens = collect(DB::SELECT("SELECT count(id) AS jumlah from renstra where month(created_at)='$bulan'  AND year(created_at)='$tahun'"))->first();
            $renstra[] = $allrens->jumlah;

            $allrenp = collect(DB::SELECT("SELECT count(id) AS jumlah from renop where month(created_at)='$bulan'  AND year(created_at)='$tahun'"))->first();
            $renop[] = $allrenp->jumlah;

            $alldokInd = collect(DB::SELECT("SELECT count(id) AS jumlah from dokumeninduk where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
            $dokInduk[] = $alldokInd->jumlah;

            $alldokCheck = collect(DB::SELECT("SELECT count(id) AS jumlah from dokumencheklist where month(created_at)='$bulan'  AND year(created_at)='$tahun'"))->first();
            $dokCheck[] = $alldokCheck->jumlah;

            $alljadwalAudit = collect(DB::SELECT("SELECT count(id) AS jumlah from jadwal_audit where month(tglAudit)='$bulan' AND year(tglAudit)='$tahun'"))->first();
            $jadwalAudit[] = $alljadwalAudit->jumlah;
            
            $getAll = laporanAudit::with('jadwalAudit')->get();
            $alllaporanAudit = 0;
            foreach($getAll as $getAllh){
                if(date("m", strtotime($getAllh->jadwalAudit->tglAudit)) == $bulan AND date("Y", strtotime($getAllh->jadwalAudit->tglAudit)) == $tahun){
                    $alllaporanAudit++;
                }
            }
            
            $laporanAudit[] = $alllaporanAudit;

            $getAll = CAR::with('laporanAudit')->get();
            $allCAR = 0;
            foreach($getAll as $getAllh){
                if(date("m", strtotime($getAllh->laporanAudit->jadwalAudit->tglAudit)) == $bulan AND date("Y", strtotime($getAllh->laporanAudit->jadwalAudit->tglAudit)) == $tahun){
                    $allCAR++;
                }
            }
            
            $CAR[] = $allCAR;

            $alljadwalTM = collect(DB::SELECT("SELECT count(id) AS jumlah from tinjauan_manajemen where month(tglTM)='$bulan' AND year(tglTM)='$tahun'"))->first();
            $jadwalTM[] = $alljadwalTM->jumlah;


            $getAll = hasilRapatTM::with('tinjauanManajemen')->get();
            $allhasilTM = 0;
            foreach($getAll as $getAllh){
                if(date("m", strtotime($getAllh->tinjauanManajemen->tglTM)) == $bulan AND date("Y", strtotime($getAllh->tinjauanManajemen->tglTM)) == $tahun){
                    $allhasilTM++;
                }
            }
            
            $hasilTM[] = $allhasilTM;

            $getAll = bahanRapatTM::with('tinjauanManajemen')->get();
            $allbahanTM = 0;
            foreach($getAll as $getAllh){
                if(date("m", strtotime($getAllh->tinjauanManajemen->tglTM)) == $bulan AND date("Y", strtotime($getAllh->tinjauanManajemen->tglTM)) == $tahun){
                    $allbahanTM++;
                }
            }
            
            $bahanTM[] = $allbahanTM;

            $getAll = tindakLanjutTM::with('hasilRapatTM')->get();
            $alltindakTM = 0;
            foreach($getAll as $getAllh){
                if(date("m", strtotime($getAllh->hasilRapatTM->tinjauanManajemen->tglTM)) == $bulan AND date("Y", strtotime($getAllh->hasilRapatTM->tinjauanManajemen->tglTM)) == $tahun){
                    $alltindakTM++;
                }
            }
            
            $tindakTM[] = $alltindakTM;
        }

        return view('dasboard', compact('tile', 'label', 'renstra', 'renop', 'dokInduk', 'dokCheck', 'jadwalAudit', 'laporanAudit', 'CAR', 'jadwalTM', 'hasilTM', 'bahanTM', 'tindakTM'));
    }
    
}