<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Crypt;
use Illuminate\Support\Facades\Crypt;
use App\Mail\sendMailCreateUser;
use Illuminate\Support\Facades\Mail;

use App\Models\unitKerjas;
use App\Models\profile;
use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $unitKerja = unitKerjas::all();
        return view('menu.users.index',compact('users', 'roles', 'unitKerja'));
    }

    public function create()
    {
        $roles = Role::all();
        $unitKerja = unitKerjas::all();
        return view('menu.users.create',compact('roles', 'unitKerja'));
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
                'roles' => 'required',
            ]);

            $D0 = User::where('is_pimpinan', 'D0')->where('status', 'aktif')->first();
            $WD1 = User::where('is_pimpinan', 'WD1')->where('status', 'aktif')->first();
            $WD2 = User::where('is_pimpinan', 'WD2')->where('status', 'aktif')->first();
            $WD3 = User::where('is_pimpinan', 'WD3')->where('status', 'aktif')->first();
            $WD4 = User::where('is_pimpinan', 'WD4')->where('status', 'aktif')->first();
            
            $unitKerja = unitKerjas::get();
            
            // dd($D0);
            if($D0 != null || $WD1 != null || $WD2 != null || $WD3 != null || $WD4 != null){
                if($request->is_pimpinan == "D0"){
                    $D0 = User::where('is_pimpinan', 'D0')->update(['status' => 'nonaktif']);
                }elseif($request->is_pimpinan == "WD1"){
                    $WD1 = User::where('is_pimpinan', 'WD1')->update(['status' => 'nonaktif']);
                }elseif($request->is_pimpinan == "WD2"){
                    $WD2 = User::where('is_pimpinan', 'WD2')->update(['status' => 'nonaktif']);
                }elseif($request->is_pimpinan == "WD3"){
                    $WD3 = User::where('is_pimpinan', 'WD3')->update(['status' => 'nonaktif']);
                }else{
                    $WD4 = User::where('is_pimpinan', 'WD4')->update(['status' => 'nonaktif']);
                }

                $users = new User();
                $users->name = $request->name;
                $users->email = $request->email;
                $users->password = Hash::make('123456');
                // $users->password = Hash::make($request->password);
    
                // $unitkerja_id = !empty($request->unitkerja_id) ? $request->unitkerja_id : 'null';
                // $request->merge(['unitkerja_id' => $unitkerja_id]);
                $users->role_id = $request->roles;
                if($request->roles == 1){
                    $users->unitkerja_id = null;
                    $users->is_pimpinan = null;
                }elseif($request->roles == 2 || $request->roles == 3){
                    $users->unitkerja_id = $request->unitkerja_id;
                    $users->is_pimpinan = null;
                }elseif($request->roles == 4|| $request->is_pimpinan == null){
                    $users->unitkerja_id = $request->unitkerja_id;
                    $users->is_pimpinan = null;
                }else{
                    $users->unitkerja_id = $request->unitkerja_id;
                    $users->is_pimpinan = $request->is_pimpinan;
                }
                $users->status = "aktif";
                $users->save();
    
                $profile = new profile();
                $profile->user_id = $users->id;
                $profile->save();
                
                // foreach ($unitKerja as $UK){
                //     if($UK->id == $users->unitkerja_id){
                //         $UKs = $UK->name;
                //     }
                // }
                // foreach ($profile as $prof){
                //     if($prof->user_id == $users->id){
                //         $jab = $prof->jabatan;
                //     }else{
                //       $UKs = "PUSAT";
                //     }
                // }
                
                $pass = "123456";
                
                $details = [
                    'name' => $users->name,
                    'roles' => $users->role_id,
                    'unitKerja' => $users->unitkerja_id,
                    'password' => $pass,
                    'status' => $users->status,
                    'created' => $users->created_at,
                    // 'title' => 'Pembuatan User ',
                    // 'body' => 'This is for testing email using smtp'
                ];
        
                \Mail::to($users->email)->send(new \App\Mail\sendMailCreateUser($details));
    
    
                return redirect()->route('users.show', $users->id)->with('success', 'Pengguna berhasil ditambah');
            }else{
                $users = new User();
                $users->name = $request->name;
                $users->email = $request->email;
                $users->password = Hash::make('123456');
                // $users->password = Hash::make($request->password);
    
                // $unitkerja_id = !empty($request->unitkerja_id) ? $request->unitkerja_id : 'null';
                // $request->merge(['unitkerja_id' => $unitkerja_id]);
                $users->role_id = $request->roles;
                if($request->roles == 1){
                    $users->unitkerja_id = null;
                    $users->is_pimpinan = null;
                }elseif($request->roles == 2 || $request->roles == 3){
                    $users->unitkerja_id = $request->unitkerja_id;
                    $users->is_pimpinan = null;
                }elseif($request->roles == 4|| $request->is_pimpinan == null){
                    $users->unitkerja_id = $request->unitkerja_id;
                    $users->is_pimpinan = null;
                }else{
                    $users->unitkerja_id = $request->unitkerja_id;
                    $users->is_pimpinan = $request->is_pimpinan;
                }
                $users->status = "aktif";
                $users->save();
    
                $profile = new profile();
                $profile->user_id = $users->id;
                $profile->save();
                
                // foreach ($unitKerja as $UK){
                //     if($UK->id == $users->unitkerja_id){
                //         $UKs = $UK->name;
                //     }
                // }
                // foreach ($profile as $prof){
                //     if($prof->user_id == $users->id){
                //         $jab = $prof->jabatan;
                //     }else{
                //       $UKs = "PUSAT";
                //     }
                // }
                
                $pass = "123456";
                
                $details = [
                    'name' => $users->name,
                    'roles' => $users->role_id,
                    'unitKerja' => $users->unitkerja_id,
                    'password' => $pass,
                    'status' => $users->status,
                    'created' => $users->created_at,
                ];
        
                \Mail::to($users->email)->send(new \App\Mail\sendMailCreateUser($details));
    
    
                return redirect()->route('users.show', $users->id)->with('success', 'Pengguna berhasil ditambah');
            }
                
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function UsersSaveMulti(Request $request)
    {
        try{
            // dd($request);
            foreach ($request->addmore as $key => $value) {
                if ($value['name'] != null){
                    if($value['email'] != null){
                        // if(!empty($value['unitkerja_id'])){
                            if($value['role_id'] != null){
                                // if($value['password'] != null && $value['password'] == $value['password_confirmation']){
                                    // if(strlen($value['password']) >= 8){
                                        $unitKerja = unitKerjas::get();
                                        
                                        if($value['role_id'] == "4"){
                                            $D0 = User::where('is_pimpinan', 'D0')->where('status', 'aktif')->first();
                                            $WD1 = User::where('is_pimpinan', 'WD1')->where('status', 'aktif')->first();
                                            $WD2 = User::where('is_pimpinan', 'WD2')->where('status', 'aktif')->first();
                                            $WD3 = User::where('is_pimpinan', 'WD3')->where('status', 'aktif')->first();
                                            $WD4 = User::where('is_pimpinan', 'WD4')->where('status', 'aktif')->first();
    
                                            if($D0 != null || $WD1 != null || $WD2 != null || $WD3 != null || $WD4 != null){
                                                if($value['is_pimpinan'] == "D0"){
                                                    $D0 = User::where('is_pimpinan', 'D0')->update(['status' => 'nonaktif']);
                                                }elseif($value['is_pimpinan'] == "WD1"){
                                                    $WD1 = User::where('is_pimpinan', 'WD1')->update(['status' => 'nonaktif']);
                                                }elseif($value['is_pimpinan'] == "WD2"){
                                                    $WD2 = User::where('is_pimpinan', 'WD2')->update(['status' => 'nonaktif']);
                                                }elseif($value['is_pimpinan'] == "WD3"){
                                                    $WD3 = User::where('is_pimpinan', 'WD3')->update(['status' => 'nonaktif']);
                                                }else{
                                                    $WD4 = User::where('is_pimpinan', 'WD4')->update(['status' => 'nonaktif']);
                                                }
    
                                                $value['password'] = Hash::make('123456');
                                                // $value['password'] = Hash::make($value['password']);
                                                // $value->merge(['password' => $password]);
        
                                                // $users->role_id = $value['role_id'];
                                                if($value['role_id'] == 1){
                                                    $value['unitkerja_id'] = null;
                                                    $value['is_pimpinan'] = null;
                                                }elseif($value['role_id'] == 2 || $value['role_id'] == 3){
                                                    $value['unitkerja_id'] = $value['unitkerja_id'];
                                                    $value['is_pimpinan'] = null;
                                                }elseif($value['role_id'] == 4 || $value['is_pimpinan'] == null){
                                                    $value['unitkerja_id'] = $value['unitkerja_id'];
                                                    $value['is_pimpinan'] = null;
                                                }else{
                                                    $value['unitkerja_id'] = $value['unitkerja_id'];
                                                    $value['is_pimpinan'] = $value['is_pimpinan'];
                                                }
        
                                                $value['status'] = "aktif";
                                                // $value->merge(['status' => $status]);
                                                // dd($value);
        
                                                $users = User::create($value);
        
                                                if($users){
        
                                                    $profile = new profile();
                                                    $profile->user_id = $users->id;
                                                    $profile->save();
                                                }
                                                
                                                // foreach ($unitKerja as $UK){
                                                //     if($UK->id == $users->unitkerja_id){
                                                //         $UKs = $UK->name;
                                                //     }else{
                                                //         $UKs = "PUSAT";
                                                //     }
                                                // }
                                                
                                                $pass = "123456";
    
                                                $details = [
                                                        'name' => $users->name,
                                                        'roles' => $users->role_id,
                                                        'unitKerja' => $users->unitkerja_id,
                                                        'password' => $pass,
                                                        'status' => $users->status,
                                                        'created' => $users->created_at,
                                                ];
                                        
                                                // \Mail::to($users->email)->send(new \App\Mail\sendMailCreateUser($details));
                                            }
                                        }else{
                                            $value['password'] = Hash::make('123456');
                                            // $value['password'] = Hash::make($value['password']);
                                            // $value->merge(['password' => $password]);
    
                                            // $users->role_id = $value['role_id'];
                                            if($value['role_id'] == 1){
                                                $value['unitkerja_id'] = null;
                                                $value['is_pimpinan'] = null;
                                            }elseif($value['role_id'] == 2 || $value['role_id'] == 3){
                                                $value['unitkerja_id'] = $value['unitkerja_id'];
                                                $value['is_pimpinan'] = null;
                                            }elseif($value['role_id'] == 4 || $value['is_pimpinan'] == null){
                                                $value['unitkerja_id'] = $value['unitkerja_id'];
                                                $value['is_pimpinan'] = null;
                                            }else{
                                                $value['unitkerja_id'] = $value['unitkerja_id'];
                                                $value['is_pimpinan'] = $value['is_pimpinan'];
                                            }
    
                                            $value['status'] = "aktif";
                                            // $value->merge(['status' => $status]);
                                            // dd($value);
    
                                            $users = User::create($value);
                                            // dd($users->unitkerja_id);
    
                                            if($users){
    
                                                $profile = new profile();
                                                $profile->user_id = $users->id;
                                                $profile->save();
                                            }
                                            
                                            // foreach ($unitKerja as $UK){
                                            //     if($UK->id == $users->unitkerja_id){
                                            //         $UKs = $UK->name;
                                            //     }else{
                                            //         $UKs = "PUSAT";
                                            //     }
                                            // }
                                            // dd($UKs);
                                            
                                            $pass = "123456";
                                            
                                            $details = [
                                                    'name' => $users->name,
                                                    'roles' => $users->role_id,
                                                    'unitKerja' => $users->unitkerja_id,
                                                    'password' => $pass,
                                                    'status' => $users->status,
                                                    'created' => $users->created_at,
                                            ];
                                    
                                            // \Mail::to($users->email)->send(new \App\Mail\sendMailCreateUser($details));
                                        }

                                        // $details = [
                                        //     'name' => $users->name
                                        // ];
                                
                                        // \Mail::to($users->email)->send(new \App\Mail\sendMailCreateUser($details));

                                    // }else{
                                    //     return back()->with('error', 'Password minimal 8 karakter wajib di isi, Users gagal ditambah');
                                    // }

                                // }else{
                                //     return back()->with('error', 'Password wajib di isi dan harus sama, Users gagal ditambah');
                                // }

                            }else{
                                return back()->with('error', 'Roles wajib di isi, Users gagal ditambah');
                            }

                        // }else{
                        //     return back()->with('error', 'Unit Kerja wajib di isi, Users gagal ditambah');
                        // }

                    }else{
                        return back()->with('error', 'Email wajib di isi, Users gagal ditambah');
                    }

                }else{
                    return back()->with('error', 'Nama wajib di isi, Users gagal ditambah');
                }
            }
            return back()->with('success', 'Users berhasil ditambah');
                
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $users = User::with('unitKerja')->findOrFail($id);
        return view('menu.users.show', compact('users'));
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        $unitKerja = unitKerjas::all();
        $roles = Role::all();
        return view('menu.users.edit', compact('users', 'unitKerja', 'roles'));
    }

    public function update(Request $request, $id)
    {
        try{
            // $valid = $request->validate([
            //     'name' => ['string', 'max:255'],
            //     'email' => ['string', 'email', 'max:255', 'unique:users'],
            //     'password' => ['string', 'min:8', 'confirmed'],
            //     'checkbox' =>'accepted',
            // ]);
    
            if (!empty($request->password)) {
                // $valid['password'] = 'required|min:8|max:191';
                $request->password = 'required|min:8|max:191';
                $request->merge(['password' => Hash::make($request->password)]);
            } else {
                $request->replace($request->except('password'));
            }
            
            // $request->validate($valid);
    
            $users = User::findOrFail($id);
            $users->update($request->all());
            
            return redirect()->route('users.show', $users->id)->with('success', 'Pengguna berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->back()->with('success', 'Pengguna berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function Change(Request $request)
    {
        try{
            $id =  $request->id;
            $data['status'] =  $request->status;
                
            DB::table('users')->where('id',$id)->update($data);
            return redirect()->back();
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
