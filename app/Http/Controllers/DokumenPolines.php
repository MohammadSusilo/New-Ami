<?php

namespace App\Http\Controllers;

use App\Models\DokumenPolines as ModelsDokumenPolines;
use App\Models\unitKerjas;
use Illuminate\Http\Request;

class DokumenPolines extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $unitKerja = unitKerjas::all();
            return view('menu.dokumenPolines.create', compact('unitKerja'));
        } catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = [
            'unitkerja_id' => 'required',
        ];

        $request->validate($valid);

        try {
            ModelsDokumenPolines::create([
                'unitkerja_id' => $request->unitkerja_id,
            ]);

            return redirect('RencanaStrategisRencanaOperasional')->with('success', 'Dokumen Polines berhasil ditambah');
        } catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function StoreMulti(Request $request)
    {
        try {
            foreach ($request->addmore as $key => $value) {
                if ($value['unitkerja_id'] != null) {
                    ModelsDokumenPolines::create([
                        'unitkerja_id' => $value['unitkerja_id'],
                    ]);
                } else {
                    return back()->with('error', 'Unit Kerja wajib di isi, Dokumen Polines gagal ditambah');
                }
            }

            return back()->with('success', 'Kinerja Unit berhasil ditambah');
        } catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $data = ModelsDokumenPolines::findOrFail($id);
            // File::delete($data->lokasi);
            $data->delete();

            return redirect()->back()->with('success', 'Dokumen Polines berhasil dihapus');
        } catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
