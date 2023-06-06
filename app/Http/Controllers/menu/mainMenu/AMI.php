<?php

namespace App\Http\Controllers\menu\mainMenu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;

//Main Model
use App\Models\CAR;
use App\Models\jadwalAudit;
use App\Models\laporanAudit;


//Second Model
use App\Models\User;
use App\Models\unitKerjas;
use App\Models\tinjauanManajemen;
use App\Models\standars;

class AMI extends Controller
{
    public function index()
    {
        try{
            //jadwal
            $unitKerja = unitKerjas::get();
            $users = User::get();
            $TM = tinjauanManajemen::with('jadwalAudit')->get();
            $standars = standars::get();
            
            if(auth()->user()->role_id == 1){
                $scheduling = jadwalAudit::with('users')->where('status', "aktif")->orderBy('tglAudit', 'desc')->get();
                $periode = jadwalAudit::with('users')->get();
                $selectUserpivot = [];

            }else{
                $periode = jadwalAudit::with('users')->get();
                $pivot = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        ->where('users_jadwalaudit.user_id', auth()->user()->id)
                        ->where('jadwal_audit.status', "aktif")
                        ->orderBy('jadwal_audit.tglAudit', 'desc')
                        ->get();
                        
                $selectUserpivot = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        // ->where('users_jadwalaudit.user_id', auth()->user()->id)
                        ->where('jadwal_audit.status', "aktif")
                        ->get();

                if($pivot){
                    $scheduling = $pivot;
                    $selectUserpivot;
                }else{
                    $scheduling = [];
                }
                        
                // dd($selectUserpivot);
                
                
                
                // $users = User::with('jadwalAudit')->get();
                // foreach($users->users as $tes){
                //     if($tes->id == auth()->user()->id){
                //         $scheduling[] = $users;
                //     }
                    
                // }
                // dd($scheduling);
                // $cek = jadwalAudit::with('users')->get();
                // if($cek->count() > 0){
                //     foreach($cek as $cekk){
                //         dd($cekk);
                //         if($cekk->count() > 0){
                //             foreach($cekk->users as $tes){
                //                 if($tes->id == auth()->user()->id){
                //                     $scheduling[] = $cekk;
                //                 // }
                //                 }else{
                //                     // $scheduling[] = $cekk;
                //                     $scheduling = array();
                //                 }
                //             }
                //         }else{
                //             $scheduling = array();
                //         } 
                //     }
                // }else{
                //     $scheduling = array();
                // }
                // dd($scheduling);
            }
            
            //laporan
            if (auth()->user()->role_id == 1){
                // $auditReports = laporanAudit::
                //                 with(['jadwalAudit' => function ($query) {
                //                     $query->where('status','aktif');
                //                 }])->orderBy('created_at', 'desc')->get();
                $auditReports = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                                ->where('jadwal_audit.status', "aktif")
                                ->orderBy('laporan_audit.created_at', 'desc')
                                ->get();
                $jadwalaudits = jadwalAudit::where('status','aktif')->get();
                
            }else{
                $pivot = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->where('users_jadwalaudit.user_id', auth()->user()->id)
                        ->where('jadwal_audit.status', "aktif")
                        ->orderBy('laporan_audit.created_at', 'desc')
                        ->get();
                        
                $pivot1 = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        // ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->where('users_jadwalaudit.user_id', auth()->user()->id)
                        ->where('jadwal_audit.status', "aktif")
                        ->get()
                        ->groupBy('jadwal_id');
                if($pivot){
                    $auditReports = $pivot;
                    $jadwalaudits = $pivot1;
                }else{
                    $auditReports = [];
                    $jadwalaudits = [];
                }

                // $cek = laporanAudit::with('jadwalAudit')->get();
                // if($cek->count() > 0){
                //     foreach($cek as $cekk){
                //         if($cekk->count() > 0){
                //             foreach($cekk->jadwalAudit->users as $tes){
                //                 if($tes->id == auth()->user()->id){
                //                     $auditReports[] = $cekk;
                //                 // }
                //                 }else{
                //                     // $auditReports[] = $cekk;
                //                     $auditReports = array();
                //                 }
                //             }
                //         }else{
                //             $auditReports = array();
                //         }
                //     }
                // }else{
                //     $auditReports = array();
                // }
                
                // $cekjadwal = jadwalAudit::with('users')->where('status', '=','aktif')->get();
                // if($cekjadwal->count() > 0){
                //     foreach($cekjadwal as $cekkk){
                //         if($cekk->count() > 0){
                //             foreach($cekkk->users as $tes1){
                //                 if($tes1->id == auth()->user()->id){
                //                     $jadwalaudits[] = $cekkk;
                //                 }
                //                 // }else{
                //                 //     $jadwalaudits[] = $cekk;
                //                 //     $jadwalaudits = array();
                //                 // }
                //             }
                //         }else{
                //             $jadwalaudits = array();
                //         }
                //     }
                // }else{
                //     $jadwalaudits = array();
                // }
            }
            
            $audits = jadwalAudit::get();


            //CAR
            if (auth()->user()->role_id == 1){
                // $CARs = CAR::where('status', "open")->orderBy('created_at', 'desc')->get();
                $CARs = DB::table('jadwal_audit')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
                        ->where('jadwal_audit.status', "aktif")
                        ->whereIn('laporan_audit.kategoriTemuan', ["AOC","NC"])
                        ->whereIn('car.status', ["open","process"])
                        ->orderBy('car.created_at', 'desc')
                        ->get();
                $laporanaudits = DB::table('jadwal_audit')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->where('jadwal_audit.status', "aktif")
                        ->whereIn('laporan_audit.kategoriTemuan', ["AOC","NC"])
                        ->get()
                        ->groupBy('audit_id');
                // laporanAudit::where('jadwal_audit.status', "aktif")->get();
                $exportBahanTM = laporanAudit::get();               
            }else{
                $pivot = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
                        ->where('users_jadwalaudit.user_id', auth()->user()->id)
                        ->where('jadwal_audit.status', "aktif")
                        ->whereIn('laporan_audit.kategoriTemuan', ["AOC","NC"])
                        ->whereIn('car.status', ["open","process"])
                        ->orderBy('car.created_at', 'desc')
                        ->get();

                $pivot1 = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->where('users_jadwalaudit.user_id', auth()->user()->id)
                        ->where('jadwal_audit.status', "aktif")
                        ->whereIn('laporan_audit.kategoriTemuan', ["AOC","NC"])
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
                        ->where('jadwal_audit.status', "aktif")
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

                // $cek = CAR::with('laporanAudit')->get();
                // if($cek->count() > 0){
                //     foreach($cek as $cekk){
                //         if($cekk->count() > 0){
                //             foreach($cekk->laporanAudit->jadwalAudit->users as $tes){
                //                 if($tes->id == auth()->user()->id){
                //                     $CARs[] = $cekk; 
                //                 // }
                //                 }else{
                //                     // $CARs[] = $cekk; 
                //                     $CARs = array();
                //                 }
                //             }
                //         }else{
                //             $CARs = array();
                //         }
                //     }
                // }else{
                //     $CARs = array();
                // }
                
                // $cekjadwal = laporanAudit::with('jadwalAudit')->get();
                // if($cekjadwal->count() > 0){
                //     foreach($cekjadwal as $cekk){
                //         if($cekk->count() > 0){
                //             foreach($cekk->jadwalAudit->users as $tes1){
                //                 if($tes1->id == auth()->user()->id){
                //                     $laporanaudits[] = $cekk;
                //                 // }
                //                 }else{
                //                     // $laporanaudits[] = $cekk;
                //                     $laporanaudits = array();
                //                 }
                //             }
                //         }else{
                //             $laporanaudits = array();
                //         }
                //     }
                // }else{
                //     $laporanaudits = array();
                // }
            }         
            
            $Audits = laporanAudit::get();

            // return redirect()->to('AMI#jadwalAMI')->with([
            //     'unitKerja' => $unitKerja,
            //     'users' => $users,
            //     'selectUserpivot' => $selectUserpivot,
            //     'scheduling' => $scheduling,
            //     'periode' => $periode,
            //     'TM' => $TM,
            //     'audits' => $audits,
            //     'jadwalaudits' => $jadwalaudits,
            //     'CARs' => $CARs,
            //     'Audits' => $Audits,
            //     'laporanaudits' => $laporanaudits,
            //     'exportBahanTM' => $exportBahanTM,
            // ]);
            // dd($CARs);
            return view('menu.AMI', compact('unitKerja', 'users', 'selectUserpivot', 'scheduling', 'periode', 'TM', 'auditReports', 'audits', 'jadwalaudits', 'CARs', 'Audits', 'laporanaudits', 'exportBahanTM', 'standars'));

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
