<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\standars;

class standar extends Controller
{
    public function index()
    {
        $standars = standars::get();
        return view('menu.standar.index', compact('standars'));
    }

    public function create()
    {
        return view('menu.standar.create');
    }

    public function store(Request $request)
    {
        try{
            $valid = [
                'kodeStandar' => 'required',
                'namaStandar' => 'required',
                'kriteria' => 'required',
            ];
            
            $request->validate($valid);
            $standar = standars::create($request->all());

            return redirect()->route('standar.show', $standar->id)->with('success', 'Standar berhasil ditambah');            
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $standar = standars::findOrFail($id);
        return view('menu.standar.show', compact('standar'));
    }

    public function edit($id)
    {
        $standar = standars::findOrFail($id);
        return view('menu.standar.edit', compact('standar'));
    }

    public function update(Request $request, $id)
    {
        try{
            $valid = [
                'kodeStandar' => 'required',
                'namaStandar' => 'required',
                'kriteria' => 'required',
            ];
    
            $request->validate($valid);
    
            $standar = standars::findOrFail($id);
            $standar->update($request->all());
    
            return redirect()->route('standar.show', $standar->id)->with('success', 'Standar berhasil diubah');
                
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $standar = standars::findOrFail($id);
            $standar->delete();

            return back()->with('success', 'Standar berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
