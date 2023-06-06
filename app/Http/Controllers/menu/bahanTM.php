<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;

use App\Models\CAR;

use App\Models\hasilTM;
use App\Models\jadwalAudit;
use App\Models\bahanRapatTM;
use App\Models\tinjauanManajemen;

class bahanTM extends Controller
{
    // public function index()
    // {
    //     $jadwalTM = tinjauanManajemen::get();
    //     $bahanTM = bahanRapatTM::get();

    //     return view('menu.bahanTM.index', compact('jadwalTM','bahanTM'));
    //     // return view('menu.bahanTM.index');
    // }

    public function history()
    {
        if(auth()->user()->role_id == 1){
            $bahanTM = DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                            // ->where('jadwal_audit.status', "nonaktif")
                            // ->where('tinjauan_manajemen.status', "aktif")
                            // ->orWhere('tinjauan_manajemen.status', "nonaktif")
                            ->where('bahan_rapattm.status', "nonaktif")
                            ->orderBy('bahan_rapattm.created_at', 'desc')
                            ->get();
            // $bahanTM = bahanRapatTM::with('tinjauanManajemen')->get();

        }else{
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    // ->where('jadwal_audit.status', "nonaktif")
                    // ->where('tinjauan_manajemen.status', "aktif")
                    // ->orWhere('tinjauan_manajemen.status', "nonaktif")
                    ->where('bahan_rapattm.status', "nonaktif")
                    ->orderBy('bahan_rapattm.created_at', 'desc')
                    ->get();

            if($pivot){
                $bahanTM = $pivot;
            }else{
                $bahanTM = [];
            }
        }

        return view('menu.bahanTM.history', compact('bahanTM'));
    }

