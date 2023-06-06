<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\jadwalAudit;
use App\Models\unitKerjas;
use App\Models\User;
use App\Models\CAR;
use App\Models\tinjauanManajemen;

class scheduling extends Controller
{
    // public function index()
    // {
    //     $unitKerja = unitKerjas::get();
    //     $users = User::get();
    //     $TM = tinjauanManajemen::get();
    //     if(auth()->user()->unitkerja_id == null){
    //         $scheduling = jadwalAudit::with('users')->get();
    //         // dd($scheduling);
    //     }else{
    //         $scheduling = jadwalAudit::join('users_jadwalaudit', 'users_jadwalaudit.user_id', '=', 'jadwal_audit.id')
    //         ->select('jadwal_audit.*', 'users_jadwalaudit.user_id')
    //         ->where('users_jadwalaudit.user_id', auth()->user()->id)->get();            
    //     }
        
    //     return view('menu.scheduling.index', compact('unitKerja', 'users', 'scheduling', 'TM'));
    // }

    public function history()
    {
        $unitKerja = unitKerjas::get();

        if(auth()->user()->role_id == 1){
            $scheduling = jadwalAudit::with('users')->where('status', "nonaktif")->orderBy('tglAudit', 'desc')->get();
            $periode = jadwalAudit::with('users')->get();
            $selectUserpivot = [];

        }else{
            $periode = jadwalAudit::with('users')->get();
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    ->where('jadwal_audit.status', "nonaktif")
                    ->orderBy('jadwal_audit.tglAudit', 'desc')
                    ->get();
                    
            $selectUserpivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    // ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    ->where('jadwal_audit.status', "nonaktif")
                    ->get();

            if($pivot){
                $scheduling = $pivot;
                $selectUserpivot;
            }else{
                $scheduling = [];
            }
        }

        return view('menu.scheduling.history', compact('scheduling', 'selectUserpivot', 'periode', 'unitKerja'));
    }

