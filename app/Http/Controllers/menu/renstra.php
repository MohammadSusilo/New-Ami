<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//Main Model
use App\Models\renstras;
use App\Models\renops;
use App\Models\kinerjaUnit;
use App\Models\buktiKinerja;
use App\Models\dokumenInduk;

//Second Model
use App\Models\unitKerjas;


class renstra extends Controller
{
    // public function index()
    // {
    //     $renstra = renstras::with('dokumenInduk')->get();
    //     return view('menu.renstra.index', compact('renstra'));
    // }

    // public function renstraRenop()
    // {
    //     $renstra = renstras::with('dokumenInduk')->get();
    //     $renop = renops::with('renstra')->get();
    //     $kinerja = kinerjaUnit::get();
    //     $bukti = buktiKinerja::get();
    //     $dokInduk = dokumenInduk::get();
    //     $unitKerja = unitKerjas::all();

    //     return view('menu.renstraRenop', compact('renstra', 'renop', 'kinerja', 'bukti', 'dokInduk', 'unitKerja'));
    // }

    public function history()
    {
        $renstra = renstras::with(['dokumenInduk', 'renop'])->where('status', "nonaktif")->orderBy('created_at', 'desc')->get();

        return view('menu.renstra.history', compact('renstra'));
    }

    public function create()
    {
        $renop = renops::get();
        $dokumenInduk = dokumenInduk::all();
        return view('menu.renstra.create', compact('dokumenInduk', 'renop'));
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $valid = [
                'kode' => 'required|min:3|max:10',
                'deskripsi' => 'min:3|max:255',
                'target' => 'required|numeric',
                'unit_target' => 'required|numeric',
                'tipe_indikator' => 'required',
                'tahun' => 'numeric',
                'dokumen_id' => 'required', 
                'jenis' => 'required',
            ];

            $request->validate($valid);
            $renstra = renstras::create($request->all());

            return redirect()->route('renstra.show', $renstra->id)->with('success', 'Dokumen Acuan berhasil ditambah');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function renstraSaveMulti(Request $request)
    {
        try{
            // dd($request->addmore);
            foreach ($request->addmore as $key => $value) {
                if ($value['kode'] != null){
                    if ($value['target'] != null){
                        if ($value['unit_target'] != null){
                            if ($value['tipe_indikator'] != null){
                                if ($value['dokumen_id'] != null){
                                    if ($value['jenis'] != null){
                                    renstras::create($value);
                                    }else{
                                        return back()->with('error', 'Jenis Dokumen wajib di isi, Dokumen Acuan gagal ditambah');
                                    }
                                }else{
                                    return back()->with('error', 'File Dokumen wajib di isi, Dokumen Acuan gagal ditambah');
                                }
                            }else{
                                return back()->with('error', 'Tipe Indikator wajib di isi, Dokumen Acuan gagal ditambah');
                            }
                        }else{
                            return back()->with('error', 'Unit Target wajib di isi, Dokumen Acuan gagal ditambah');
                        }
                    }else{
                        return back()->with('error', 'Target wajib di isi, Dokumen Acuan gagal ditambah');
                    }
                }else{
                    return back()->with('error', 'Kode Dokumen Acuan wajib di isi, Dokumen Acuan gagal ditambah');
                }
            }
        
            return back()->with('success', 'Dokumen Acuan berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function show($id)
    {
        try{
            $renstra = renstras::with('renop')->findOrFail($id);
            $dokumenInduk = dokumenInduk::get();
            
            return view('menu.renstra.show', compact('renstra', 'dokumenInduk'));

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function edit($id)
    {

        $dokumenInduk = dokumenInduk::get();
        $renstra = renstras::with('renop', 'dokumenInduk')->findOrFail($id);

        return view('menu.renstra.edit', compact('renstra', 'dokumenInduk'));
    }

    public function update(Request $request, $id)
    {
        try{
            // dd($request);
            $valid = [
                'kode' => 'required|min:3|max:10',
                'deskripsi' => 'min:3|max:255',
                'target' => 'required|numeric',
                'unit_target' => 'required|numeric',
                'tipe_indikator' => 'required',
                'tahun' => 'numeric',
                'dokumen_id' => 'required',                            
                'jenis' => 'required', 
            ];

            $request->validate($valid);
            $renstra = renstras::findOrFail($id);
            // $renstra->update($request->all());

            if($request->status == "aktif"){
                $renstra->update($request->all());
                DB::table('renop_renstra')
                            ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                            ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                            ->select('renop.*', 'renop_renstra.renstra_id')
                            ->where('renstra.id', $id)
                            ->update(array('renop.status' => "aktif"));
                DB::table('renop_renstra')
                            ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                            ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                            ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                            ->select('kinerja_unit.*', 'renop_renstra.renstra_id', 'kinerja_unit.renop_id')
                            ->where('renstra.id', $id)
                            ->update(array('kinerja_unit.status' => "aktif"));
                DB::table('renop_renstra')
                            ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                            ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                            ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                            ->join('bukti_kinerja', 'kinerja_unit.id', '=', 'bukti_kinerja.kinerjaUnit_id')
                            ->select('bukti_kinerja.*', 'renop_renstra.renstra_id', 'kinerja_unit.renop_id','bukti_kinerja.kinerjaUnit_id')
                            ->where('renstra.id', $id)
                            ->update(array('bukti_kinerja.status' => "aktif"));
            }else{
                $renstra->update($request->all());
                DB::table('renop_renstra')
                            ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                            ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                            ->select('renop.*', 'renop_renstra.renstra_id')
                            ->where('renstra.id', $id)
                            ->update(array('renop.status' => "nonaktif"));
                DB::table('renop_renstra')
                            ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                            ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                            ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                            ->select('kinerja_unit.*', 'renop_renstra.renstra_id', 'kinerja_unit.renop_id')
                            ->where('renstra.id', $id)
                            ->update(array('kinerja_unit.status' => "nonaktif"));
                DB::table('renop_renstra')
                            ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                            ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                            ->join('kinerja_unit', 'renop.id', '=', 'kinerja_unit.renop_id')
                            ->join('bukti_kinerja', 'kinerja_unit.id', '=', 'bukti_kinerja.kinerjaUnit_id')
                            ->select('bukti_kinerja.*', 'renop_renstra.renstra_id', 'kinerja_unit.renop_id','bukti_kinerja.kinerjaUnit_id')
                            ->where('renstra.id', $id)
                            ->update(array('bukti_kinerja.status' => "nonaktif"));
            }

            return redirect()->route('renstra.show', $renstra->id)->with('success', 'Dokumen Acuan berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }        
    }

    public function destroy($id)
    {
        try{
            $renstra = renstras::findOrFail($id);
            $renstra->renop()->detach();
            $renstra->delete();

            return back()->with('success', 'Dokumen Acuan berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }      
    }
}
