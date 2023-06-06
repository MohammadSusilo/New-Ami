<?php

namespace App\Http\Controllers\menu\SPME\LAMTeknik\LED;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDPenjaminanMutu;

use App\Models\unitKerjas;

class LEDPenjaminanMutu extends Controller
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
                'ppmi_upps' => 'required',
                'dok' => 'required',
                'kpm_upps' => 'required',
                'pelaksanaan_ami' => 'required',
                'pengakuan' => 'required',
                'des_pkp' => 'required',
            ]);

            if($request->files == null || empty($request->files)){
                // dd($request);
            }else{
                // dd($request->all());
                LAMTeknikLEDPenjaminanMutu::create($request->all());
            }

            return redirect()->back()->with('success', 'LED Penjaminan Mutu berhasil ditambah');
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
                'ppmi_upps' => 'required',
                'dok' => 'required',
                'kpm_upps' => 'required',
                'pelaksanaan_ami' => 'required',
                'pengakuan' => 'required',
                'des_pkp' => 'required',
            ];
    
            $request->validate($valid);
    
            $standar = LAMTeknikLEDPenjaminanMutu::findOrFail($id);
            $standar->update($request->all());
    
            return redirect()->back()->with('success', 'LED Penjaminan Mutu berhasil diubah');
            // return redirect()->route('standar.show', $standar->id)->with('success', 'Standar berhasil diubah');
                
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        // dd($id);
        try{
            $LAMTeknikLEDPenjaminanMutu = LAMTeknikLEDPenjaminanMutu::findOrFail($id);
            $LAMTeknikLEDPenjaminanMutu->delete();

            return back()->with('success', 'LED Penjaminan Mutu berhasil direset');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