    public function create()
    {
        $unitKerja = unitKerjas::get();
        $users = User::whereIn('role_id', [2])->get();
        // dd($users);
        return view('menu.scheduling.create', compact('unitKerja', 'users'));
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $valid = [
                // 'from' => 'required|numeric',
                // 'to' => 'required|numeric',
                'tahun' => 'required|numeric',
                'tglAudit' => 'required',
                'unitkerja_id' => 'required',
                'users' => 'required',
            ];

            // $request->validate($valid);

            $year = date('Y', strtotime($request->startDate));
            $date = $request->startDate.'#'.$request->finishDate;
            $time = $request->startTime.'#'.$request->finishTime;

            $request->merge(['tahun' => $year]);
            $request->merge(['tglAudit' => $date]);
            $request->merge(['waktu' => $time]);
            
            $get_jadwal = jadwalAudit::where([
                ['unitkerja_id', $request->unitkerja_id],
                ['status', '=', 'aktif'],
            ])->groupby('tahun')->count();
            $jadwal = ++$get_jadwal;
            // dd($jadwal);
            $request->merge(['periode' => $jadwal]);

            // if(!empty($request->from && $request->to)){
            //     $periode = $request->from."-".$request->to;
            //     $request->merge(['periode' => $periode]);
            // }
            // dd($request->users);
            $posts = new jadwalAudit($request->all());
            
            $userUK = DB::table('users')->where([
                ['unitkerja_id', $request->unitkerja_id],
                ['role_id', '=', '3'],
            ])->get();

            if($userUK->count() > 0){
                foreach($userUK as $userUKs){
                    // dd($userUKs->id);
                    $tes[] = $userUKs->id;
                }
            }else{
                $tes = [];
            }
            // dd($request->users);
            // dd($tes);
            $result = array_merge($request->users, $tes);
            // dd($result);

            if($request->status == "aktif"){
                DB::table('jadwal_audit')
                ->where('unitkerja_id', $request->unitkerja_id)
                ->where('status', 'aktif')
                ->update([
                    'status' => 'nonaktif'
                ]);
            }

            if( $posts->save()){
                $posts->users()->attach($result);
                // $posts->users()->attach($request->users);

            }

            return redirect()->route('scheduling.show', $posts->id)->with('success', 'Jadwal Audit berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function schedulingSaveMulti(Request $request)
    {
        try{
            // dd($request);
            foreach ($request->addmore as $key => $value) {
                // if ($value['unitkerja_id'] != null || $value['users'] != null){
                            $tahun = date('Y', strtotime($request->startDate));
                            $date = $request->startDate.'#'.$request->finishDate;
                            $time = $request->startTime.'#'.$request->finishTime;

                            // dd($date);

                            $get_jadwal = jadwalAudit::where([
                                ['unitkerja_id', $value['unitkerja_id']],
                                ['tahun', $tahun],
                                ['status', '=', 'aktif'],
                            ])->groupBy('tahun')->count();
                            $jadwal = ++$get_jadwal;
                            
                            DB::table('jadwal_audit')
                            ->where('unitkerja_id', $value['unitkerja_id'])
                            ->where('status', 'aktif')
                            ->update([
                                'status' => 'nonaktif'
                            ]);
                        
                            // $userUK = DB::table('users')->where([
                            //     ['unitkerja_id', $value['unitkerja_id']],
                            //     ['role_id', '=', '3'],
                            // ])->get();
                            $userUK = DB::table('users')
                                        ->where('unitkerja_id', $value['unitkerja_id'])
                                        ->where('role_id', '3')
                                        ->get();
                                        // dd($userUK);
                            if($userUK->count() > 0){
                                foreach($userUK as $userUKs){
                                    // dd($userUKs->id);
                                    $tes[] = $userUKs->id;
                                }
                            }else{
                                $tes = [];
                            }
                            // if($userUK->count() > 0){
                            //     foreach($userUK as $userUKs){
                            //         $tes[] = $userUKs->id;
                            //     }
                            // }else{
                            //     $tes = [];
                            // }

                            // dd($tes);

                            $result = array_merge($value['users'], array($tes));

                            $post = jadwalAudit::create([
                                'periode'=> $jadwal,
                                'tahun' => $tahun,
                                'tglAudit'=> $date,
                                'waktu'=> $time,
                                'unitkerja_id'=> $value['unitkerja_id'],
                                'status'=> "aktif",
                            ]);

                            $post->users()->attach($result);
                            
                            // if ($post) {
                            //     $post->users()->attach($result);
                            // }

                // }else{
                //     return back()->with('error', 'Periode, Unit Kerja, dan User wajib di isi, Jadwal Audit gagal ditambah');
                // }
            }
            // print_r($result);
            // exit();

            // foreach ($request->addmore as $key => $value) {
            //     // if ($value['from'] != null || $value['to'] != null || $value['unitkerja_id'] != null || $value['users'] != null){
            //     if ($value['unitkerja_id'] != null || $value['users'] != null){
            //         if($value['tahun'] != null || $value['tglAudit'] != null){
            //             if($value['unitkerja_id'] != null || $value['users'] != null){
            //                 $get_jadwal = jadwalAudit::where([
            //                     ['unitkerja_id', $value['unitkerja_id']],
            //                     ['tahun', $value['tahun']],
            //                     ['status', '=', 'aktif'],
            //                 ])->groupBy('tahun')->count();
            //                 // dd($get_jadwal);
            //                 $jadwal = ++$get_jadwal;
            //                 // dd($jadwal);
                            
            //                 // foreach($get_jadwal as $key=>$tes){
            //                 //     $jadwal['periode'] = ++$key;
            //                 // }
            //                 // dd($jadwal);
            //                 // $value->merge(['periode' => $jadwal]);

            //                 // if(!empty($value['from'] && $value['to'])){
            //                 //     $periode = $value['from']."-".$value['to'];
            //                 //     // dd($periode);
            //                 //     $value['periode'] = $periode;
            //                 //     // $request->merge(['periode' => $periode]);
            //                 // }

            //                 if($value['status'] == "aktif"){
            //                     DB::table('jadwal_audit')
            //                     ->where('unitkerja_id', $value['unitkerja_id'])
            //                     ->where('status', 'aktif')
            //                     ->update([
            //                         'status' => 'nonaktif'
            //                     ]);
            //                 }

            //                 $post = jadwalAudit::create([
            //                     'periode'=> $jadwal,
            //                     'tahun' => $value['tahun'],
            //                     'tglAudit'=> $value['tglAudit'],
            //                     'waktu'=> $value['waktu'],
            //                     'unitkerja_id'=> $value['unitkerja_id'],
            //                     // 'users'=> $value['users'],
            //                     'status'=> $value['status'],
            //                 ]);
            //                 // $post = jadwalAudit::create($value);
                        
            //                 $userUK = DB::table('users')->where([
            //                     ['unitkerja_id', $value['unitkerja_id']],
            //                     ['role_id', '=', '3'],
            //                 ])->get();
            //                 if($userUK->count() > 0){
            //                     foreach($userUK as $userUKs){
            //                         // dd($userUKs->id);
            //                         $tes[] = $userUKs->id;
            //                     }
            //                 }else{
            //                     $tes = [];
            //                 }

            //                 $result = array_merge($value['users'], $tes);
                            
            //                 if (!empty($value['users'])) {
            //                     // $post->users()->sync($value['users']);
            //                     $post->users()->attach($result);
            //                     // $post->users()->attach($value['users']);
            //                 }

            //             }else{
            //                 return back()->with('error', 'Unit Kerja & Users Audit wajib di isi, Jadwal Audit gagal ditambah');
            //             }

            //         }else{
            //             return back()->with('error', 'Tahun / Tanggal Audit wajib di isi, Jadwal Audit gagal ditambah');
            //         }

            //     }else{
            //         return back()->with('error', 'Periode, Unit Kerja, dan User wajib di isi, Jadwal Audit gagal ditambah');
            //     }
            // }

            return back()->with('success', 'Jadwal Audit berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        // dd($id);
        // $scheduling = jadwalAudit::leftjoin('users_jadwalaudit', 'users_jadwalaudit.user_id', '=', 'jadwal_audit.id')->findOrFail($id);
        $scheduling = jadwalAudit::with('users')->findOrFail($id);
        // foreach($scheduling->users as $key=>$ans){
        //     dd($ans->name);
        // }
        // dd($scheduling);
        // dd($scheduling->users());
        $users = User::get();
        $unitKerja = unitKerjas::get();
        return view('menu.scheduling.show', compact('scheduling', 'users', 'unitKerja'));
    }

    public function edit($id)
    {
        try{
            $scheduling = jadwalAudit::with('users')->findOrFail($id);
            // $period = explode("-", $scheduling->periode);
            // $from = $period[0];
            // $to = $period[1];
            // dd($to);
            // dd($scheduling->users());
            $users = User::whereIn('role_id', ['2'])->get();
            // dd($users);
            $unitKerja = unitKerjas::get();

            // $renop = renops::with('renstra', 'unitKerja')->findOrFail($id);
            $array = $scheduling->users->toArray();
            // dd($array);
            if(!empty($array)){
                foreach($array as $key=>$pv){
                    $arr[$key] = $pv['pivot']['user_id'];
                }
                // dd($arr);
                $send = $arr;
            }else{
                $send = [];
            }

            // foreach($users as $user){
            //     // dd($user->id);
            //     dd(in_array($user->id, $send));
            // }
            
            // dd($send);
            return view('menu.scheduling.edit', compact('scheduling', 'users', 'unitKerja', 'send'));

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try{
            // dd($request);
            $valid = [
                // 'from' => 'required|numeric',
                // 'to' => 'required|numeric',
                'tahun' => 'required|numeric',
                'tglAudit' => 'required',
                'unitkerja_id' => 'required',
                'users' => 'required',
            ];

            // $request->validate($valid);
            
            // if(!empty($request->from && $request->to)){
            //     $periode = $request->from."-".$request->to;
            //     $request->merge(['periode' => $periode]);
            // }
            
            // $request->validate($valid);

            $date = $request->startDate.'#'.$request->finishDate;
            $time = $request->startTime.'#'.$request->finishTime;

            $request->merge(['tglAudit' => $date]);
            $request->merge(['waktu' => $time]);
            
            $scheduling = jadwalAudit::findOrFail($id);

            if($request->status == "aktif"){
                // AMI
                $scheduling->update($request->all());
                DB::table('jadwal_audit')
                            ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                            ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
                            ->where('laporan_audit.audit_id', $id)
                            ->update(array('car.status' => "open"));
                // TM
                DB::table('tinjauan_manajemen')->where('audit_id', $id)->update(array('status' => "aktif"));
                DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                            ->where('tinjauan_manajemen.audit_id', $id)
                            ->update(array('bahan_rapattm.status' => "aktif"));
                DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                            ->where('tinjauan_manajemen.audit_id', $id)
                            ->update(array('hasil_rapattm.status' => "aktif"));
            }else{
                // AMI
                $scheduling->update($request->all());
                DB::table('jadwal_audit')
                            ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                            ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
                            ->where('laporan_audit.audit_id', $id)
                            ->update(array('car.status' => "closed"));
                // TM
                DB::table('tinjauan_manajemen')->where('audit_id', $id)->update(array('status' => "nonaktif"));
                DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                            ->where('tinjauan_manajemen.audit_id', $id)
                            ->update(array('bahan_rapattm.status' => "nonaktif"));
                DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                            ->join('hasil_rapattm', 'hasil_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                            ->where('tinjauan_manajemen.audit_id', $id)
                            ->update(array('hasil_rapattm.status' => "nonaktif"));
            }
            
            
            $userUK = DB::table('users')->where([
                ['unitkerja_id', $request->unitkerja_id],
                ['role_id', '=', '3'],
            ])->get();

            if($userUK->count() > 0){
                foreach($userUK as $userUKs){
                    // dd($userUKs->id);
                    $tes[] = $userUKs->id;
                }
            }else{
                $tes = [];
            }
            
            $result = array_merge($request->users, $tes);

            if (!empty($request->users)) {
                // $post->pimpinan()->sync($request->pimpinan);
                $scheduling->users()->sync($result);
                // $scheduling->users()->sync($request->users);
            }

            return redirect()->route('scheduling.show', $scheduling->id)->with('success', 'Jadwal Audit berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $scheduling = jadwalAudit::findOrFail($id);
            $scheduling->users()->detach();
            $scheduling->delete();

            return back()->with('success', 'Jadwal Audit berhasil di Hapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
    
    public function disabled(Request $request)
    {
        try{
            jadwalAudit::where('status', "aktif")
                ->update(array('status' => $request->status));
            CAR::whereIn('status', ['open', 'process'])
                ->update(array('status' => "closed"));

            return back()->with('success', 'Jadwal Audit berhasil di Disabled');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
