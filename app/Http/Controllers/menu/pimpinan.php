<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\pimpinans;
use App\Models\pengelolaUnitKerja;

class pimpinan extends Controller
{
    public function index()
    {
        $pimpinan = pimpinans::all();
        return view('menu.pimpinan.index')
                ->withPimpinan($pimpinan);
    }

    public function pimpinanUK()
    {

    }

    public function create()
    {
        $pengelola = pengelolaUnitKerja::all();
        return view('menu.pimpinan.create')->withPengelola($pengelola);
    }

    public function store(Request $request)
    {

        try{
            
            $valid = [
                'name' => 'required|min:3|max:191',
                'status' => 'required',
            ];
    
            $request->validate($valid);
            $pimpinan = pimpinans::create($request->all());
            if (!empty($request->pengelola)) {
                // $post->pimpinan()->sync($request->pimpinan);
                $pimpinan->pengelola()->attach($request->pengelola);
            }
            // dd($post);
            return redirect()->route('pimpinan.show', $pimpinan->id)->with('success', 'Pimpinan berhasil ditambah');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
        
    }

    public function show($id)
    {
        $pimpinan = pimpinans::findOrFail($id);
        return view('menu.pimpinan.show', compact('pimpinan'));
    }

    public function edit($id)
    {
        $pimpinan = pimpinans::with('pengelola')->findOrFail($id);
        $array = $pimpinan->pengelola->toArray();
        
        foreach($array as $key=>$pv){
            $arr[$key] = $pv['pivot']['pengelola_id'];
        }
        $send = $arr;

        // $pimpinan = pimpinans::findOrFail($id);
        $pengelola = pengelolaUnitKerja::get();
        return view('menu.pimpinan.edit', compact('pimpinan', 'pengelola', 'send'));
    }

    public function update(Request $request, $id)
    {
        try{
            
            $valid = [
                'name' => 'required|min:3|max:191',
                'status' => 'required',
            ];
    
            $request->validate($valid);
    
            $pimpinan = pimpinans::findOrFail($id);
            $pimpinan->update($request->all());
    
            if (!empty($request->pengelola)) {
                // $post->pimpinan()->sync($request->pimpinan);
                $pimpinan->pengelola()->sync($request->pengelola);
            }
    
            return redirect()->route('pimpinan.show', $pimpinan->id)->with('success', 'Pimpinan berhasil diubah');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
        
    }

    public function destroy($id)
    {
        try{
            
            $pimpinan = pimpinans::findOrFail($id);
            $pimpinan->pengelola()->detach();
            $pimpinan->delete();
    
            return redirect()->back()->with('success', 'Pimpinan berhasil dihapus');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
        
    }

    public function Change(Request $request)
    {
        try{
            
            // dd($request);
            $id =  $request->id;
            $data['status'] =  $request->status;
                
            DB::table('pimpinan')->where('id',$id)->update($data);
            return redirect()->back()->with('success', 'Pimpinan berhasil diubah statusnya');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
        
    }
}
