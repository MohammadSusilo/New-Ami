<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use File;

use App\Models\User;
use App\Models\profile;
use App\Models\unitKerjas;

class profileController extends Controller
{
    public function index()
    {
        $users = User::where('id', auth()->user()->id)->first();
        $profile = profile::where('user_id', auth()->user()->id)->first();
        $unitKerja = unitKerjas::where('id', auth()->user()->unitkerja_id)->first();
        return view('menu.profile.index', compact('users', 'profile', 'unitKerja'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        // $folderPath = 'storage/files/Pusat/Profile/';
        
        // $image_parts = explode(";base64,", $request->signed);
              
        // $image_type_aux = explode("image/", $image_parts[0]);
           
        // $image_type = $image_type_aux[1];
           
        // $image_base64 = base64_decode($image_parts[1]);
           
        // $file = $folderPath . uniqid() . '.'.$image_type;
        // dd($image_base64);
        // file_put_contents($file, $image_base64);

        $users = User::where('id', auth()->user()->id)->first();
        if($users->name == $request->name && $users->email == $request->email){
            $profile = profile::where('user_id', auth()->user()->id)->first();
            if(empty($profile)){
                if($request->hasfile('foto')){
                    $file  = $request->file('foto');
                    // dd($file);
                    $fileName   = $file->getClientOriginalName();
                    $date = \Carbon\Carbon::now()->format('Y');
                    $request->file('foto')->move("storage/files/Pusat/Profile/".$date."/",$fileName);
                    $fileInduk = "storage/files/Pusat/Profile/".$date."/".$fileName;

                    $folderPath = 'storage/files/Pusat/Profile/'.$date.'/';
                    $image_parts = explode(";base64,", $request->signed);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $file = $folderPath . uniqid() . '.'.$image_type;
                    // dd($file);
                    
                    profile::create([
                        'jabatan'=>$request->jabatan,
                        'user_id'=>auth()->user()->id,
                        'foto' => $fileInduk,
                    ]);
                    return redirect()->back();
                }else{
                    profile::create([
                        'jabatan'=>$request->jabatan,
                        'user_id'=>auth()->user()->id,
                    ]);
                    return redirect()->back();
                }
            }else{
                $profile = profile::where('user_id', auth()->user()->id)->first();
                // dd($profile);
                if(!empty($request->hasfile('foto'))){
                    File::delete($profile->foto);
                    $file  = $request->file('foto');
                    // dd($file);
                    $fileName   = $file->getClientOriginalName();
                    $date = \Carbon\Carbon::now()->format('Y');
                    $request->file('foto')->move("storage/files/Pusat/Profile/".$date."/",$fileName);
                    $fileInduk = "storage/files/Pusat/Profile/".$date."/".$fileName;
                }else{
                    $fileInduk = $profile->foto;
                }
                $profile->update([
                    'jabatan'=> $request->jabatan,
                    'foto' => $fileInduk,
                ]);
                return redirect()->back();
            }
        }else{
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $users->update($data);
            $profile = profile::where('user_id', auth()->user()->id)->first();
            if(empty($profile)){
                if($request->hasfile('foto')){
                    $file  = $request->file('foto');
                    // dd($file);
                    $fileName   = $file->getClientOriginalName();
                    $date = \Carbon\Carbon::now()->format('Y');
                    $request->file('foto')->move("storage/files/Pusat/Profile/".$date."/",$fileName);
                    $fileInduk = "storage/files/Pusat/Profile/".$date."/".$fileName;
                    
                    profile::create([
                        'jabatan'=>$request->jabatan,
                        'user_id'=>auth()->user()->id,
                        'foto' => $fileInduk,
                    ]);
                    return redirect()->back();
                }else{
                    profile::create([
                        'jabatan'=>$request->jabatan,
                        'user_id'=>auth()->user()->id,
                    ]);
                    return redirect()->back();
                }
            }else{
                $profile = profile::where('user_id', auth()->user()->id)->first();
                if(!empty($request->file('foto'))){
                    File::delete($profile->foto);
                    $file  = $request->file('foto');
                    // dd($file);
                    $fileName   = $file->getClientOriginalName();
                    $date = \Carbon\Carbon::now()->format('Y');
                    $request->file('foto')->move("storage/files/Pusat/Profile/".$date."/",$fileName);
                    $fileInduk = "storage/files/Pusat/Profile/".$date."/".$fileName;
                }else{
                    $fileInduk = $profile->foto;
                }
                $profile->update([
                    'jabatan'=> $request->jabatan,
                    'foto' => $fileInduk,
                ]);
                return redirect()->back();
            }
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
        // dd($request);
        try{
            $valid = [
                'name' => 'required|min:3|max:255',
                'email' => 'email',
                'foto' => 'mimes:jpg,jpeg,png|max:10240',
            ];

            $request->validate($valid);

            $users = User::with('profile')->findOrFail($id);
            
            // if($request->name){
                $users->update(['name' => $request->name]);
            //     return redirect()->back()->with('success', 'Profil berhasil diubah');
            // }else{
            
                $profile = profile::where('user_id', auth()->user()->id)->first();

                if($users->profile != null || $users->name == $request->name){
                    
                    if($request->hasfile('foto')){
                        $file  = $request->file('foto');
                        File::delete($profile->foto);
    
                        $fileName   = $file->getClientOriginalName();
                        $date = \Carbon\Carbon::now()->format('Y');
                        $request->file('foto')->move("storage/files/Pusat/Profile/".$date."/",$fileName);
                        $fileInduk = "storage/files/Pusat/Profile/".$date."/".$fileName;
                        
                        if($request->signed != null){
                            File::delete($profile->signature);
    
                            $folderPath = 'storage/files/Pusat/Profile/'.$date.'/';
                            $image_parts = explode(";base64,", $request->signed);
                            $image_type_aux = explode("image/", $image_parts[0]);
                            $image_type = $image_type_aux[1];
                            $image_base64 = base64_decode($image_parts[1]);
                            $file = $folderPath . uniqid() . '.'.$image_type;
                            file_put_contents($file, $image_base64);
                            $signature = $file;
    
                        }else{
                            $signature = $profile->signature;
                        }
    
                        $data['jabatan'] = $request->jabatan;
                        $data['foto'] = $fileInduk;
                        $data['signature'] = $signature;
                        $profile->update($data);
    
                        return redirect()->back()->with('success', 'Profil berhasil diubah');
    
                    }else{
                        $date = \Carbon\Carbon::now()->format('Y');
    
                        if($request->signed != null){
                            File::delete($profile->signature);
    
                            $folderPath = 'storage/files/Pusat/Profile/'.$date.'/';
                            $image_parts = explode(";base64,", $request->signed);
                            $image_type_aux = explode("image/", $image_parts[0]);
                            $image_type = $image_type_aux[1];
                            $image_base64 = base64_decode($image_parts[1]);
                            $file = $folderPath . uniqid() . '.'.$image_type;
                            file_put_contents($file, $image_base64);
                            $signature = $file;
    
                        }else{
                            $signature = $profile->signature;
                        }
    
                        $data['jabatan'] = $request->jabatan;
                        $data['signature'] = $signature;
                        $profile->update($data);
    
                        return redirect()->back()->with('success', 'Profil berhasil diubah');
                    }
                }else{
                    $data['name'] = $request->name;
                    $users->update($data);
                    if($request->hasfile('foto')){
                        $file  = $request->file('foto');
                        
                        $fileName   = $file->getClientOriginalName();
                        $date = \Carbon\Carbon::now()->format('Y');
                        $request->file('foto')->move("storage/files/Pusat/Profile/".$date."/",$fileName);
                        $fileInduk = "storage/files/Pusat/Profile/".$date."/".$fileName;
                        
                        if($request->signed != null){
                            File::delete($profile->signature);
    
                            $folderPath = 'storage/files/Pusat/Profile/'.$date.'/';
                            $image_parts = explode(";base64,", $request->signed);
                            $image_type_aux = explode("image/", $image_parts[0]);
                            $image_type = $image_type_aux[1];
                            $image_base64 = base64_decode($image_parts[1]);
                            $file = $folderPath . uniqid() . '.'.$image_type;
                            file_put_contents($file, $image_base64);
                            $signature = $file;
    
                        }else{
                            $signature = $profile->signature;
                        }
    
                        profile::create([
                            'jabatan'=>$request->jabatan,
                            'user_id'=>auth()->user()->id,
                            'foto' => $fileInduk,
                            'signature' => $signature,
                        ]);
                        return redirect()->back()->with('success', 'Profil berhasil diubah');
                    }else{
                        $date = \Carbon\Carbon::now()->format('Y');
    
                        if($request->signed != null){
                            File::delete($profile->signature);
    
                            $folderPath = 'storage/files/Pusat/Profile/'.$date.'/';
                            $image_parts = explode(";base64,", $request->signed);
                            $image_type_aux = explode("image/", $image_parts[0]);
                            $image_type = $image_type_aux[1];
                            $image_base64 = base64_decode($image_parts[1]);
                            $file = $folderPath . uniqid() . '.'.$image_type;
                            file_put_contents($file, $image_base64);
                            $signature = $file;
    
                        }else{
                            $signature = $profile->signature;
                        }
    
                        profile::create([
                            'jabatan'=>$request->jabatan,
                            'user_id'=>auth()->user()->id,
                            'signature' => $signature,
                        ]);
                        return redirect()->back()->with('success', 'Profil berhasil diubah');
                    }
                }
            // }



            // $renstra = renstras::findOrFail($id);
            // $renstra->update($request->all());

            // return redirect()->route('renstra.show', $renstra->id)->with('success', 'Dokumen Acuan berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function password(Request $request, $id)
    { 
        try{
            $this->validate($request,[
               'password' => 'required|confirmed|min:8'
               
            ]);
            
            $users = User::with('profile')->findOrFail($id);
            
            if($request->password == $request->password_confirmation){
                // if ($request->password = 'required|min:8|max:191') {
                    $request->merge(['password' => Hash::make($request->password)]);
                    $users->update($request->all());
                    return redirect()->back()->with('success', 'Password berhasil diubah');
                // }else{
                //     return redirect()->back()->with('error', 'Password kurang panjang, password gagal diubah');
                // }
            
            }else{
                return redirect()->back()->with('error', 'Password tidak sama, password gagal diubah');
            }
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
        
    }

    public function destroy($id)
    {
        //
    }
}
