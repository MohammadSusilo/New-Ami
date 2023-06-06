<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\hasilTM;
use App\Models\jadwalAudit;
use App\Models\bahanRapatTM;
use App\Models\tinjauanManajemen;


class jadwalTM extends Controller
{
    // public function index()
    // {
    //     $jadwalAudit = jadwalAudit::get();
    //     $jadwalTM = tinjauanManajemen::get();

    //     return view('menu.jadwalTM.index', compact('jadwalAudit','jadwalTM'));
    // }

    public function history()
    {
        $jadwalAudit = jadwalAudit::get();

        if(auth()->user()->role_id == 1){
            // $jadwalTM = tinjauanManajemen::with('jadwalAudit')->get();
            $jadwalTM = DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->where('tinjauan_manajemen.status', "nonaktif")
                            // ->where('jadwal_audit.status', "nonaktif")
                            ->orderBy('tinjauan_manajemen.created_at', 'desc')
                            ->get();

        }else{
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    ->where('tinjauan_manajemen.status', "nonaktif")
                    // ->where('jadwal_audit.status', "nonaktif")
                    ->orderBy('tinjauan_manajemen.created_at', 'desc')
                    ->get();
                    // dd($pivot);

            if($pivot){
                $jadwalTM = $pivot;
            }else{
                $jadwalTM = [];
            }
        }

        return view('menu.jadwalTM.history', compact('jadwalTM','jadwalAudit'));
    }

    public function jadwalTMnew($id)
    {
        $idKU = $id;
        return view('menu.jadwalTM.create', compact('idKU'));
    }

    public function jadwalTMSaveMulti(Request $request)
    {
        try{
            // dd($request);
            foreach ($request->addmore as $key => $value) {
                // if ($value['unitkerja_id'] != null || $value['users'] != null){
                            $tahun = date('Y', strtotime($request->date));

                            tinjauanManajemen::create([
                                'tahun' => $tahun,
                                'tglTM'=> $request->date,
                                'waktuTM'=> $request->time,
                                'audit_id'=> $value['audit_id'],
                                'status'=> "aktif",
                            ]);

                // }else{
                //     return back()->with('error', 'Periode, Unit Kerja, dan User wajib di isi, Jadwal Audit gagal ditambah');
                // }
            }

            return back()->with('success', 'Jadwal Audit berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $valid = [
                'tahun' => 'required',
                'tglTM' => 'required',
            ];

            $request->validate($valid);
            $jadwal = tinjauanManajemen::create($request->all());
            
            return redirect()->route('jadwalTM.show', $jadwal->id)->with('success', 'Jadwal TM berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $jadwalAudit = jadwalAudit::get();
        $jadwalTM = tinjauanManajemen::findOrFail($id);

        return view('menu.jadwalTM.show', compact('jadwalAudit','jadwalTM'));
    }

    public function edit($id)
    {
        $jadwalAudit = jadwalAudit::get();
        $jadwalTM = tinjauanManajemen::findOrFail($id);

        return view('menu.jadwalTM.edit', compact('jadwalAudit','jadwalTM'));
    }

    public function update(Request $request, $id)
    {
        try{
            // dd($request);
            $valid = [
                'tahun' => 'required',
                'tglTM' => 'required',
            ];

            $request->validate($valid);
            
            $jadwalTM = tinjauanManajemen::findOrFail($id);
            $jadwalTM->update($request->all());
            
            return redirect()->route('jadwalTM.show', $jadwalTM->id)->with('success', 'Jadwal TM berhasil diubah');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $jadwalTM = tinjauanManajemen::findOrFail($id);
            $jadwalTM->delete();

            return back()->with('success', 'Jadwal TM berhasil dihapus');
            
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
