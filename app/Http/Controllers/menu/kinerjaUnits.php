<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\renops;
use App\Models\renstras;
use App\Models\unitKerjas;
use App\Models\kinerjaUnit;

use App\Models\jadwalAudit;

class kinerjaUnits extends Controller
{
    public function history()
    {
        $renop = renops::with('renstra')->get(); 

        if(auth()->user()->role_id == 1){
            // $kinerja = kinerjaUnit::where('status', "nonaktif")->orderBy('created_at', 'desc')->get();
            $kinerja = DB::table('renop_renstra')
                    ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                    ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                    ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                    ->select('kinerja_unit.*', 'renop_renstra.renop_id')
                    ->where('renstra.status', "nonaktif")
                    ->where('renop.status', "aktif")
                    ->orWhere('renop.status', "nonaktif")
                    ->orderBy('renop.created_at', 'desc')
                    ->get();

        }else{
            $cek = jadwalAudit::with('users')->get();
            if($cek->count() > 0){
                foreach($cek as $cekk){
                    foreach($cekk->users as $tes){
                        if($tes->id == auth()->user()->id){
                            $scheduling[] = $cekk->unitkerja_id;
                        }
                        // }else{
                        //     $scheduling = array();
                        // }
                    }
                }
            }else{
                $scheduling = array();
            }
            
            $kinerja = DB::table('renop_renstra')
                    ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                    ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                    ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                    ->select('kinerja_unit.*', 'renop_renstra.renop_id')
                    ->where('renop.unitkerja_id', $scheduling)
                    ->where('renstra.status', "nonaktif")
                    ->where('renop.status', "aktif")
                    ->orWhere('renop.status', "nonaktif")
                    ->orderBy('renop.created_at', 'desc')
                    ->get();
        }

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
        //     $kinerja = kinerjaUnit::with('renops')->where('unitkerja_id', $scheduling)->where('status', "nonaktif")->orderBy('created_at', 'desc')->get();
        // }else{
        //     $kinerja = kinerjaUnit::with('renops')
        //         ->whereHas('renops', function($q){
        //             $q->select('id','unitkerja_id');
        //             $q->where('unitkerja_id', auth()->user()->unitkerja_id);
        //         })
        //         ->where('status', "nonaktif")
        //         ->orderBy('created_at', 'desc')
        //         ->get();
        // }

        return view('menu.kinerjaUnit.history', compact('kinerja','renop'));
        
    }

    public function create()
    {
        $renop = DB::table('unitkerja')->join('renop', 'renop.unitkerja_id', '=', 'unitkerja.id')->get();
        return view('menu.kinerjaUnit.create', compact('renop'));
        
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $valid = [
                'renop_id' => 'required',
                'deskripsi' => 'min:3|max:255',
                'nilaiCapaian' => 'required|numeric',
                'unitCapaian' => 'required|numeric',
                'tahun' => 'numeric',                          
            ];

            $request->validate($valid);

            $renop = DB::table('unitkerja')->join('renop', 'renop.unitkerja_id', '=', 'unitkerja.id')->where('renop.id', $request->renop_id)->first();
            $valid = [
                'renop_id' => 'required|min:3|max:191',
            ];
            $request->merge(['unitkerja_id' => $renop->unitkerja_id]);
            
            $kinerjaUnit = kinerjaUnit::create($request->all());

            return redirect()->route('kinerjaUnit.show', $kinerjaUnit->id)->with('success', 'Kinerja Unit berhasil ditambah');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function kinerjaUnitSaveMulti(Request $request)
    {
        // dd($request);
        try{
            foreach ($request->addmore as $key => $value) {
                if ($value['renop_id'] != null){
                    if ($value['nilaiCapaian'] != null){
                        if ($value['unitCapaian'] != null){
                            $renop = DB::table('unitkerja')->join('renop', 'renop.unitkerja_id', '=', 'unitkerja.id')->where('renop.id', $value['renop_id'])->first();
                            $value['unitkerja_id'] = $renop->unitkerja_id;

                            kinerjaUnit::create($value);
                        }else{
                            return back()->with('error', 'Unit Target wajib di isi, Renstra gagal ditambah');
                        }
                    }else{
                        return back()->with('error', 'Target wajib di isi, Renstra gagal ditambah');
                    }
                }else{
                    return back()->with('error', 'Kode Renstra wajib di isi, Renstra gagal ditambah');
                }
            }
        
            return back()->with('success', 'Kinerja Unit berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
        
        // foreach ($request->addmore as $key => $value) {
        //     $renop = DB::table('unitkerja')->join('renop', 'renop.unitkerja_id', '=', 'unitkerja.id')->where('renop.id', $value['renop_id'])->first();
        //     // dd($renop->unitkerja_id);
        //     // array_merge($renop->unitkerja_id,$value);
        //     $value['unitkerja_id'] = $renop->unitkerja_id;
        //     // dd($value);
        //     kinerjaUnit::create($value);
        // }
        // return back()->with('messages', 'Kinerja Unit berhasil ditambah');
    }

    public function show($id)
    {
        $kinerjaUnit = kinerjaUnit::findOrFail($id);
        $unitKerja = unitKerjas::get();
        $renop = renops::get();
        return view('menu.kinerjaUnit.show', compact('kinerjaUnit', 'unitKerja', 'renop'));
    }

    public function edit($id)
    {
        $kinerjaUnit = kinerjaUnit::findOrFail($id);
        $unitKerja = unitKerjas::get();
        $renop = renops::get();
        return view('menu.kinerjaUnit.edit', compact('kinerjaUnit', 'unitKerja', 'renop'));
    }

    public function update(Request $request, $id)
    {
        try{
            // dd($request);
            $valid = [
                'renop_id' => 'required',
                'deskripsi' => 'min:3|max:255',
                'nilaiCapaian' => 'required|numeric',
                'unitCapaian' => 'required|numeric',
                'tahun' => 'numeric',                          
            ];

            $request->validate($valid);
            $renop = DB::table('unitkerja')->join('renop', 'renop.unitkerja_id', '=', 'unitkerja.id')->where('renop.id', $request->renop_id)->first();
            $kinerjaUnit = kinerjaUnit::findOrFail($id);

            if($kinerjaUnit->renop_id != $request->renop_id){
                $request->merge(['unitkerja_id' => $renop->unitkerja_id]);
            }

            $kinerjaUnit->update($request->all());
            
            return redirect()->route('kinerjaUnit.show', $kinerjaUnit->id)->with('success', 'Kinerja Unit berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $kinerjaUnit = kinerjaUnit::findOrFail($id);
            $kinerjaUnit->delete();

            return back()->with('success', 'Kinerja Unit berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
