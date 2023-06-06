<?php

namespace App\Http\Controllers\menu\mainMenu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//Main Model
use App\Models\renstras;
use App\Models\renops;
use App\Models\kinerjaUnit;
use App\Models\buktiKinerja;
use App\Models\dokumenInduk;
use App\Models\dokumenChecklist;

//Second Model
use App\Models\unitKerjas;
use App\Models\jadwalAudit;

class renstraRenop extends Controller
{
    public function index()
    {
        try{
            //Dokumen Induk
            $dokInduk = dokumenInduk::where('status', "aktif")->orderBy('created_at', 'desc')->get();

            //Dokumen Checklist
            if(auth()->user()->role_id == 3){
                $dokCheck = dokumenChecklist::where('unitkerja_id', auth()->user()->unitkerja_id)->where('status', "aktif")->orderBy('created_at', 'desc')->get();
            }else{
                $dokCheck = dokumenChecklist::where('status', "aktif")->orderBy('created_at', 'desc')->get();
            }

            //Resntra
            // if(auth()->user()->role_id == 3 || auth()->user()->role_id == 2){
            //     $renstra = renstras::with(['dokumenInduk', 'renop'])->where('status', "aktif")->orderBy('created_at', 'desc')->get();
            // }else{
            //     $renstra = renstras::with(['dokumenInduk', 'renop'])->where('status', "aktif")->orderBy('created_at', 'desc')->get();
            // }    
            $renstra = renstras::with(['dokumenInduk', 'renop'])->where('status', "aktif")->orderBy('created_at', 'desc')->get();
            

            //Renop
            if(auth()->user()->role_id == 3 || auth()->user()->role_id == 2){
                $dokAcuans = renstras::with(['dokumenInduk', 'renop'])->where('status', 'aktif')->orderBy('created_at', 'desc')->get();
                // $renop = renops::with('renstra')->where('unitkerja_id', auth()->user()->unitkerja_id)->where('status', 'aktif')->get(); 
                $renop = DB::table('renop_renstra')
                    ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                    ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                    ->select('renop.*', 'renstra.id', 'renstra.jenis', 'renop_renstra.renop_id')
                    ->where('renstra.status', "aktif")
                    ->where('renop.status', "aktif")
                    ->where('renop.unitkerja_id', auth()->user()->unitkerja_id)
                    ->orderBy('renop.created_at', 'desc')
                    ->get();
            // }elseif(auth()->user()->role_id == 2){
            //     $cek = jadwalAudit::with('users')->get();
            //     // dd($cek);
            //     if($cek->count() > 0){
            //         foreach($cek as $cekk){
            //             if($cekk->count() > 0){
            //                 foreach($cekk->users as $tes){
            //                     if($tes->id == auth()->user()->id){
            //                         $scheduling[] = $cekk->unitkerja_id;
            //                     // }
            //                     }else{
            //                         $scheduling = array();
            //                     }
            //                 }
            //             }else{
            //                 $scheduling = array();
            //             }
            //         }
            //     }else{
            //         $scheduling = array();
            //     }
            //     // dd($scheduling);
            //     $renop = renops::with('renstra')->whereIn('unitkerja_id', $scheduling)->get(); 
            //     if($renop->count() > 0){
            //         foreach($renop as $renstra){
            //             $dokAcuans[] = $renstra;
            //         }
            //     }else{
            //         $dokAcuans = [];
            //     }
                // dd($dokAcuans);
            }else{
                $dokAcuans = renstras::with(['dokumenInduk', 'renop'])->where('status', 'aktif')->orderBy('created_at', 'desc')->get();
                // $renop = renops::with('renstra')->where('status', 'aktif')->get(); 
                $renop = DB::table('renop_renstra')
                        ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                        ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                        ->select('renop.*', 'renstra.id', 'renstra.jenis', 'renop_renstra.renop_id')
                        ->where('renstra.status', "aktif")
                        ->where('renop.status', "aktif")
                        ->orderBy('renop.created_at', 'desc')
                        ->get();
            }          
            //Kinterja & Bukti
            if(auth()->user()->role_id == 1){
                // $kinerja = kinerjaUnit::where('status', "aktif")->orderBy('created_at', 'desc')->get();
                // $bukti = buktiKinerja::where('status', "aktif")->orderBy('created_at', 'desc')->get();

                $kinerja = DB::table('renop_renstra')
                        ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                        ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                        ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                        ->select('kinerja_unit.*', 'renop_renstra.renop_id')
                        ->where('renstra.status', "aktif")
                        ->where('renop.status', "aktif")
                        ->where('kinerja_unit.status', "aktif")
                        ->orderBy('kinerja_unit.created_at', 'desc')
                        ->get();

                $bukti = DB::table('renop_renstra')
                        ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                        ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                        ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                        ->join('bukti_kinerja', 'kinerja_unit.id', '=', 'bukti_kinerja.kinerjaUnit_id')
                        ->select('bukti_kinerja.*')
                        ->where('renstra.status', "aktif")
                        ->where('renop.status', "aktif")
                        ->where('kinerja_unit.status', "aktif")
                        ->where('bukti_kinerja.status', "aktif")
                        ->orderBy('bukti_kinerja.created_at', 'desc')
                        ->get();
            }else{
                $kinerja = DB::table('renop_renstra')
                        ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                        ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                        ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                        ->select('kinerja_unit.*', 'renop_renstra.renop_id')
                        ->where('renop.unitkerja_id', auth()->user()->unitkerja_id)
                        ->where('renstra.status', "aktif")
                        ->where('renop.status', "aktif")
                        ->where('kinerja_unit.status', "aktif")
                        ->orderBy('kinerja_unit.created_at', 'desc')
                        ->get();

                $bukti = DB::table('renop_renstra')
                        ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                        ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                        ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                        ->join('bukti_kinerja', 'kinerja_unit.id', '=', 'bukti_kinerja.kinerjaUnit_id')
                        ->select('bukti_kinerja.*')
                        ->where('renop.unitkerja_id', auth()->user()->unitkerja_id)
                        ->where('renstra.status', "aktif")
                        ->where('renop.status', "aktif")
                        ->where('kinerja_unit.status', "aktif")
                        ->where('bukti_kinerja.status', "aktif")
                        ->orderBy('bukti_kinerja.created_at', 'desc')
                        ->get();
                        
                        // dd($bukti);
            }
            $dadakanrenop = DB::table('renop')->get();
            $dadakankinerja = DB::table('kinerja_unit')->get();

            // }elseif(auth()->user()->role_id == 2){
            //     // $renop = kinerjaUnit::with('renops')->get();
            //     // dd($renop);
            //     $cek = jadwalAudit::with('users')->get();
            //     // dd($cek);
            //     if($cek->count() > 0){
            //         foreach($cek as $cekk){
            //             foreach($cekk->users as $tes){
            //                 if($tes->id == auth()->user()->id){
            //                     $scheduling[] = $cekk->unitkerja_id;
            //                 }
            //                 // }else{
            //                 //     $scheduling = array();
            //                 // }
            //             }
            //         }
            //     }else{
            //         $scheduling = array();
            //     }
            //     $kinerja = kinerjaUnit::with('renops')->where('unitkerja_id', $scheduling)->where('status', "aktif")->orderBy('created_at', 'desc')->get();
            //     $bukti = buktiKinerja::with('kinerjaUnit')->where('unitkerja_id', $scheduling)->where('status', "aktif")->orderBy('created_at', 'desc')->get();
            // }else{
            //     $kinerja = kinerjaUnit::with('renops')
            //         ->whereHas('renops', function($q){
            //             $q->select('id','unitkerja_id');
            //             $q->where('unitkerja_id', auth()->user()->unitkerja_id);
            //         })
            //         ->where('status', "aktif")
            //         ->orderBy('created_at', 'desc')
            //         ->get();
            //     $bukti = buktiKinerja::with('kinerjaUnit')
            //         ->whereHas('kinerjaUnit', function($q){
            //             // $q->select('id','unitkerja_id');
            //             $q->where('unitkerja_id', auth()->user()->unitkerja_id);
            //         })
            //         ->where('status', "aktif")
            //         ->orderBy('created_at', 'desc')
            //         ->get();
            //     // $bukti = buktiKinerja::with('kinerjaUnit')->get();
            //     // dd($bukti);
            // }

            $unitKerja = unitKerjas::all();

            return view('menu.renstraRenop', compact('renstra', 'dokAcuans', 'renop', 'kinerja', 'bukti', 'dokInduk', 'dokCheck', 'unitKerja', 'dadakanrenop', 'dadakankinerja'));
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

}
