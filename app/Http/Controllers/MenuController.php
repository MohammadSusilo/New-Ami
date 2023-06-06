<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

use App\Models\menu;
use App\Models\Role;

class MenuController extends Controller
{
    public function index()
    {
        $menus = menu::get();
        $roles = Role::get();

        return view('menu.menus.index', compact('menus', 'roles'));
    }

    public function create()
    {
        $roles = Role::get();

        return view('menu.menus.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try{
            $valid = [
                'name' => 'required|min:3|max:255',
                'level' => 'required',
                'url' => 'required',
                'role_id' => 'required',
            ];
            
            $request->validate($valid);
                           
            $valueRole = implode(',', $request->role_id);
            $request->merge(['role_id' => $valueRole]);
                                            
            $menu = menu::create($request->all());
                    
            return redirect()->route('menu.show', $menu->id)->with('success', 'Menu berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function menuSaveMulti(Request $request)
    {
        try{               
            foreach ($request->addmore as $key => $value) {
                if ($value['name'] != null){
                    if($value['level'] != null){
                        if($value['url'] != null){
                            if($value['role_id'] != null){
                            
                                $value['role_id'] = implode(',', $value['role_id']);
                                menu::create($value);

                            }else{
                                return back()->with('error', 'Role di isi, Menu gagal ditambah');
                            }

                        }else{
                            return back()->with('error', 'URL wajib di isi, Menu gagal ditambah');
                        }

                    }else{
                        return back()->with('error', 'Level wajib di isi, Menu gagal ditambah');
                    }

                }else{
                    return back()->with('error', 'Judul wajib di isi, Menu gagal ditambah');
                }
            }
            return back()->with('success', 'Menu berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $menu = menu::findOrFail($id);
        $roles = Role::get();

        return view('menu.menus.show', compact('menu', 'roles'));
    }

    public function edit($id)
    {
        $menu = menu::findOrFail($id);
        $roles = Role::get();

        $hasil = explode(',', $menu->role_id);
        foreach($hasil as $key=>$pv){
            $tes[$key] = (int)$pv;
        }        
        // dd($tes);

        return view('menu.menus.edit', compact('menu', 'roles', 'tes'));
    }

    public function update(Request $request, $id)
    {
        try{

            if(!empty($request->role_id)){
                $valueRole = implode(',', $request->role_id);
                // dd($valueRole);
                $request->merge(['role_id' => $valueRole]);
            }
    
            $menu = menu::findOrFail($id);
            $menu->update($request->all());
                    
            return redirect()->route('menu.show', $menu->id)->with('success', 'Menu berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $menu = menu::findOrFail($id);
            $menu->delete();

            return back()->with('success', 'Menu berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