    public function importBahanTM()
    {
        $CAR = DB::table('jadwal_audit')
            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
            ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
            ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
            ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
            ->select('car.*', 'jadwal_audit.unitkerja_id', 'jadwal_audit.id as jadwalID', 'tinjauan_manajemen.id as tm_id', 'tinjauan_manajemen.tglTM')
            ->where('tinjauan_manajemen.status', 'aktif')
            ->where('jadwal_audit.status', 'aktif')
            ->where('car.status', 'closed')
            ->where('car.hasilPemeriksaan', 'nonsesuai')
            ->where('car.is_bahanTM', 0)
            ->distinct('car.id')
            // ->groupBy('laporan_audit.id')
            ->get();
        // dd($CAR);

        $getbahanTM = bahanRapatTM::get();
        // dd($CAR);

        $modalbahanTM = '';
        $modalbahanTM .= '<table class="table table-bordered table-striped" id="addCARNonSesuai">
        <tr>
            <th class="required">No</th>
            <th class="required">Jadwal TM</th>
            <th class="required">Unit Kerja</th>
            <th class="required">Auditor</th>
            <th class="required">Auditee</th>
            <th class="required">Laporan Temuan</th>
            <th class="required">Action</th>
        </tr>';
    
        // $modalbahanTM .= '<tr>';
        
            foreach ($CAR as $key=>$CARs) { //CAR TIDAK SESUAI
                $users = DB::table('users_jadwalaudit')
                    ->join('jadwal_audit', 'users_jadwalaudit.jadwal_id', '=', 'jadwal_audit.id')
                    ->join('users', 'users_jadwalaudit.user_id', '=', 'users.id')
                    ->select('users.*')
                    ->where('jadwal_audit.id', $CARs->jadwalID)
                    ->where('users.status', 'aktif')
                    ->get();

                $unitKerja = DB::table('unitkerja')->get();
                
                // if($getbahanTM->car_id != $CARs->id){
                        $modalbahanTM .= '<tr>';
                            $modalbahanTM .= '<td>'.++$key.'</td>';
                            $modalbahanTM .= '<td>
                                                <input type="text" class="form-control" placeholder="'.date('d F Y', strtotime($CARs->tglTM)).'" disabled>
                                                <input type="hidden" name="addCARNonSeuai['.$key.'][tm_id]" value="'.$CARs->tm_id.'">';
                            $modalbahanTM .= '</td>';
                            $modalbahanTM .= '<td>';
                                foreach ($unitKerja as $UK) {
                                    if($UK->id == $CARs->unitkerja_id){
                                        $modalbahanTM .= $UK->name;
                                    }
                                }
                            $modalbahanTM .= '</td>';
                            $modalbahanTM .= '<td>';
                                foreach ($users as $user) {
                                    if($user->role_id == 2){
                                        $modalbahanTM .= '<span class="badge badge-pill badge-primary">'.$user->name.'</span>';
                                    }
                                }
                            $modalbahanTM .= '</td>';
                            $modalbahanTM .= '<td>';
                                foreach ($users as $user) {
                                    if($user->role_id == 3){
                                        $modalbahanTM .= '<span class="badge badge-pill badge-primary">'.$user->name.'</span>';
                                    }
                                }
                            $modalbahanTM .= '</td>';
                            $modalbahanTM .= '<td>
                                                <textarea rows="4" cols="50" disabled>'.$CARs->laporanTemuan.'</textarea>
                                                <input type="hidden" name="addCARNonSeuai['.$key.'][deskripsi]" value="'.$CARs->laporanTemuan.'">
                                                <input type="hidden" name="addCARNonSeuai['.$key.'][car_id]" value="'.$CARs->id.'">';
                            $modalbahanTM .= '</td>';
                            $modalbahanTM .= '<td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button></td>';
                        $modalbahanTM .= '</tr>';
                
                // }else{
                //     $modalbahanTM .= '';
                // }

                    // if(empty($getCAR)){
                    //     $modalbahanTM .= '<tr>';
                    //     $modalbahanTM .= '<td>KOSONG, ISILAH</td>';
                    //     $modalbahanTM .= '</tr>';

                    // }else{
                    //     // $modalbahanTM .= '<td>ISI DONG, CEK</td>';
                    //     foreach ($getCAR as $getCARs) {
                    //     if($getCARs->car_id != $CARs->id){
                    //         // $modalbahanTM .= '<tr>';
                    //         // $modalbahanTM .= '<td>TIDAK SESUAI, ISILAH</td>';
                    //         // $modalbahanTM .= '</tr>';
                    //         $modalbahanTM .= '<tr>';
                    //             $modalbahanTM .= '<td>'.++$key.'</td>';
                    //             $modalbahanTM .= '<td>
                    //                                 <input type="text" class="form-control" placeholder="'.date('d F Y', strtotime($CARs->tglTM)).'" disabled>
                    //                                 <input type="hidden" name="addCARNonSeuai['.$key.'][tm_id]" value="'.$CARs->tm_id.'">';
                    //             $modalbahanTM .= '</td>';
                    //             $modalbahanTM .= '<td>';
                    //                 foreach ($unitKerja as $UK) {
                    //                     if($UK->id == $CARs->unitkerja_id){
                    //                         $modalbahanTM .= $UK->name;
                    //                     }
                    //                 }
                    //             $modalbahanTM .= '</td>';
                    //             $modalbahanTM .= '<td>';
                    //                 foreach ($users as $user) {
                    //                     if($user->role_id == 2){
                    //                         $modalbahanTM .= '<span class="badge badge-pill badge-primary">'.$user->name.'</span>';
                    //                     }
                    //                 }
                    //             $modalbahanTM .= '</td>';
                    //             $modalbahanTM .= '<td>';
                    //                 foreach ($users as $user) {
                    //                     if($user->role_id == 3){
                    //                         $modalbahanTM .= '<span class="badge badge-pill badge-primary">'.$user->name.'</span>';
                    //                     }
                    //                 }
                    //             $modalbahanTM .= '</td>';
                    //             $modalbahanTM .= '<td>
                    //                                 <textarea rows="4" cols="50" disabled>'.$CARs->laporanTemuan.'</textarea>
                    //                                 <input type="hidden" name="addCARNonSeuai['.$key.'][deskripsi]" value="'.$CARs->laporanTemuan.'">
                    //                                 <input type="hidden" name="addCARNonSeuai['.$key.'][car_id]" value="'.$CARs->id.'">';
                    //             $modalbahanTM .= '</td>';
                    //             $modalbahanTM .= '<td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button></td>';
                    //         $modalbahanTM .= '</tr>';
                    //     }else{
                    //         $modalbahanTM .= '';
                    //     }
                    // };
                    // }
                
            };
            $modalbahanTM .= '</table>';
        // $modalbahanTM .= '</tr>';


        return $modalbahanTM; 
        // return response()->json([
        //     'CAR' => $CAR,
        // ]);
    }

