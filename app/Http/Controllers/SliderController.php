<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

use App\Models\setting;
use App\Models\slider;

class SliderController extends Controller
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
        //
    }

    public function sliderSaveMulti(Request $request)
    {
        try{
            // dd($request);
            foreach ($request->addmore as $key => $value) {
                if ($value['name'] != null){
                                
                    if(!empty($value['file'])){
                        $file  = $value['file'];
                        if($file->getClientOriginalExtension() == "jpg" || $file->getClientOriginalExtension() == "png" || $file->getClientOriginalExtension() == "jpeg" || $file->getClientOriginalExtension() == "svg"){
                            if($file->getSize() <= 3145728){

                                $fileName   = $file->getClientOriginalName();
                                $value['file']->move("storage/files/Pusat/Setting/Banner/",$fileName);
                                $fileBukti = "storage/files/Pusat/Setting/Banner/".$fileName;

                                slider::create([
                                    'frontend_id' => $request->frontend_id,
                                    'name'=> $value['name'],
                                    'deskripsi'=> $value['deskripsi'],
                                    'path' => $fileBukti,
                                    'status'=> $value['status'],
                                ]);

                            }else{
                                return back()->with('error', 'File dokumen terlalu besar dari 3 MB, Slider gagal ditambah');
                            }

                        }else{
                            return back()->with('error', 'File dokumen salah format (*.jpg, *.png, *.jpeg, *.svg), Slider gagal ditambah');
                        }

                    }else{
                        return back()->with('error', 'File Slider wajib di isi, Slider gagal ditambah');
                    }

                }else{
                    return back()->with('error', 'Judul File Slider wajib di isi, Slider gagal ditambah');
                }
            }
        
            return back()->with('success', 'Slider berhasil ditambah');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $banner = slider::findOrFail($id);

        return view('menu.setting.slider.show', compact('banner'));
    }

    public function edit($id)
    {
        $banner = slider::findOrFail($id);

        return view('menu.setting.slider.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        try{
                $valid = [
                    'name' => 'required|min:3|max:50',
                    'deskripsi' => 'min:3|max:255',
                    'file' => 'required|mimes:svg,jpg,jpeg,png',
                ];
        
                $request->validate($valid);
                $banner = slider::findOrFail($id);
    
                if(!empty($request->file('file'))){
                    File::delete($banner->path);
                    $file  = $request->file('file');
                    $fileName   = $file->getClientOriginalName();

                    $request->file('file')->move("storage/files/Pusat/Setting/Banner/",$fileName);
    
                    $fileBukti = "storage/files/Pusat/Setting/Banner/".$fileName;

                    $request->merge(['file' => $fileBukti]);
                }else{
                    $fileBukti = $banner->path;
                }
    
                $banner->update([
                    'name'=> $request->name,
                    'deskripsi'=> $request->deskripsi,
                    'status'=> $request->status,
                    'path' => $fileBukti,
                ]);
                // $buktiKinerja->update($request->all());
    
                return redirect()->route('slider.show', $banner->id)->with('success', 'Slider berhasil diubah');
    
            }catch (Exception $exc) {
                abort(404, $exc->getMessage());
            }
    }

    public function destroy($id)
    {
        try{
            $banner = slider::findOrFail($id);
            File::delete($banner->path);
            $banner->delete();

            return back()->with('success', 'Slider berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
