<?php

namespace App\Http\Controllers\menu\SPME\LAMTeknik\LED;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDPendahuluan;

use App\Models\unitKerjas;

class LEDPendahuluan extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        try{
            $this->validate($request, [
                'uk_id' => 'required',
                'pendahuluan' => 'required'
            ]);

            LAMTeknikLEDPendahuluan::create($request->all());

            return redirect()->back()->with('success', 'LED Pendahuluan berhasil ditambah');
            // return redirect()->route('LAMTeknik.index')->with('success', 'LED Pendahuluan berhasil ditambah');
                    
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try{
            $valid = [
                'uk_id' => 'required',
                'pendahuluan' => 'required',
            ];
    
            $request->validate($valid);
    
            $standar = LAMTeknikLEDPendahuluan::findOrFail($id);
            $standar->update($request->all());
    
            return redirect()->back()->with('success', 'LED Pendahuluan berhasil diubah');
            // return redirect()->route('standar.show', $standar->id)->with('success', 'Standar berhasil diubah');
                
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        // dd($id);
        try{
            $LAMTeknikLEDPendahuluan = LAMTeknikLEDPendahuluan::findOrFail($id);
            $LAMTeknikLEDPendahuluan->delete();

            return back()->with('success', 'LED Pendahuluan berhasil direset');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
