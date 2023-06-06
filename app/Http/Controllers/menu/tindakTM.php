<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\hasilRapatTM;
use App\Models\tindakLanjutTM;

use App\Models\User;
use App\Models\unitKerjas;

class tindakTM extends Controller
{
    // public function index()
    // {
    //     $tindakTM = tindakLanjutTM::get();
    //     $hasilTM = hasilRapatTM::get();
    //     // dd($tindakTM);

    //     return view('menu.tindakTM.index', compact('tindakTM','hasilTM'));
    //     // return view('menu.tindakTM.index');
    // }

    public function history()
    {
        $users = User::whereIn('role_id', ['3'])->get();
        $hasilTM = hasilRapatTM::get();
        // $users = User::get();
        // $tindakTM = tindakLanjutTM::get();

        if(auth()->user()->role_id == 1){
            $tindakTM = DB::table('jadwal_audit')
                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                    ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', '=', 'hasil_rapattm.id')
                    // ->where('jadwal_audit.status', "nonaktif")
                    // ->where('tinjauan_manajemen.status', "aktif")
                    // ->orWhere('tinjauan_manajemen.status', "nonaktif")
                    // ->where('hasil_rapattm.status', "aktif")
                    // ->orWhere('hasil_rapattm.status', "nonaktif")
                    
                    ->where('jadwal_audit.status', "nonaktif")
                    ->where('tinjauan_manajemen.status', "nonaktif")
                    ->where('hasil_rapattm.status', "nonaktif")
                    ->orderBy('tindak_lanjuttm.created_at', 'desc')
                    ->get();

            // $tindakTM = tindakLanjutTM::with('hasilRapatTM')->get();

        }else{
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                    ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', '=', 'hasil_rapattm.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    // ->where('jadwal_audit.status', "nonaktif")
                    // ->where('tinjauan_manajemen.status', "aktif")
                    // ->orWhere('tinjauan_manajemen.status', "nonaktif")
                    // ->where('hasil_rapattm.status', "aktif")
                    // ->orWhere('hasil_rapattm.status', "nonaktif")
                    
                    ->where('jadwal_audit.status', "nonaktif")
                    ->where('tinjauan_manajemen.status', "nonaktif")
                    ->where('hasil_rapattm.status', "nonaktif")
                    ->orderBy('tindak_lanjuttm.created_at', 'desc')
                    ->get();

            if($pivot){
                $tindakTM = $pivot;
            }else{
                $tindakTM = [];
            }
        }

        return view('menu.tindakTM.history', compact('tindakTM', 'hasilTM', 'users'));
    }

    public function create()
    {
        $hasilTM = hasilRapatTM::get();  
        $users = User::whereIn('role_id', ['3'])->get();
        $unitKerja = unitKerjas::get();
        return view('menu.tindakTM.create', compact('hasilTM', 'users', 'unitKerja'));
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $valid = [
                'hslrpt_id' => 'required',
                'tindakLanjut' => 'required|min:3|max:255',
                'PIC' => 'required',
            ];
            
            $request->validate($valid);
                           
            $valuePIC = implode(',', $request->PIC);
            $request->merge(['PIC' => $valuePIC]);
                                            
            $tindak = tindakLanjutTM::create($request->all());
                    
            return redirect()->route('tindakLanjutTM.show', $tindak->id)->with('success', 'Tindak Lanjut TM berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function tindakLanjutTMSaveMulti(Request $request)
    {
        try{
            // dd($request);                   
            foreach ($request->addmore as $key => $value) {
                if ($value['hslrpt_id'] != null){
                    if($value['tindakLanjut'] != null){
                        if($value['PIC'] != null){
                        
                            $value['PIC'] = implode(',', $value['PIC']);
                            tindakLanjutTM::create($value);

                        }else{
                            return back()->with('error', 'Uraian wajib di isi, Tindak Lanjut TM gagal ditambah');
                        }

                    }else{
                        return back()->with('error', 'Subjek wajib di isi, Tindak Lanjut TM gagal ditambah');
                    }

                }else{
                    return back()->with('error', 'Jadwal TM wajib di isi, Tindak Lanjut TM gagal ditambah');
                }
            }
            return back()->with('success', 'Tindak Lanjut TM berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $tindakTM = tindakLanjutTM::findOrFail($id);
        $hasilTM = hasilRapatTM::get();
        $users = User::get();

        return view('menu.tindakTM.show', compact('tindakTM','hasilTM', 'users'));
    }

    public function edit($id)
    {
        $tindakTM = tindakLanjutTM::findOrFail($id);
        // dd($tindakTM);
        $hasilTM = hasilRapatTM::get();
        $users = User::get();

        $hasil = explode(',', $tindakTM->PIC);
        foreach($hasil as $key=>$pv){
            $tes[$key] = (int)$pv;
        }        
        // dd($tes);

        return view('menu.tindakTM.edit', compact('tindakTM','hasilTM', 'users', 'tes'));
    }

    public function update(Request $request, $id)
    {
        try{
            // dd($request);
            $valid = [
                'tindakLanjut' => 'min:3|max:255'
            ];
            
            $request->validate($valid);

            if(!empty($request->PIC)){
                $valuePIC = implode(',', $request->PIC);
                // dd($valuePIC);
                $request->merge(['PIC' => $valuePIC]);
            }
    
            $tindakTM = tindakLanjutTM::findOrFail($id);
            $tindakTM->update($request->all());
                    
            return redirect()->route('tindakLanjutTM.show', $tindakTM->id)->with('success', 'Tindak Lanjut TM berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $tindakTM = tindakLanjutTM::findOrFail($id);
            $tindakTM->delete();

            return back()->with('success', 'Tindak Lanjut TM berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
