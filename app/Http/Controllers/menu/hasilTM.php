<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\CAR;
use App\Models\hasilRapatTM;
use App\Models\jadwalAudit;
use App\Models\bahanRapatTM;
use App\Models\tinjauanManajemen;

use App\Models\unitKerjas;

class hasilTM extends Controller
{
    // public function index()
    // {
    //     $jadwalTM = tinjauanManajemen::get();
    //     $hasilTM = hasilRapatTM::get();

    //     return view('menu.hasilTM.index', compact('jadwalTM','hasilTM'));
    //     // return view('menu.hasilTM.index');
    // }

    public function importHasilTM()
    {
        $JadwalTM = DB::table('tinjauan_manajemen')
            ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
            ->select('bahan_rapattm.*', 'tinjauan_manajemen.tglTM', 'tinjauan_manajemen.audit_id', 'tinjauan_manajemen.id as TMID', 'tinjauan_manajemen.tahun')
            ->where('tinjauan_manajemen.status', 'aktif')
            ->where('bahan_rapattm.status', 'aktif')
            // ->distinct('car.id')
            ->get();
            
        $hasilTM = DB::table('hasil_rapattm')->get();
        if(count($hasilTM) > 0){
            foreach ($hasilTM as $hasilTMs) {
                $hasil[] = $hasilTMs->bahan_id;
            }
        }else{
            $hasil = [];
        }
        
        $modalbahanTM = '';
        foreach ($JadwalTM as $key=>$JadwalTMs) {
            if(count($hasil) > 0){
                if(in_array($JadwalTMs->id ,$hasil)) {

                }else{

                $unitKerja = DB::table('unitkerja')->get();
                $jadwalAudit = DB::table('jadwal_audit')->where('id', $JadwalTMs->audit_id)->first();
                $CAR = DB::table('car')->where('id', $JadwalTMs->car_id)->first();
                // dd($CAR);
                    $modalbahanTM .= '
                            <div class="card-body" id="cols">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Jadwal TM</label>
                                                            <input type="text" class="form-control" placeholder="'.date('d F Y', strtotime($JadwalTMs->tglTM)).'" disabled>
                                                            <input type="hidden" name="addmore['.$key.'][tm_id]" value="'.$JadwalTMs->tm_id.'">
                                                            <input type="hidden" name="addmore['.$key.'][bahan_id]" value="'.$JadwalTMs->id.'">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Unit Kerja</label>
                    ';
                                                foreach ($unitKerja as $UK) {
                                                    if($UK->id == $jadwalAudit->unitkerja_id){
                                                        $modalbahanTM .= '<input type="text" class="form-control" placeholder="'.$UK->name.'" disabled>';
                                                    }
                                                }
                    $modalbahanTM .=                '</div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Subjek</label>
                                                            <input type="text" class="form-control" placeholder="'.$CAR->laporanTemuan.'" disabled>
                                                            <input type="hidden" name="addmore['.$key.'][subjek]" value="'.$CAR->laporanTemuan.'">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Uraian</label>
                                                            <input type="text" class="form-control" placeholder="'.$CAR->analisiPenyebabMasalah.'" disabled>
                                                            <input type="hidden" name="addmore['.$key.'][uraian]" value="'.$CAR->analisiPenyebabMasalah.'">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label>Hasil Pembahasan</label>
                                                            <textarea class="form-control" rows="4" name="addmore['.$key.'][hasilPembahasan]" placeholder="Hasil Pembahasan..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Hadir</label>
                                                            <input type="number" class="form-control" name="addmore['.$key.'][hadir]" placeholder="Hadir">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Tidak Hadir</label>
                                                            <input type="number" class="form-control" name="addmore['.$key.'][tidakHadir]" placeholder="Tidak Hadir">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    ';
                }
            }else{
                $unitKerja = DB::table('unitkerja')->get();
                $jadwalAudit = DB::table('jadwal_audit')->where('id', $JadwalTMs->audit_id)->first();
                $CAR = DB::table('car')->where('id', $JadwalTMs->car_id)->first();
                    $modalbahanTM .= '
                            <div class="card-body" id="cols">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-default">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Jadwal TM</label>
                                                            <input type="text" class="form-control" placeholder="'.date('d F Y', strtotime($JadwalTMs->tglTM)).'" disabled>
                                                            <input type="hidden" name="addmore['.$key.'][tm_id]" value="'.$JadwalTMs->tm_id.'">
                                                            <input type="hidden" name="addmore['.$key.'][bahan_id]" value="'.$JadwalTMs->id.'">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Unit Kerja</label>
                    ';
                                                foreach ($unitKerja as $UK) {
                                                    if($UK->id == $jadwalAudit->unitkerja_id){
                                                        $modalbahanTM .= '<input type="text" class="form-control" placeholder="'.$UK->name.'" disabled>';
                                                    }
                                                }
                    $modalbahanTM .=                '</div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Subjek</label>
                                                            <input type="text" class="form-control" placeholder="'.$CAR->laporanTemuan.'" disabled>
                                                            <input type="hidden" name="addmore['.$key.'][subjek]" value="'.$CAR->laporanTemuan.'">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Uraian</label>
                                                            <input type="text" class="form-control" placeholder="'.$CAR->analisiPenyebabMasalah.'" disabled>
                                                            <input type="hidden" name="addmore['.$key.'][uraian]" value="'.$CAR->analisiPenyebabMasalah.'">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label>Hasil Pembahasan</label>
                                                            <textarea class="form-control" rows="4" name="addmore['.$key.'][hasilPembahasan]" placeholder="Hasil Pembahasan..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Hadir</label>
                                                            <input type="number" class="form-control" name="addmore['.$key.'][hadir]" placeholder="Hadir">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Tidak Hadir</label>
                                                            <input type="number" class="form-control" name="addmore['.$key.'][tidakHadir]" placeholder="Tidak Hadir">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    ';
            }
        };

        // $modalbahanTM .= '<table class="table table-bordered table-striped">
        // <tr>
        //     <th class="required">No</th>
        //     <th class="required">Jadwal TM</th>
        //     <th class="required">Unit Kerja</th>
        //     <th class="required">Subjek</th>
        //     <th class="required">Uraian</th>
        //     <th class="required">Hasil Pembahasan</th>
        //     <th class="required">Hadir</th>
        //     <th class="required">Tidak Hadir</th>
        //     <th class="required">Action</th>
        // </tr>';
        
        //     foreach ($JadwalTM as $key=>$JadwalTMs) {
        //         $unitKerja = DB::table('unitkerja')->get();
        //         $jadwalAudit = DB::table('jadwal_audit')->where('id', $JadwalTMs->audit_id)->first();
        //         $CAR = DB::table('car')->where('id', $JadwalTMs->car_id)->first();
        //                 $modalbahanTM .= '<tr>';
        //                     $modalbahanTM .= '<td>'.++$key.'</td>';
        //                     $modalbahanTM .= '<td>
        //                                         <input type="text" class="form-control" placeholder="'.date('d F Y', strtotime($JadwalTMs->tglTM)).'" disabled>
        //                                         <input type="hidden" name="addhasilTM['.$key.'][tm_id]" value="'.$JadwalTMs->tm_id.'">';
        //                     $modalbahanTM .= '</td>';

        //                     $modalbahanTM .= '<td>';
        //                         foreach ($unitKerja as $UK) {
        //                             if($UK->id == $jadwalAudit->unitkerja_id){
        //                                 $modalbahanTM .= $UK->name;
        //                             }
        //                         }
        //                     $modalbahanTM .= '</td>';

        //                     $modalbahanTM .= '<td>';
        //                     $modalbahanTM .= '<input type="text" class="form-control" placeholder="'.$CAR->laporanTemuan.'" disabled>
        //                                     <input type="hidden" name="addhasilTM['.$key.'][subjek]" value="'.$CAR->laporanTemuan.'">';
        //                     $modalbahanTM .= '</td>';

        //                     $modalbahanTM .= '<td>';
        //                     $modalbahanTM .= '<input type="text" class="form-control" placeholder="'.$CAR->analisiPenyebabMasalah.'" disabled>
        //                                     <input type="hidden" name="addhasilTM['.$key.'][subjek]" value="'.$CAR->analisiPenyebabMasalah.'">';
        //                     $modalbahanTM .= '</td>';

        //                     $modalbahanTM .= '<td>';
        //                     $modalbahanTM .= '</td>';
        //                     $modalbahanTM .= '<td>';
        //                     $modalbahanTM .= '</td>';
        //                     $modalbahanTM .= '<td>';
        //                     $modalbahanTM .= '</td>';
        //                     // $modalbahanTM .= '<td>';
        //                     // $modalbahanTM .= '<textarea rows="4" name="addInputhasilTM['.$key.'][hasilPembahasan]" cols="50"></textarea>';
        //                     // $modalbahanTM .= '</td>';
        //                     // $modalbahanTM .= '<td>';
        //                     // $modalbahanTM .= '<input type="number" class="form-control" name="addInputhasilTM['.$key.'][hadir]" placeholder="Hadir">';
        //                     // $modalbahanTM .= '</td>';
        //                     // $modalbahanTM .= '<td>';
        //                     // $modalbahanTM .= '<input type="number" class="form-control" name="addInputhasilTM['.$key.'][tidakHadir]" placeholder="Tidak Hadir">';
        //                     // $modalbahanTM .= '</td>';
        //                     $modalbahanTM .= '<td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button></td>';
        //                 $modalbahanTM .= '</tr>';
                
        //     };
        //     $modalbahanTM .= '</table>';


        return $modalbahanTM;
    }

