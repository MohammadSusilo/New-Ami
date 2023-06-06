<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\renops;
use App\Models\renstras;
use App\Models\unitKerjas;
use App\Models\kinerjaUnit;
use App\Models\buktiKinerja;

use App\Models\jadwalAudit;

class renop extends Controller
{
    // public function index()
    // {
    //     $renstra = renstras::with('dokumenInduk')->get();
    //     $renop = renops::with('renstra')->get();
    //     $kinerja = kinerjaUnit::get();
    //     $bukti = buktiKinerja::get();
    //     // $kinerja = kinerjaUnit::where('unitkerja_id', auth()->user()->unitkerja_id)->get();
    //     // $bukti = buktiKinerja::where('unitkerja_id', auth()->user()->unitkerja_id)->get();
    //     return view('menu.renop.index', compact('renstra', 'renop', 'kinerja', 'bukti'));
    // }

    public function history()
    {
        $renstra = renstras::with(['dokumenInduk', 'renop'])->where('status', "aktif")->orderBy('created_at', 'desc')->get();
        $dokAcuans = renstras::with(['dokumenInduk', 'renop'])->where('status', 'nonaktif')->orderBy('created_at', 'desc')->get();
        $renop = renstras::with(['dokumenInduk', 'renop'])->where('status', 'aktif')->orderBy('created_at', 'desc')->get();
        $unitKerja = unitKerjas::all();
        $kinerja = kinerjaUnit::where('status', "aktif")->orderBy('created_at', 'desc')->get();
        $bukti = buktiKinerja::where('status', "aktif")->orderBy('created_at', 'desc')->get();
        return view('menu.renop.history', compact('unitKerja', 'dokAcuans','renstra', 'renop', 'kinerja', 'bukti'));
    }