    public function create()
    {
        $jadwalTM = tinjauanManajemen::get();   
        return view('menu.bahanTM.create', compact('jadwalTM'));
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $valid = [
                'tm_id' => 'required',
                // 'deskripsi' => 'required|min:3|max:255',
            ];
            
            // $request->validate($valid);

            $getJadwal = tinjauanManajemen::get();
            foreach($getJadwal as $getJadwals){
                if($getJadwals->id == $request->tm_id){
                    $jadwal = date("j M Y", strtotime($getJadwals->tglTM));
                }
            }

            if(!empty($request->hasfile('lokasi'))){
                $file  = $request->file('lokasi');
                if($file->getSize() <= 3145728){
                    $fileName   = $jadwal."_".$file->getClientOriginalName();
                    $request->file('lokasi')->move("storage/files/Pusat/PPMP/TM/BahanTM/",$fileName);
                    $fileBukti = "storage/files/Pusat/PPMP/TM/BahanTM/".$fileName;

                }else{
                    return back()->with('error', 'File dokumen terlalu besar dari 3 MB, Bahan TM gagal ditambah');
                }
            }

            $bahan = bahanRapatTM::create([
                'tm_id' => $request->tm_id,
                'deskripsi'=> $request->deskripsi,
                'lokasi'=> $fileBukti,
                'status'=> $request->status,
            ]);

                           
            // $bahan = bahanRapatTM::create($request->all());
                    
            return redirect()->route('bahanTM.show', $bahan->id)->with('success', 'Bahan TM berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    public function bahanTMSaveMulti(Request $request)
    {
        try{
            // dd($request);
            if(!empty($request->addmore)){
                foreach ($request->addmore as $key => $value) {
                    $explode = explode('|', $value['deskripsi']);
                    // dd($explode);
                    $deskripsi = $explode[0];
                    $car_id = $explode[1];
                    $laporanaudit_id = $explode[2];

                    $jadwalTM = DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                            ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
                            ->select('tinjauan_manajemen.id')
                            ->where('car.laporanaudit_id', $laporanaudit_id)
                            ->first();
                    // dd($jadwalTM->id);

                    $bahan = bahanRapatTM::create([                
                        'tm_id' => $jadwalTM->id,
                        'deskripsi'=> $deskripsi,
                        'car_id'=> $car_id,
                        'status'=> "aktif",
                    ]);
                    
                    CAR::where('id', $bahan->car_id)->update([
                        'is_bahanTM' => 1,
                    ]);
                }

                foreach ($request->addCARNonSeuai as $key => $value) {

                    $bahan = bahanRapatTM::create([                
                        'tm_id' => $value['tm_id'],
                        'deskripsi'=> $value['deskripsi'],
                        'car_id'=> $value['car_id'],
                        'status'=> "aktif",
                    ]);

                    CAR::where('id', $bahan->car_id)->update([
                        'is_bahanTM' => 1,
                    ]);
                }

            }else{
                foreach ($request->addCARNonSeuai as $key => $value) {

                    $bahan = bahanRapatTM::create([                
                        'tm_id' => $value['tm_id'],
                        'deskripsi'=> $value['deskripsi'],
                        'car_id'=> $value['car_id'],
                        'status'=> "aktif",
                    ]);

                    CAR::where('id', $bahan->car_id)->update([
                        'is_bahanTM' => 1,
                    ]);
                }
            }


        
            return back()->with('success', 'Bahan TM berhasil ditambah');
            
            // foreach ($request->addmore as $key => $value) {
            //     if ($value['tm_id'] != null){
            //         if($value['lokasi'] != null){
                        
            //             // bahanRapatTM::create($value);
            //             if($value['lokasi']->getClientOriginalExtension() != "pdf" || $value['lokasi']->getClientOriginalExtension() != "docx" || $value['lokasi']->getClientOriginalExtension() != "doc"){
            //                 if($value['lokasi']->getSize() <= 3145728){

            //                     $getJadwal = tinjauanManajemen::get();
            //                     foreach($getJadwal as $getJadwals){
            //                         if($getJadwals->id == $value['tm_id']){
            //                             $jadwal = date("j M Y", strtotime($getJadwals->tglTM));
            //                         }
            //                     }
                
            //                     $file  = $value['lokasi'];
                                
            //                     $fileName   = $jadwal."_".$file->getClientOriginalName();
            //                     $value['lokasi']->move("storage/files/Pusat/PPMP/TM/BahanTM/",$fileName);
            //                     $fileBukti = "storage/files/Pusat/PPMP/TM/BahanTM/".$fileName;
                                    
            //                     bahanRapatTM::create([                
            //                         'tm_id' => $value['tm_id'],
            //                         'deskripsi'=> $value['deskripsi'],
            //                         'lokasi'=> $fileBukti,
            //                         'status'=> $value['status'],
            //                     ]);

            //                 }else{
            //                     return back()->with('error', 'File dokumen terlalu besar dari 3 MB, Bahan TM gagal ditambah');
            //                 }

            //             }else{
            //                 return back()->with('error', 'File dokumen tidak sesuai dengan format, Bahan TM gagal ditambah');
            //             }

            //         }else{
            //             return back()->with('error', 'Deskripsi wajib di isi, Bahan TM gagal ditambah');
            //         }

            //     }else{
            //         return back()->with('error', 'Jadwal TM wajib di isi, Bahan TM gagal ditambah');
            //     }
            // }
        
            // return back()->with('success', 'Bahan TM berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $jadwalTM = tinjauanManajemen::get();
        $bahanTM = DB::table('jadwal_audit')
            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
            ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
            ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
            ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
            ->select('bahan_rapattm.*')
            ->where('bahan_rapattm.id', $id)
            ->first();
        $fileCARs = CAR::where('car.id', '=', $bahanTM->car_id)->first();
        
        return view('menu.bahanTM.show', compact('jadwalTM','bahanTM', 'fileCARs'));
    }

    public function edit($id)
    {
        $jadwalTM = tinjauanManajemen::get();
        $bahanTM = bahanRapatTM::findOrFail($id);

        return view('menu.bahanTM.edit', compact('jadwalTM','bahanTM'));
    }

    public function update(Request $request, $id)
    {
        try{
            // dd($request);
            $valid = [
                'tm_id' => 'required',
                // 'deskripsi' => 'required|min:3|max:255',
            ];
            
            $request->validate($valid);
                           
            $bahanTM = bahanRapatTM::findOrFail($id);

            $getJadwal = tinjauanManajemen::get();
            foreach($getJadwal as $getJadwals){
                if($getJadwals->id == $request->tm_id){
                    $jadwal = date("j M Y", strtotime($getJadwals->tglTM));
                }
            }

            if(!empty($request->file('lokasi'))){
                File::delete($bahanTM->lokasi);
                $file  = $request->file('lokasi');
                $fileName   = $jadwal."_".$file->getClientOriginalName();
                $request->file('lokasi')->move("storage/files/Pusat/PPMP/TM/BahanTM/",$fileName);

                $fileBukti = "storage/files/Pusat/PPMP/TM/BahanTM/".$fileName;
                $request->merge(['lokasi' => $fileBukti]);
            }else{
                $fileBukti = $bahanTM->lokasi;
            }

            $bahanTM->update([
                'tm_id' => $request->tm_id,
                'deskripsi'=> $request->deskripsi,
                'lokasi'=> $fileBukti,
                'status'=> $request->status,
            ]);
            // $bahanTM->update($request->all());
                    
            return redirect()->route('bahanTM.show', $bahanTM->id)->with('success', 'Bahan TM berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $bahanTM = bahanRapatTM::findOrFail($id);
            File::delete($bahanTM->lokasi);
            $bahanTM->delete();

            return back()->with('success', 'Bahan TM berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