    public function hasilTMget(Request $request)
    {
        try{
            $keywordRaw = $request->tm_id;


            $hasil = hasilRapatTM::get();
            $d = count($hasil);

            if($d != 0){
                foreach($hasil as $hasilTM){
                    if($hasilTM->tm_id == $keywordRaw){
                        $bahanTM = array();
                        $cars = array();
                        return '<p class="text-muted"> Maaf data sudah terinput </p>';
                    }else {
                        $bahanTM = bahanRapatTM::where('tm_id', $keywordRaw)->get();
                        $cars = CAR::get();

                        $c = count($bahanTM);

                        if($c == 0){
                            return '<p class="text-muted"> Maaf data tidak ditemukan </p>';
                        }else{
                            return view('menu.hasilTM.hasilTMlist')->with([
                                'data' => $bahanTM,
                                'data1' => $cars
                            ]);
                        }
                    }
                }
            }else{
            
                    $bahanTM = bahanRapatTM::where('tm_id', $keywordRaw)->get();
                    $cars = CAR::get();

                    $c = count($bahanTM);

                    if($c == 0){
                        return '<p class="text-muted"> Maaf data tidak ditemukan </p>';
                    }else{
                        return view('menu.hasilTM.hasilTMlist')->with([
                            'data' => $bahanTM,
                            'data1' => $cars
                        ]);
                    }

            }
            // $bahanTM = bahanRapatTM::where('tm_id', $keywordRaw)->get();
            // $cars = CAR::get();

            // if($carsID){
            //     $subjek = DB::table('car')->select('laporanTemuan')->where('id', $carsID->car_id)->first();
            //     $deskripsi = DB::table('car')->select('analisiPenyebabMasalah')->where('id', $carsID->car_id)->first();
            // }else{
            //     $subjek = null;
            //     $deskripsi = null;
            // }

            // if(auth()->user()->role_id == 3){
            //     $faqs = renops::whereHas('renstra', function($query) use($keywordRaw){
            //         $query->where('renstra.id', $keywordRaw);
            //     })->where('unitkerja_id',auth()->user()->unitkerja_id)->get();
            // }else{
            //     $faqs = renops::whereHas('renstra', function($query) use($keywordRaw){
            //         $query->where('renstra.id', $keywordRaw);
            //     })->get();
            // }

            // $kinerja = kinerjaUnit::get();

            // $c = count($bahanTM);

            // if($c == 0){
            //     return '<p class="text-muted"> Maaf data tidak ditemukan </p>';
            // }else{
            //     return view('menu.hasilTM.hasilTMlist')->with([
            //         'data' => $bahanTM,
            //         'data1' => $cars
            //     ]);
            // }
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function history()
    {
        $jadwalTM = tinjauanManajemen::with('jadwalAudit')->get();

        if(auth()->user()->role_id == 1){
            $hasilTM = DB::table('jadwal_audit')
                        ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                        ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                        // ->where('jadwal_audit.status', "nonaktif")
                        // ->where('tinjauan_manajemen.status', "aktif")
                        // ->orWhere('tinjauan_manajemen.status', "nonaktif")
                        ->where('hasil_rapattm.status', "nonaktif")
                        ->orderBy('hasil_rapattm.created_at', 'desc')
                        ->get();

            // $hasilTM = hasilRapatTM::with('tinjauanManajemen')->get();

        }else{
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    // ->where('jadwal_audit.status', "nonaktif")
                    // ->where('tinjauan_manajemen.status', "aktif")
                    // ->orWhere('tinjauan_manajemen.status', "nonaktif")
                    ->where('hasil_rapattm.status', "nonaktif")
                    ->orderBy('hasil_rapattm.created_at', 'desc')
                    ->get();

            if($pivot){
                $hasilTM = $pivot;
            }else{
                $hasilTM = [];
            }
        }

        return view('menu.hasilTM.history', compact('hasilTM', 'jadwalTM'));
    }

    public function create()
    {
        $jadwalTM = tinjauanManajemen::where('status', "aktif")->get();   
        $unitKerja = unitKerjas::get();
        return view('menu.hasilTM.create', compact('jadwalTM', 'unitKerja'));
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $valid = [
                'tm_id' => 'required',
                'subjek' => 'required|min:3|max:255',
                'uraian' => 'required|min:3|max:255',
                'hasilPembahasan' => 'min:3|max:255',
                'hadir' => 'numeric',
                'tidakHadir' => 'numeric',
            ];
            
            $request->validate($valid);
                           
            $hasil = hasilRapatTM::create($request->all());
                    
            return redirect()->route('hasilTM.show', $hasil->id)->with('success', 'Hasil TM berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function hasilTMSaveMulti(Request $request)
    {
        try{
            // dd($request);                   
            foreach ($request->addmore as $key => $value) {
                // if ($value['tm_id'] != null){
                    if($value['hasilPembahasan'] != null){
                    //     if($value['uraian'] != null){
                        
                            // $carsID = bahanRapatTM::where('tm_id', $value->tm_id)->first();

                            // if($carsID){
                            //     $subjek = DB::table('car')->select('laporanTemuan')->where('id', $carsID->car_id)->first();
                            //     $deskripsi = DB::table('car')->select('analisiPenyebabMasalah')->where('id', $carsID->car_id)->first();
                            // }else{
                            //     $subjek = null;
                            //     $deskripsi = null;
                            // }

                            hasilRapatTM::create([                
                                'tm_id' => $value['tm_id'],
                                'bahan_id' => $value['bahan_id'],
                                'subjek'=> $value['subjek'],
                                'uraian'=> $value['uraian'],
                                'hasilPembahasan'=> $value['hasilPembahasan'],
                                'hadir'=> $value['hadir'],
                                'tidakHadir'=> $value['tidakHadir'],
                                'status'=> "aktif",
                            ]);
                            // $value);

                    //     }else{
                    //         return back()->with('error', 'Uraian wajib di isi, Hasil TM gagal ditambah');
                    //     }

                    }else{
                        return back()->with('error', 'Hasil Rapat wajib di isi, Hasil TM gagal ditambah');
                    }

                // }else{
                //     return back()->with('error', 'Jadwal TM wajib di isi, Hasil TM gagal ditambah');
                // }
            }
            return back()->with('success', 'Hasil TM berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function show($id)
    {
        $jadwalTM = tinjauanManajemen::get();
        $hasilTM = hasilRapatTM::findOrFail($id);

        return view('menu.hasilTM.show', compact('jadwalTM','hasilTM'));
    }

    public function edit($id)
    {
        $jadwalTM = tinjauanManajemen::get();
        $hasilTM = hasilRapatTM::findOrFail($id);

        return view('menu.hasilTM.edit', compact('jadwalTM','hasilTM'));
    }

    public function update(Request $request, $id)
    {
        try{
            // dd($request);
            $valid = [
                'tm_id' => 'required',
                'subjek' => 'required|min:3|max:255',
                'uraian' => 'required|min:3|max:255',
                'hasilPembahasan' => 'min:3|max:255',
                'hadir' => 'numeric',
                'tidakHadir' => 'numeric',
            ];
            
            $request->validate($valid);
                           
            $hasilTM = hasilRapatTM::findOrFail($id);
            $hasilTM->update($request->all());
                    
            return redirect()->route('hasilTM.show', $hasilTM->id)->with('success', 'Hasil TM berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $hasilTM = hasilRapatTM::findOrFail($id);
            $hasilTM->delete();

            return back()->with('success', 'Hasil TM berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
