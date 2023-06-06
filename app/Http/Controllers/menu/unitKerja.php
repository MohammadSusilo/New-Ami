<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

use App\Models\pengelolaUnitKerja;
use App\Models\unitKerjas;

class unitKerja extends Controller
{
    public function index()
    {
        $unitKerja = unitKerjas::with('pengelolaUnitKerja')->get();
        // dd($unitKerja->name);
        // $pengelolaUnitKerja = pengelolaUnitKerja::get();
        return view('menu.unitKerja.index', compact('unitKerja'));
    }

    public function create()
    {
        $pengelola = pengelolaUnitKerja::all();
        return view('menu.unitKerja.create', compact('pengelola'));
    }

    public function store(Request $request)
    {
        try{
            $valid = [
                'name' => 'required|min:3|max:191',
                'pengelola_id' => 'required',
            ];

            $directory = "storage/files/Pusat/Unit Kerja/".$request->name;
            $status = !empty($request->status) ? $request->status : 'aktif';

            $request->validate($valid);
            File::makeDirectory("storage/files/Pusat/Unit Kerja/".$request->name, 0777, true, true);
            $unitKerja = unitKerjas::create([
                'name'=>$request->name,
                'namaRepo'=>$directory,
                'status'=>$status,
                'pengelola_id' => $request->pengelola_id,
            ]);

            return redirect()->route('unitKerja.show', $unitKerja->id)->with('success', 'Unit Kerja berhasil ditambah');

            //SALAH
                // $repo = Storage::makeDirectory("Pusat/Unit Kerja/".$request->name);
                // dd($repo);
                
                // Storage::makeDirectory("Pusat/Unit Kerja/".$request->name);
                // $repo = !empty($directory) ? $request->namaRepo : $directory;
                // $request->merge(['namaRepo' => $repo]);

                // $request->merge(['status' => $status]);



                // dd($request->all());
                // unitKerjas::create($request->all());

                // if (!empty($request->pimpinan)) {
                    // $post->pimpinan()->sync($request->pimpinan);
                    // $post->pimpinan()->attach($request->pimpinan);
                // }
                // $post->pengelola()->attach($request->pimpinan);
                // dd($post);
            
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $pengelola = pengelolaUnitKerja::all();
        $unitKerja = unitKerjas::findOrFail($id);
        return view('menu.unitKerja.show', compact('pengelola', 'unitKerja'));
    }

    public function edit($id)
    {
        $pengelola = pengelolaUnitKerja::all();
        $unitKerja = unitKerjas::findOrFail($id);
        return view('menu.unitKerja.edit', compact('pengelola', 'unitKerja'));
    }

    public function update(Request $request, $id)
    {
        try{
            $valid = [
                'name' => 'required|min:3|max:191',
                'status' => 'required',
            ];
    
            $request->validate($valid);
    
            $unitKerja = unitKerjas::findOrFail($id);
    
            if(!empty($request->namaRepo) || $request->namaRepo !=null){
                if($unitKerja->namaRepo != $request->namaRepo){
                    File::moveDirectory($unitKerja->namaRepo, public_path('storage/files/Pusat/Unit Kerja/'.$request->namaRepo, 0777, true, true));
                }
            }
            
            $unitKerja->update($request->all());
    
            return redirect()->route('unitKerja.show', $unitKerja->id)->with('success', 'Unit Kerja berhasil diubah');
    
            //SALAH
                // $filePath = $unitKerja->namaRepo;
                // dd($filePath);
                // $newFileName = public_path('storage/files/Pusat/Unit Kerja/'.$request->name, 0777, true, true);
                // dd($request->name);
                
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $unitKerja = unitKerjas::findOrFail($id);
            $unitKerja->delete();

            return back()->with('success', 'Unit Kerja berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
