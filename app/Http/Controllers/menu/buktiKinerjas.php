<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;

use App\Models\renops;
use App\Models\unitKerjas;
use App\Models\kinerjaUnit;
use App\Models\buktiKinerja;

class buktiKinerjas extends Controller
{
    public function history()
    {
        $renop = renops::with('renstra')->get(); 
        $kinerja = kinerjaUnit::get();

        if(auth()->user()->role_id == 1){
            // $kinerja = kinerjaUnit::where('status', "nonaktif")->orderBy('created_at', 'desc')->get();
            // $bukti = buktiKinerja::where('status', "nonaktif")->orderBy('created_at', 'desc')->get();
            // $kinerja = DB::table('renop_renstra')
            //         ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
            //         ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
            //         ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
            //         ->select('kinerja_unit.*', 'renop_renstra.renop_id')
            //         ->where('renstra.status', "aktif")
            //         ->where('renop.status', "aktif")
            //         ->orderBy('renop.created_at', 'desc')
            //         ->get();
            //         // dd($kinerja);

            $bukti = DB::table('renop_renstra')
                    ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                    ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                    ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                    ->join('bukti_kinerja', 'kinerja_unit.id', '=', 'bukti_kinerja.kinerjaUnit_id')
                    ->select('bukti_kinerja.*','bukti_kinerja.kinerjaUnit_id')
                    ->where('renstra.status', "nonaktif")
                    ->where('renop.status', "nonaktif")
                    ->where('kinerja_unit.status', "nonaktif")
                    ->where('bukti_kinerja.status', "aktif")
                    ->orWhere('bukti_kinerja.status', "nonaktif")
                    ->orderBy('renop.created_at', 'desc')
                    ->get();
                    // dd($bukti);
        }else{
            $cek = jadwalAudit::with('users')->get();
            // dd($cek);
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

            // $kinerja = DB::table('renop_renstra')
            //         ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
            //         ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
            //         ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
            //         ->select('kinerja_unit.*', 'renop_renstra.renop_id')
            //         ->where('renop.unitkerja_id', auth()->user()->unitkerja_id)
            //         ->where('renstra.status', "aktif")
            //         ->where('renop.status', "aktif")
            //         ->orderBy('renop.created_at', 'desc')
            //         ->get();

            $bukti = DB::table('renop_renstra')
                    ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                    ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                    ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                    ->join('bukti_kinerja', 'kinerja_unit.id', '=', 'bukti_kinerja.kinerjaUnit_id')
                    ->select('bukti_kinerja.*', 'bukti_kinerja.kinerjaUnit_id')
                    ->where('renop.unitkerja_id', auth()->user()->unitkerja_id)
                    ->where('renstra.status', "nonaktif")
                    ->where('renop.status', "nonaktif")
                    ->where('kinerja_unit.status', "nonaktif")
                    ->where('bukti_kinerja.status', "aktif")
                    ->orWhere('bukti_kinerja.status', "nonaktif")
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
        //     $bukti = buktiKinerja::with('kinerjaUnit')->where('unitkerja_id', $scheduling)->where('status', "nonaktif")->orderBy('created_at', 'desc')->get();
        // }else{
        //     $kinerja = kinerjaUnit::with('renops')
        //         ->whereHas('renops', function($q){
        //             $q->select('id','unitkerja_id');
        //             $q->where('unitkerja_id', auth()->user()->unitkerja_id);
        //         })
        //         ->where('status', "nonaktif")
        //         ->orderBy('created_at', 'desc')
        //         ->get();
        //     $bukti = buktiKinerja::with('kinerjaUnit')
        //         ->whereHas('kinerjaUnit', function($q){
        //             // $q->select('id','unitkerja_id');
        //             $q->where('unitkerja_id', auth()->user()->unitkerja_id);
        //         })
        //         ->where('status', "nonaktif")
        //         ->orderBy('created_at', 'desc')
        //         ->get();
        //     // $bukti = buktiKinerja::with('kinerjaUnit')->get();
        //     // dd($bukti);
        // }

        return view('menu.buktiKinerja.history', compact('bukti', 'renop', 'kinerja'));
    }

    public function create()
    {
        $renop = DB::table('unitkerja')->join('renop', 'renop.unitkerja_id', '=', 'unitkerja.id')->get();
        $kinerjaUnit = kinerjaUnit::get();
        return view('menu.buktiKinerja.create', compact('renop', 'kinerjaUnit'));
    }
    
    public function buktinew($id)
    {
        // dd($id);
        $renop = DB::table('unitkerja')->join('renop', 'renop.unitkerja_id', '=', 'unitkerja.id')->get();
        $kinerjaUnit = kinerjaUnit::get();
        $idKU = $id;
        return view('menu.buktiKinerja.create', compact('renop', 'kinerjaUnit', 'idKU'));
    }

    public function buktinewMulti($id)
    {
        // dd($id);
        $renop = DB::table('unitkerja')->join('renop', 'renop.unitkerja_id', '=', 'unitkerja.id')->get();
        $kinerjaUnit = kinerjaUnit::get();
        $idKU = $id;
        return view('menu.buktiKinerja.createMulti', compact('renop', 'kinerjaUnit', 'idKU'));
    }

    public function buktilist($id)
    {
        // dd($id);
        $renop = DB::table('unitkerja')->join('renop', 'renop.unitkerja_id', '=', 'unitkerja.id')->get();
        $buktiKinerja = buktiKinerja::where('kinerjaUnit_id', $id)->get();
        $kinerjaUnit = kinerjaUnit::get();
        $idKU = $id;
        return view('menu.buktiKinerja.list', compact('buktiKinerja', 'renop', 'kinerjaUnit', 'idKU'));
    }

    public function store(Request $request)
    {
        // dd($request);
        try{
            $valid = [
                'namaBukti' => 'required|min:3|max:50',
                'deskripsi' => 'min:3|max:255',
                'lokDokBukti' => 'required|mimes:pdf,jpg,jpeg,png',
            ];

            $request->validate($valid);
        
            
            $kinerjaUnit = DB::table('kinerja_unit')->where('id', $request->kinerjaUnit_id)->first();
            // dd($kinerjaUnit);
            $unitKerja = unitKerjas::get();
            foreach($unitKerja as $UK){
                if($UK->id == $kinerjaUnit->unitkerja_id){
                    $nameUK = $UK->namaRepo;
                    // dd($nameUK);
                }
            }
            // dd($nameUK);

            if(!empty($request->hasfile('lokDokBukti'))){
                $file  = $request->file('lokDokBukti');
                if($file->getSize() <= 3145728){
                    $fileName   = $file->getClientOriginalName();
                    $date = \Carbon\Carbon::now()->format('Y');
                    $request->file('lokDokBukti')->move($nameUK."/"."BuktiKinerja"."/".$date."/",$fileName);
                    $fileBukti = $nameUK."/"."BuktiKinerja"."/".$date."/".$fileName;

                }else{
                    return back()->with('error', 'File dokumen terlalu besar dari 3 MB, Dokumen Induk gagal ditambah');
                }
            }

            $buktiKinerja = buktiKinerja::create([
                'unitkerja_id' => $kinerjaUnit->unitkerja_id,
                'renop_id'=> $kinerjaUnit->renop_id,
                'kinerjaUnit_id'=> $kinerjaUnit->id,
                'namaBukti'=> $request->namaBukti,
                'deskripsi'=> $request->deskripsi,
                'tahun'=> $request->tahun,
                'status'=> $request->status,
                'lokDokBukti' => $fileBukti,
            ]);

            
            return redirect()->route('buktiKinerja.show', $buktiKinerja->id)->with('success', 'Bukti Kinerja berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function buktiKinerjaSaveMulti(Request $request)
    {
        try{
            // dd($request);
            foreach ($request->addmore as $key => $value) {
                if ($value['namaBukti'] != null){
                    if (!empty($value['lokDokBukti'])){
                        if($value['lokDokBukti']->getClientOriginalExtension() != "pdf" || $value['lokDokBukti']->getClientOriginalExtension() != "jpg" || $value['lokDokBukti']->getClientOriginalExtension() != "jpeg" || $value['lokDokBukti']->getClientOriginalExtension() != "png"){
                            if($value['lokDokBukti']->getSize() <= 3145728){
                                $kinerjaUnit = DB::table('kinerja_unit')->where('id', $request->kinerjaUnit_id)->first();
                                $value['unitkerja_id'] = $kinerjaUnit->unitkerja_id;
                                $value['renop_id'] = $kinerjaUnit->renop_id;
                                $value['id'] = $kinerjaUnit->id;
                                // dd($value);
                                $unitKerja = unitKerjas::get();
                                foreach($unitKerja as $UK){
                                    if($UK->id == $kinerjaUnit->unitkerja_id){
                                        $nameUK = $UK->namaRepo;
                                        // dd($nameUK);
                                    }
                                }
                
                                $file  = $value['lokDokBukti'];
                                // dd($file);
                                $fileName   = $file->getClientOriginalName();
                                $date = \Carbon\Carbon::now()->format('Y');
                                $value['lokDokBukti']->move($nameUK."/"."BuktiKinerja"."/".$date."/",$fileName);
                                $fileBukti = $nameUK."/"."BuktiKinerja"."/".$date."/".$fileName;
                                    
                                buktiKinerja::create([                
                                    'unitkerja_id' => $value['unitkerja_id'],
                                    'renop_id'=> $value['renop_id'],
                                    'kinerjaUnit_id'=> $value['id'],
                                    'namaBukti'=> $value['namaBukti'],
                                    'deskripsi'=> $value['deskripsi'],
                                    'tahun'=> $value['tahun'],
                                    'status'=> $value['status'],
                                    'lokDokBukti' => $fileBukti,
                                ]);

                            }else{
                                return back()->with('error', 'File dokumen terlalu besar dari 3 MB, Dokumen Induk gagal ditambah');
                            }

                        }else{
                            return back()->with('error', 'File dokumen tidak sesuai dengan format, Dokumen Induk gagal ditambah');
                        }

                    }else{
                        return back()->with('error', 'File dokumen kosong, Dokumen Induk gagal ditambah');
                    }

                }else{
                    return back()->with('error', 'Nama bukti wajib diisi, Dokumen Induk gagal ditambah');
                }
            }

            return back()->with('success', 'Bukti Kinerja berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $buktiKinerja = buktiKinerja::findOrFail($id);
        $kinerjaUnit = kinerjaUnit::get();
        $unitKerja = unitKerjas::get();
        $renop = renops::get();
        return view('menu.buktiKinerja.show', compact('buktiKinerja', 'kinerjaUnit', 'unitKerja', 'renop'));
    }

    public function edit($id)
    {
        $buktiKinerja = buktiKinerja::findOrFail($id);
        $kinerjaUnit = kinerjaUnit::get();
        $unitKerja = unitKerjas::get();
        $renop = renops::get();
        return view('menu.buktiKinerja.edit', compact('buktiKinerja', 'kinerjaUnit', 'unitKerja', 'renop'));
    }

    public function update(Request $request, $id)
    {
        try{
        // dd($request);
            $valid = [
                'namaBukti' => 'required|min:3|max:50',
                'deskripsi' => 'min:3|max:255',
                // 'lokDokBukti' => 'required|mimes:pdf,jpg,jpeg,png',
            ];
    
            $request->validate($valid);
            // $renop = DB::table('unitkerja')->join('renop', 'renop.unitkerja_id', '=', 'unitkerja.id')->where('renop.id', $request->renop_id)->first();
            $kinerjaUnit = DB::table('kinerja_unit')->where('id', $request->kinerjaUnit_id)->first();
            // dd($kinerjaUnit);
            $unitKerja = unitKerjas::get();
            foreach($unitKerja as $UK){
                if($UK->id == auth()->user()->unitkerja_id){
                    $nameUK = $UK->namaRepo;
                }
            }
            $buktiKinerja = buktiKinerja::findOrFail($id);
            // dd($kinerjaUnit);
            
            $repUK = $kinerjaUnit->unitkerja_id;
            $repRN = $kinerjaUnit->renop_id;
            $repKU = $kinerjaUnit->id;
            // $request->merge(['unitkerja_id' => $repUK]);
            // $request->merge(['renop_id' => $repRN]);
            // $request->merge(['kinerjaUnit_id' => $repKU]);

            if(!empty($request->file('lokDokBukti'))){
                File::delete($buktiKinerja->lokDokBukti);
                $file  = $request->file('lokDokBukti');
                // dd($file);
                $fileName   = $file->getClientOriginalName();
                $date = \Carbon\Carbon::now()->format('Y');
                $request->file('lokDokBukti')->move($nameUK."/"."BuktiKinerja"."/".$date."/",$fileName);

                $fileBukti = $nameUK."/"."BuktiKinerja"."/".$date."/".$fileName;
                // dd($fileBukti);
                $request->merge(['lokDokBukti' => $fileBukti]);
            }else{
                $fileBukti = $buktiKinerja->lokDokBukti;
            }

            $buktiKinerja->update([
                'unitkerja_id' => $repUK,
                'renop_id'=> $repRN,
                'kinerjaUnit_id'=> $repKU,
                'namaBukti'=> $request->namaBukti,
                'deskripsi'=> $request->deskripsi,
                'tahun'=> $request->tahun,
                'status'=> $request->status,
                'lokDokBukti' => $fileBukti,
            ]);
            // $buktiKinerja->update($request->all());

            return redirect()->route('buktiKinerja.show', $buktiKinerja->id)->with('success', 'Bukti Kinerja berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $buktiKinerja = buktiKinerja::findOrFail($id);
            File::delete($buktiKinerja->lokDokBukti);
            $buktiKinerja->delete();

            return back()->with('success', 'Bukti Kinerja berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
