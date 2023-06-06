<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\pimpinans;
use App\Models\pengelolaUnitKerja;

class pengelola extends Controller
{
    public function index()
    {
        $pengelola = pengelolaUnitKerja::all();
        return view('menu.pengelola.index', compact('pengelola'));
                // ->withPengelola($pengelola);
    }

    public function create()
    {
        $pimpinan = pimpinans::all();
        return view('menu.pengelola.create')
            ->withPimpinan($pimpinan);
    }

    public function store(Request $request)
    {
        try{

            $valid = [
                'name' => 'required|min:3|max:191',
                'pimpinan' => 'required',
                'status' => 'required',
            ];
            
            $request->validate($valid);
            $post = pengelolaUnitKerja::create($request->all());
    
            if (!empty($request->pimpinan)) {
                // $post->pimpinan()->sync($request->pimpinan);
                $post->pimpinan()->attach($request->pimpinan);
            }
            
            return redirect()->route('pengelola.show', $post->id)->with('success', 'Pengelola berhasil ditambah');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $pengelola = pengelolaUnitKerja::with('pimpinan')->findOrFail($id);
        return view('menu.pengelola.show', compact('pengelola'));
    }

    public function edit($id)
    {
        // $pengelola = pengelolaUnitKerja::with('pimpinan')->findOrFail($id);

        // $pengelola = pengelolaUnitKerja::find($id);
        
        $pengelola = pengelolaUnitKerja::with('pimpinan')->findOrFail($id);
        $array = $pengelola->pimpinan->toArray();
        
        foreach($array as $key=>$pv){
            $arr[$key] = $pv['pivot']['pimpinan_id'];
        }
        $send = $arr;

        $pimpinan = pimpinans::get();
        return view('menu.pengelola.edit', compact('pengelola', 'pimpinan',  'send'));
    }

    public function update(Request $request, $id)
    {
        try{
            $valid = [
                'name' => 'required|min:3|max:191',
                'pimpinan' => 'required',
                'status' => 'required',
            ];
        
                
            $request->validate($valid);
                
            $pengelola = pengelolaUnitKerja::findOrFail($id);
            $pengelola->update($request->all());
        
            if (!empty($request->pimpinan)) {
                // $post->pimpinan()->sync($request->pimpinan);
                $pengelola->pimpinan()->sync($request->pimpinan);
            }
                
            return redirect()->route('pengelola.show', $pengelola->id)->with('success', 'Pengelola berhasil diubah');
                
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {

        try{
            
            $pengelola = pengelolaUnitKerja::findOrFail($id);
            $pengelola->pimpinan()->detach();
            $pengelola->delete();
    
            return redirect()->back()->with('success', 'Pengelola berhasil dihapus');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function Change(Request $request)
    {
        try{

            $id =  $request->id;
            $data['status'] =  $request->status;
                
            DB::table('pengelolaunitkerja')->where('id',$id)->update($data);
            return redirect()->back()->with('success', 'Pimpinan berhasil diubah statusnya');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }

    }
}