    public function renopreadhistory()
    {
        try{
            if(auth()->user()->role_id == 1){
                // $faqs = renops::with('renstra')->where('status', "aktif")->orderBy('created_at', 'desc')->get();
                $faqs = DB::table('renop_renstra')
                        ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                        ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                        ->select('renop.*', 'renstra.id', 'renstra.jenis', 'renop_renstra.renop_id')
                        ->where('renstra.status', "nonaktif")
                        ->orWhere('renop.status', "nonaktif")
                        ->orderBy('renop.created_at', 'desc')
                        ->get();

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

                $faqs = DB::table('renop_renstra')
                    ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                    ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                    ->select('renop.*', 'renstra.id', 'renstra.jenis', 'renop_renstra.renop_id')
                    ->where('renstra.status', "nonaktif")
                    ->orWhere('renop.status', "nonaktif")
                    ->where('renop.unitkerja_id', $scheduling)
                    ->orderBy('renop.created_at', 'desc')
                    ->get();
            }
            
            $kinerja = kinerjaUnit::get();
            $c = count($faqs);

            if($c == 0){
                return '<p class="text-muted"> Maaf data tidak ditemukan </p>';
            }else{
                return view('menu.renop.renoplist')->with([
                    'data' => $faqs,
                    'data1' => $kinerja
                    // 'user' => $user
                ]);
            }
            // return 'Silahkan melakukan pencarian data';
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function renopread()
    {
        try{
            if(auth()->user()->role_id == 1){
                // $faqs = renops::with('renstra')->where('status', "aktif")->orderBy('created_at', 'desc')->get();
                $faqs = DB::table('renop_renstra')
                        ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                        ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                        ->select('renop.*', 'renstra.id', 'renstra.jenis', 'renop_renstra.renop_id')
                        ->where('renstra.status', "aktif")
                        ->where('renop.status', "aktif")
                        ->orderBy('renop.created_at', 'desc')
                        ->get();

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

                $faqs = DB::table('renop_renstra')
                    ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
                    ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
                    ->where('renstra.status', "aktif")
                    ->where('renop.unitkerja_id', $scheduling)
                    ->where('renop.status', "aktif")
                    ->orderBy('renop.created_at', 'desc')
                    ->get();
            }

            // }elseif(auth()->user()->role_id == 2){
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
            //     // dd($scheduling);
            //     $faqs = renops::with('renstra')->whereIn('unitkerja_id', $scheduling)->where('status', "aktif")->orderBy('created_at', 'desc')->get(); 
            //     // $faqs = DB::table('renop_renstra')
            //     //             ->join('renop', 'renop.id', '=', 'renop_renstra.renop_id')
            //     //             ->join('renstra', 'renstra.id', '=', 'renop_renstra.renstra_id')
            //     //             ->where('renstra.status', "aktif")
            //     //             ->where('renop.unitkerja_id', $scheduling)
            //     //             ->where('renop.status', "aktif")
            //     //             ->orderBy('renop.created_at', 'desc')
            //     //             ->get();
            // }else{
            //     $faqs = renops::with('renstra')->where('unitkerja_id', auth()->user()->unitkerja_id)->where('status', "aktif")->orderBy('created_at', 'desc')->get();
            // }

            // dd($faqs);
            
            $kinerja = kinerjaUnit::get();
            $c = count($faqs);

            if($c == 0){
                return '<p class="text-muted"> Maaf data tidak ditemukan </p>';
            }else{
                return view('menu.renop.renoplist')->with([
                    'data' => $faqs,
                    'data1' => $kinerja
                    // 'user' => $user
                ]);
            }
            // return 'Silahkan melakukan pencarian data';
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function renopget(Request $request)
    {
        try{
            $keywordRaw = $request->name;
            // dd($keywordRaw);

            if(auth()->user()->role_id == 3){
                $faqs = renops::whereHas('renstra', function($query) use($keywordRaw){
                    $query->where('renstra.id', $keywordRaw);
                })->where('unitkerja_id',auth()->user()->unitkerja_id)->get();
            }else{
                $faqs = renops::whereHas('renstra', function($query) use($keywordRaw){
                    $query->where('renstra.id', $keywordRaw);
                })->get();
            }

            $kinerja = kinerjaUnit::get();

            $c = count($faqs);

            if($c == 0){
                return '<p class="text-muted"> Maaf data tidak ditemukan </p>';
            }else{
                return view('menu.renop.renoplistget')->with([
                    'data' => $faqs,
                    'data1' => $kinerja
                    // 'user' => $user
                ]);
            }
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function create()
    {
        $dokAcuans = renstras::with(['dokumenInduk', 'renop'])->where('status', 'aktif')->get();
        $renstra = renstras::all();
        $unitKerja = unitKerjas::all();
        return view('menu.renop.create', compact('renstra', 'dokAcuans', 'unitKerja'));
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            if(auth()->user()->role_id == 3){
                $valid = [
                    'kode' => 'required|min:3|max:10',
                    'deskripsi' => 'min:3|max:255',
                    'target' => 'required|numeric',
                    'unit_target' => 'required|numeric',
                    'tahun' => 'numeric',
                    // 'unitkerja_id' => 'required',
                    'renstra' => 'required',                            
                    
                ];
    
                // $request->validate($valid);
            }else{
                $valid = [
                    'kode' => 'required|min:3|max:10',
                    'deskripsi' => 'min:3|max:255',
                    'target' => 'required|numeric',
                    'unit_target' => 'required|numeric',
                    'tahun' => 'numeric',
                    'unitkerja_id' => 'required',
                    'renstra' => 'required',                            
                    
                ];
    
                // $request->validate($valid);
            }

            if(auth()->user()->role_id == 3){
                $unitKerja = auth()->user()->unitkerja_id;
                $request->merge(['unitkerja_id' => $unitKerja]);
            }
            
            $post = renops::create($request->all());

            if (!empty($request->renstra)) {
                // $post->pimpinan()->sync($request->pimpinan);
                $post->renstra()->attach($request->renstra);
            }

            return redirect()->route('renop.show', $post->id)->with('success', 'Renop berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function renopSaveMulti(Request $request)
    {
        // dd($request);
        try{
            // dd($request->addmore);
            foreach ($request->addmore as $key => $value) {
                if ($value['kode'] != null){
                    if ($value['target'] != null){
                        if ($value['unit_target'] != null){
                            if ($value['renstra'] != null){
                                if(auth()->user()->role_id == 3){
                                    $unitKerja = auth()->user()->unitkerja_id;
                                    $value['unitkerja_id'] = $unitKerja;
                                }
                                $post = renops::create($value);
                            
                                if (!empty($value['renstra'])) {
                                    $post->renstra()->attach($value['renstra']);
                                }
                            }else{
                                return back()->with('error', 'Renstra wajib di isi, Renstra gagal ditambah');
                            }
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
        
            return back()->with('success', 'Renop berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $renstra = renstras::with('dokumenInduk')->get();
        $unitKerja = unitKerjas::get();
        $renop = renops::with('renstra', 'unitKerja')->findOrFail($id);
        return view('menu.renop.show', compact('renstra', 'unitKerja', 'renop'));
    }

    public function edit($id)
    {
        $dokAcuans = renstras::with(['dokumenInduk', 'renop'])->where('status', 'aktif')->get();
        $renstra = renstras::with('dokumenInduk')->get();
        $unitKerja = unitKerjas::get();

        $renop = renops::with('renstra', 'unitKerja')->findOrFail($id);
        $array = $renop->renstra->toArray();
        foreach($array as $key=>$pv){
            $arr[$key] = $pv['pivot']['renstra_id'];
        }
        $send = $arr;
        return view('menu.renop.edit', compact('renstra', 'dokAcuans', 'unitKerja', 'renop', 'send'));
    }

    public function update(Request $request, $id)
    {
        try{
            // dd($request);
            if(auth()->user()->role_id == 3){
                $valid = [
                    'kode' => 'required|min:3|max:255',
                    'deskripsi' => 'min:3|max:255',
                    'target' => 'required|numeric',
                    'tahun' => 'numeric',
                    // 'unitkerja_id' => 'required',
                    'renstra' => 'required',                            
                    
                ];
    
                $request->validate($valid);
            }else{
                $valid = [
                    'kode' => 'required|min:3|max:10',
                    'deskripsi' => 'min:3|max:255',
                    'target' => 'required|numeric',
                    'tahun' => 'numeric',
                    'unitkerja_id' => 'required',
                    'renstra' => 'required',                            
                    
                ];
    
                $request->validate($valid);
            }

            if(auth()->user()->role_id == 3){
                $unitKerja = auth()->user()->unitkerja_id;
                $request->merge(['unitkerja_id' => $unitKerja]);
            }

            $renop = renops::findOrFail($id);
            $renop->update($request->all());
            // $post = pengelolaUnitKerja::create($request->all());

            if (!empty($request->renstra)) {
                // $post->pimpinan()->sync($request->pimpinan);
                $renop->renstra()->sync($request->renstra);
            }
            // $post->pengelola()->attach($request->pimpinan);
            return redirect()->route('renop.show', $renop->id)->with('success', 'Renop berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $renop = renops::findOrFail($id);
            $renop->renstra()->detach();
            $renop->delete();

            return back()->with('success', 'Renop berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
