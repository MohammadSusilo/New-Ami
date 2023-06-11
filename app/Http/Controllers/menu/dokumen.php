<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use File;

use App\Models\dokumenInduk;
use App\Models\dokumenChecklist;
use App\Models\unitKerjas;

class dokumen extends Controller
{
    //READ ALL
    public function dokumenRead()
    {
        $dokInduk = dokumenInduk::where('sifatDokumen', "public")->get();
        $UK = unitKerjas::get();
        $dokCheck = dokumenChecklist::where('unitkerja_id', auth()->user()->unitkerja_id)->get();
        return view('menu.dokumen.index', compact('dokInduk', 'UK', 'dokCheck'));
    }

    //INDUK
    public function dokumenInduk()
    {
        return view('menu.dokumen.induk');
    }

    public function historyDokInduk()
    {
        $dokInduk = dokumenInduk::where('status', "nonaktif")->orderBy('created_at', 'desc')->get();
        return view('menu.dokumen.historyInduk', compact('dokInduk'));
    }

    public function dokumenIndukSave(Request $request)
    {
        $valid = [
            'name' => 'required|min:3|max:50',
            'nomor' => 'required',
            'revisi' => 'required',
            'tahun_aktif' => 'required|numeric',
            'tahun_selesai' => 'numeric',
            'lokasi' => 'required|mimes:pdf,jpg,jpeg,png',
        ];

        $request->validate($valid);
        
        try {
            $file  = $request->file('lokasi');
            if($file->getSize() <= 3145728){
                $fileName   = $file->getClientOriginalName();
                $date = \Carbon\Carbon::now()->format('Y');
                $request->file('lokasi')->move("storage/files/Pusat/PPMP/Dokumen Induk/".$date."/",$fileName);
                $fileInduk = "storage/files/Pusat/PPMP/Dokumen Induk/".$date."/".$fileName;
                
                dokumenInduk::create([
                    'name'=>$request->name,
                    'nomor'=>$request->nomor,
                    'revisi'=>$request->revisi,
                    'tahun_aktif'=>$request->tahun_aktif,
                    'tahun_selesai'=>$request->tahun_selesai,
                    'lokasi' => $fileInduk,
                    'status' => $request->status,
                    'sifatDokumen' => $request->sifatDokumen,
                ]);
                
                return redirect('RencanaStrategisRencanaOperasional')->with('success', 'Dokumen Induk berhasil ditambah');

            }else{
                return back()->with('error', 'File dokumen terlalu besar dari 3 MB, Dokumen Induk gagal ditambah');
            }

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function dokumenIndukSaveMulti(Request $request)
    {      
        try {
            foreach ($request->addmore as $key => $value) {
                if ($value['name'] != null){
                    if ($value['nomor'] != null){
                        if ($value['revisi'] != null){
                            if (!empty($value['lokasi'])){
                                if($value['lokasi']->getClientOriginalExtension() != "pdf" || $value['lokasi']->getClientOriginalExtension() != "jpg" || $value['lokasi']->getClientOriginalExtension() != "jpeg" || $value['lokasi']->getClientOriginalExtension() != "png"){
                                    if($value['lokasi']->getSize() <= 3145728){
                                        $file  = $value['lokasi'];
                                        $fileName   = $file->getClientOriginalName();
                                        $date = \Carbon\Carbon::now()->format('Y');
                                        $value['lokasi']->move("storage/files/Pusat/PPMP/Dokumen Induk/".$date."/",$fileName);
                                        $fileInduk = "storage/files/Pusat/PPMP/Dokumen Induk/".$date."/".$fileName;
                                            
                                        dokumenInduk::create([
                                            'name'=>$value['name'],
                                            'nomor'=>$value['nomor'],
                                            'revisi'=>$value['revisi'],
                                            'tahun_aktif'=>$value['tahun_aktif'],
                                            'tahun_selesai'=>$value['tahun_selesai'],
                                            'lokasi' => $fileInduk,
                                            'status' => $value['status'],
                                            'sifatDokumen' => $value['sifatDokumen'],
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
                            return back()->with('error', 'Revisi dokumen wajib diisi, Dokumen Induk gagal ditambah');
                        }

                    }else{
                        return back()->with('error', 'Nomor dokumen wajib diisi, Dokumen Induk gagal ditambah');
                    }

                }else{
                    return back()->with('error', 'Nama dokumen wajib diisi, Dokumen Induk gagal ditambah');
                }
            }

            return back()->with('success', 'Dokumen Induk berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
            // return back()->with('error', 'Dokumen Induk gagal ditambah');
        }
    }

    public function dokumenIndukEdit($id)
    {
        $dokInduk = dokumenInduk::findOrFail($id);
        return view('menu.dokumen.editInduk', compact('dokInduk'));
    }

    public function dokumenIndukUpdate(Request $request, $id)
    {
        // dd($request);
        $valid = [
            'name' => 'required|min:3|max:50',
            'tahun_aktif' => 'numeric',
            'tahun_selesai' => 'numeric',
            'lokasi' => 'mimes:pdf,jpg,jpeg,png',
        ];

        $request->validate($valid);

        try{

            $filecheck = dokumenInduk::findOrFail($id);

            if(!empty($request->file('lokasi'))){
                $file  = $request->file('lokasi');
                
                if($file->getSize() <= 3145728){
                    File::delete($filecheck->lokasi);
                    
                    $fileName   = $file->getClientOriginalName();
                    $date = \Carbon\Carbon::now()->format('Y');
                    $request->file('lokasi')->move("storage/files/Pusat/PPMP/Dokumen Induk/".$date."/",$fileName);
                    $fileInduk = "storage/files/Pusat/PPMP/Dokumen Induk/".$date."/".$fileName;
                }else{
                    return back()->with('error', 'File dokumen terlalu besar dari 3 MB, Dokumen Induk gagal ditambah');
                }

            }else{
                $fileInduk = $filecheck->lokasi;
            }

            $filecheck->update([
                'name'=>$request->name,
                'nomor'=>$request->nomor,
                'revisi'=>$request->revisi,
                'tahun_aktif'=>$request->tahun_aktif,
                'tahun_selesai'=>$request->tahun_selesai,
                'lokasi' => $fileInduk,
                'status' => $request->status,
                'sifatDokumen' => $request->sifatDokumen,
            ]);

            return redirect('RencanaStrategisRencanaOperasional')->with('success', 'Dokumen Induk berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function dokumenIndukDestroy($id)
    {
        try{

            $data = dokumenInduk::findOrFail($id);        
            File::delete($data->lokasi);
            dokumenInduk::where('id',$id)->delete();

            return redirect()->back()->with('success', 'Dokumen Induk berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }


    //CHECKLIST
    public function dokumenChecklist()
    {
        try{
            $unitKerja = unitKerjas::all();
            return view('menu.dokumen.checklist', compact('unitKerja'));

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function historyDokChecklist()
    {
        if(auth()->user()->role_id == 3){
            $unitKerja = unitKerjas::all();
            $dokCheck = dokumenChecklist::where('unitkerja_id', auth()->user()->unitkerja_id)->where('status', "nonaktif")->orderBy('created_at', 'desc')->get();
        }else{
            $unitKerja = unitKerjas::all();
            $dokCheck = dokumenChecklist::where('status', "nonaktif")->orderBy('created_at', 'desc')->get();
        }

        return view('menu.dokumen.historyChecklist', compact('dokCheck', 'unitKerja'));
    }

    public function dokumenChecklistSave(Request $request)
    {
        // dd($request);
        if(auth()->user()->role_id == 3){
            $valid = [
                'name' => 'required|min:3|max:50',
                'tahun' => 'numeric',
                // 'unitkerja_id' => 'required',
                'lokasi' => 'required|mimes:pdf,jpg,jpeg,png',
            ];

            $request->validate($valid);
        }else{
            $valid = [
                'name' => 'required|min:3|max:50',
                'tahun' => 'numeric',
                'unitkerja_id' => 'required',
                'lokasi' => 'required|mimes:pdf,jpg,jpeg,png',
            ];

            $request->validate($valid);
        }

        try {
            if(auth()->user()->role_id == 3){
                // dd(auth()->user()->unitkerja_id);
                $unitkerja = auth()->user()->unitkerja_id;
                $request->merge(['unitkerja_id' => $unitkerja]);
            }
            $file  = $request->file('lokasi');
            if($file->getSize() <= 3145728){
                $fileName   = $file->getClientOriginalName();
                $date = \Carbon\Carbon::now()->format('Y');
                $request->file('lokasi')->move("storage/files/Pusat/PPMP/Dokumen Checklist/".$date."/",$fileName);
                $fileChecklist = "storage/files/Pusat/PPMP/Dokumen Checklist/".$date."/".$fileName;
                
                dokumenChecklist::create([
                    'name'=>$request->name,
                    'tahun'=>$request->tahun,
                    'unitkerja_id'=>$request->unitkerja_id,
                    'lokasi' => $fileChecklist,
                    'status' => $request->status,
                ]);
                
                return redirect('RencanaStrategisRencanaOperasional')->with('success', 'Dokumen Checklist berhasil ditambah');

            }else{
                return back()->with('error', 'File dokumen terlalu besar dari 3 MB, Dokumen Checklist gagal ditambah');
            }
        
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function dokChecklistSaveMulti(Request $request)
    {
        dd($request);
        try {
            foreach ($request->addmore as $key => $value) {
                if ($value['name'] != null){
                    if (!empty($value['lokasi'])){
                        if($value['lokasi']->getClientOriginalExtension() != "pdf" || $value['lokasi']->getClientOriginalExtension() != "jpg" || $value['lokasi']->getClientOriginalExtension() != "jpeg" || $value['lokasi']->getClientOriginalExtension() != "png"){
                            if($value['lokasi']->getSize() <= 3145728){
                                if(auth()->user()->role_id == 3){
                                    // dd(auth()->user()->unitkerja_id);
                                    $unitkerja = auth()->user()->unitkerja_id;
                                    // $request->merge(['unitkerja_id' => $unitkerja]);
                                }else{
                                    $unitkerja =$value['unitkerja_id'];
                                }
                                $file  = $value['lokasi'];
                                $fileName   = $file->getClientOriginalName();
                                $date = \Carbon\Carbon::now()->format('Y');
                                $value['lokasi']->move("storage/files/Pusat/PPMP/Dokumen Checklist/".$date."/",$fileName);
                                $fileChecklist = "storage/files/Pusat/PPMP/Dokumen Checklist/".$date."/".$fileName;
                                
                                dokumenChecklist::create([
                                    'name'=>$value['name'],
                                    'tahun'=>$value['tahun'],
                                    'unitkerja_id'=>$unitkerja,
                                    'lokasi' => $fileChecklist,
                                    'status' => $value['status'],
                                ]);

                            }else{
                                return back()->with('error', 'File dokumen terlalu besar dari 3 MB, Dokumen Checklist gagal ditambah');
                            }

                        }else{
                            return back()->with('error', 'File dokumen tidak sesuai dengan format, Dokumen Checklist gagal ditambah');
                        }

                    }else{
                        return back()->with('error', 'File dokumen kosong, Dokumen Checklist gagal ditambah');
                    }

                }else{
                    return back()->with('error', 'Nama dokumen wajib diisi, Dokumen Checklist gagal ditambah');
                }
            }

            return back()->with('success', 'Dokumen Checklist berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
            // return back()->with('error', 'Dokumen Checklist gagal ditambah');
        }
    }

    public function dokumenChecklistEdit($id)
    {
        $dokCheck = dokumenChecklist::findOrFail($id);
        $unitKerja = unitKerjas::all();
        return view('menu.dokumen.editCheck', compact('dokCheck', 'unitKerja'));
    }

    public function dokumenChecklistUpdate(Request $request, $id)
    {
        if(auth()->user()->role_id == 3){
            $valid = [
                'name' => 'required|min:3|max:50',
                'tahun' => 'numeric',
                // 'unitkerja_id' => 'required',
                'lokasi' => 'required|mimes:pdf,jpg,jpeg,png',
            ];

            $request->validate($valid);
        }else{
            $valid = [
                'name' => 'required|min:3|max:50',
                'tahun' => 'numeric',
                'unitkerja_id' => 'required',
                'lokasi' => 'mimes:pdf,jpg,jpeg,png',
            ];

            $request->validate($valid);
        }

        try{

            $filecheck = dokumenChecklist::findOrFail($id);

            if(!empty($request->file('lokasi'))){
                $file  = $request->file('lokasi');
                
                if($file->getSize() <= 3145728){
                    if(auth()->user()->role_id == 3){
                        // dd(auth()->user()->unitkerja_id);
                        $unitkerja = auth()->user()->unitkerja_id;
                        $request->merge(['unitkerja_id' => $unitkerja]);
                    }
                    File::delete($filecheck->lokasi);

                    $fileName   = $file->getClientOriginalName();
                    $date = \Carbon\Carbon::now()->format('Y');
                    $request->file('lokasi')->move("storage/files/Pusat/PPMP/Dokumen Checklist/".$date."/",$fileName);
                    $fileChecklist = "storage/files/Pusat/PPMP/Dokumen Checklist/".$date."/".$fileName;

                }else{
                    return back()->with('error', 'File dokumen terlalu besar dari 3 MB, Dokumen Checklist gagal ditambah');
                }

            }else{
                $fileChecklist = $filecheck->lokasi;
            }
            
            $filecheck->update([
                'name'=>$request->name,
                'tahun'=>$request->tahun,
                'unitkerja_id'=>$request->unitkerja_id,
                'lokasi' => $fileChecklist,
                'status' => $request->status,
            ]);
            

            return redirect('RencanaStrategisRencanaOperasional')->with('success', 'Dokumen Checklist berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function dokumenChecklistDestroy($id)
    {
        try{

            $data = dokumenChecklist::findOrFail($id);        
            File::delete($data->lokasi);
            dokumenChecklist::where('id',$id)->delete();

            return redirect()->back()->with('success', 'Dokumen Checklist berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
