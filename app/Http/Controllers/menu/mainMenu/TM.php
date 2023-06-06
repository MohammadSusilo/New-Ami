<?php

namespace App\Http\Controllers\menu\mainMenu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;

//Main Model
// use App\Models\hasilTM;
use App\Models\hasilRapatTM;
use App\Models\jadwalAudit;
use App\Models\bahanRapatTM;
use App\Models\tindakLanjutTM;
use App\Models\tinjauanManajemen;


//Second Model
use App\Models\CAR;
use App\Models\User;
use App\Models\unitKerjas;

class TM extends Controller
{
    public function index()
    {
        //jadwal
        $jadwalAuditAdd = jadwalAudit::where('status', 'aktif')->get();
        $unitKerja = unitKerjas::get();
        $jadwalAudit = jadwalAudit::get();
        $jadwalTM = tinjauanManajemen::with('jadwalAudit')->get();
        $allCAR = CAR::get();
        $CARsesuai = CAR::with('laporanAudit')->where([
            ['status', '=', 'closed'],
            ['hasilPemeriksaan', '=', 'sesuai'],
        ])->get();
        
        if(auth()->user()->role_id == 1){
            // $jadwalTM = tinjauanManajemen::with('jadwalAudit')->get();
            $jadwalTM = DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->where('jadwal_audit.status', "aktif")
                            ->where('tinjauan_manajemen.status', "aktif")
                            ->orderBy('tinjauan_manajemen.created_at', 'desc')
                            ->get();

        }else{
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    ->where('jadwal_audit.status', "aktif")
                    ->where('tinjauan_manajemen.status', "aktif")
                    ->orderBy('tinjauan_manajemen.created_at', 'desc')
                    ->get();
                    // dd($pivot);

            if($pivot){
                $jadwalTM = $pivot;
            }else{
                $jadwalTM = [];
            }
            
            // // $jadwalTM = tinjauanManajemen::with('jadwalAudit')->get();
            // $cek = tinjauanManajemen::with('jadwalAudit')->get();
            // if($cek->count() > 0){
            //     foreach($cek as $cekk){
            //         if($cekk->count() > 0){
            //             foreach($cekk->jadwalAudit->users as $user){
            //                 if($user->id == auth()->user()->id){
            //                     $jadwalTM = $cek;
            //                 }
            //                 // }else{
            //                 //     $jadwalTM = array();
            //                 // }
            //             }
            //         }else{
            //             $jadwalTM = array();
            //         }
            //     }
            // }else{
            //     $jadwalTM = array();
            // }
            
        }
        // dd($jadwalTM);
        
        //bahan
        // $bahanTM = bahanRapatTM::get();
        if(auth()->user()->role_id == 1){
            $bahanTM = DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                            ->where('jadwal_audit.status', "aktif")
                            ->where('tinjauan_manajemen.status', "aktif")
                            ->where('bahan_rapattm.status', "aktif")
                            ->orderBy('bahan_rapattm.created_at', 'desc')
                            ->get();
                            // dd($bahanTM);
            // $bahanTM = bahanRapatTM::with('tinjauanManajemen')->get();

        }else{
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    ->where('jadwal_audit.status', "aktif")
                    ->where('tinjauan_manajemen.status', "aktif")
                    ->where('bahan_rapattm.status', "aktif")
                    ->orderBy('bahan_rapattm.created_at', 'desc')
                    ->get();

            if($pivot){
                $bahanTM = $pivot;
            }else{
                $bahanTM = [];
            }

            // $cek = bahanRapatTM::with('tinjauanManajemen')->get();
            // if($cek->count() > 0){
            //     foreach($cek as $cekk){
            //         if($cekk->count() > 0){
            //             foreach($cekk->tinjauanManajemen->jadwalAudit->users as $tes){
            //                 if($tes->id == auth()->user()->id){
            //                     $bahanTM[] = $cekk;
            //                 }
            //                 // }else{
            //                 //     $bahanTM = array();
            //                 // }
            //             }
            //         }else{
            //             $bahanTM = array();
            //         }
            //     }
            // }else{
            //     $bahanTM = array();
            // }
        }

        //hasil
        // $hasilTM = hasilRapatTM::get();
        if(auth()->user()->role_id == 1){
            $hasilTM = DB::table('jadwal_audit')
                        ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                        ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                        ->where('jadwal_audit.status', "aktif")
                        ->where('tinjauan_manajemen.status', "aktif")
                        ->where('hasil_rapattm.status', "aktif")
                        ->orderBy('hasil_rapattm.created_at', 'desc')
                        ->get();

            // $hasilTM = hasilRapatTM::with('tinjauanManajemen')->get();

        }else{
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    ->where('jadwal_audit.status', "aktif")
                    ->where('tinjauan_manajemen.status', "aktif")
                    ->where('hasil_rapattm.status', "aktif")
                    ->orderBy('hasil_rapattm.created_at', 'desc')
                    ->get();

            if($pivot){
                $hasilTM = $pivot;
            }else{
                $hasilTM = [];
            }

            // $cek = hasilRapatTM::with('tinjauanManajemen')->get();
            // if($cek->count() > 0){
            //     foreach($cek as $cekk){
            //         if($cekk->count() > 0){
            //             foreach($cekk->tinjauanManajemen->jadwalAudit->users as $tes){
            //                 if($tes->id == auth()->user()->id){
            //                     $hasilTM[] = $cekk;
            //                 }
            //                 // }else{
            //                 //     $hasilTM = array();
            //                 // }
            //             }
            //         }else{
            //             $hasilTM = array();
            //         }
            //     }
            // }else{
            //     $hasilTM = array();
            // }
            
        }

        //tindak lanjut
        $users = User::whereIn('role_id', ['3'])->get();
        // $users = User::get();
        // $tindakTM = tindakLanjutTM::get();

        if(auth()->user()->role_id == 1){
            $tindakTM = DB::table('jadwal_audit')
                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                    ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', '=', 'hasil_rapattm.id')
                    ->where('jadwal_audit.status', "aktif")
                    ->where('tinjauan_manajemen.status', "aktif")
                    ->where('hasil_rapattm.status', "aktif")
                    // ->where('tindak_lanjuttm.status', "aktif")
                    ->orderBy('tindak_lanjuttm.created_at', 'desc')
                    ->get();

            // $tindakTM = tindakLanjutTM::with('hasilRapatTM')->get();

        }else{
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                    ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', '=', 'hasil_rapattm.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    ->where('jadwal_audit.status', "aktif")
                    ->where('tinjauan_manajemen.status', "aktif")
                    ->where('hasil_rapattm.status', "aktif")
                    // ->where('tindak_lanjuttm.status', "selesai")
                    ->orderBy('tindak_lanjuttm.created_at', 'desc')
                    ->get();                

            if($pivot){
                $tindakTM = $pivot;
            }else{
                $tindakTM = [];
            }

            // $cek = tindakLanjutTM::with('hasilRapatTM')->get();
            // if($cek->count() > 0){
            //     foreach($cek as $cekk){
            //         if($cekk->count() > 0){
            //             foreach($cekk->hasilRapatTM->tinjauanManajemen->jadwalAudit->users as $tes){
            //                 if($tes->id == auth()->user()->id){
            //                     $tindakTM[] = $cekk;
            //                 }
            //                 // }else{
            //                 //     $tindakTM = array();
            //                 // }
            //             }
            //         }else{
            //             $tindakTM = array();
            //         }
            //     }
            // }else{
            //     $tindakTM = array();
            // }
            
        }

        return view('menu.TM', compact('jadwalAudit', 'CARsesuai', 'allCAR', 'jadwalAuditAdd', 'unitKerja', 'jadwalTM', 'bahanTM', 'hasilTM', 'users', 'tindakTM'));
    }
}
