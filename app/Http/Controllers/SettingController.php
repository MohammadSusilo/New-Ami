<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

use App\Models\setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = DB::table('frontEnd')->first();
        $banners = DB::table('frontEnd_banner')->get();
        $faqs = DB::table('faqs')->get();

        return view('menu.setting.index', compact('setting', 'banners', 'faqs'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
                'tittle' => 'min:3|max:50',
                'welcome' => 'min:3|max:255',
                'logo' => 'mimes:svg,jpg,jpeg,png',
                'favicon' => 'mimes:svg,jpg,jpeg,png',
            ];
    
            $request->validate($valid);
            $setting = setting::findOrFail($id);

            if(!empty($request->file('logo'))){
                File::delete($setting->logo);
                $file  = $request->file('logo');
                $fileName   = $file->getClientOriginalName();

                $request->file('logo')->move("storage/files/Pusat/Setting/",$fileName);

                $fileBuktiLogo = "storage/files/Pusat/Setting/".$fileName;

                $request->merge(['file' => $fileBuktiLogo]);
            }else{
                $fileBuktiLogo = $setting->logo;
            }

            if(!empty($request->file('favicon'))){
                File::delete($setting->favicon);
                $file  = $request->file('favicon');
                $fileName   = $file->getClientOriginalName();

                $request->file('favicon')->move("storage/files/Pusat/Setting/",$fileName);

                $fileBuktiFavicon = "storage/files/Pusat/Setting/".$fileName;

                $request->merge(['file' => $fileBuktiFavicon]);
            }else{
                $fileBuktiFavicon = $setting->favicon;
            }

            $setting->update([
                'tittle'=> $request->tittle,
                'welcome'=> $request->welcome,
                'logo' => $fileBuktiLogo,
                'favicon' => $fileBuktiFavicon,
            ]);
            // $buktiKinerja->update($request->all());

            return redirect()->back()->with('success', 'Setting berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }
}
