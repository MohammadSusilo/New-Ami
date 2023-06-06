<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('menu.roles.index',compact('roles'));
    }

    public function create()
    {
        return view('menu.roles.create');
    }

    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'name' => 'required',
                'desc' => 'required'
            ]);

            $status = !empty($request->status) ? $request->status : "aktif";
            $request->merge(['status' => $status]);

            $roles = Role::create($request->all());

            return redirect()->route('roles.show', $roles->id)->with('success', 'Rule berhasil ditambah');
                    
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $roles = Role::where('id', $id)->first();
        return view('menu.roles.show',compact('roles'));
    }

    public function edit($id)
    {
        $roles = Role::findOrFail($id);
        return view('menu.roles.edit',compact('roles'));
    }

    public function update(Request $request, $id)
    {
        try{
            $roles = Role::findOrFail($id);
            $roles->update($request->all());

            return redirect()->route('roles.show', $roles->id)->with('success', 'Rule berhasil diubah');
                    
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $roles = Role::findOrFail($id);
            $roles->delete();

            return redirect()->back()->with('success', 'Rule berhasil dihapus');
                        
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
