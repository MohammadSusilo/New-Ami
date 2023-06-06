<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\jadwalAudit;
use App\Models\laporanAudit;
use App\Models\standars;


use App\Models\unitKerjas;

class auditReports extends Controller
{
    // public function index()
    // {
    //     if (auth()->user()->role_id == 1){
    //         $auditReports = laporanAudit::all();
    //     }else{
    //         $auditReports = laporanAudit::all();
    //     }

    //     $audits = jadwalAudit::get();
    //     // dd($auditReports->jadwalAudit->periode);
    //     return view('menu.auditReports.index', compact('auditReports', 'audits'));
    // }

    public function history()
    {
        $unitKerja = unitKerjas::get();
        $audits = jadwalAudit::get();

        if (auth()->user()->role_id == 1){
            // $auditReports = laporanAudit::
            //                 with(['jadwalAudit' => function ($query) {
            //                     $query->where('status','aktif');
            //                 }])->orderBy('created_at', 'desc')->get();
            $auditReports = DB::table('jadwal_audit')
                            ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                            ->where('jadwal_audit.status', "nonaktif")
                            ->orderBy('laporan_audit.created_at', 'desc')
                            ->get();
            $jadwalaudits = jadwalAudit::where('status','aktif')->get();
            
        }else{
            $pivot = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    ->where('jadwal_audit.status', "nonaktif")
                    ->orderBy('laporan_audit.created_at', 'desc')
                    ->get();

            $pivot1 = DB::table('users_jadwalaudit')
                    ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                    ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                    // ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                    ->where('users_jadwalaudit.user_id', auth()->user()->id)
                    ->where('jadwal_audit.status', "aktif")
                    ->get()
                    ->groupBy('jadwal_id');
            if($pivot){
                $auditReports = $pivot;
                $jadwalaudits = $pivot1;
            }else{
                $auditReports = [];
                $jadwalaudits = [];
            }
        }

        return view('menu.auditReports.history', compact('auditReports', 'jadwalaudits', 'audits', 'unitKerja'));
    }

    public function exportLaporanAudit()
    {
        $unitKerja = laporanAudit::get();
        dd($unitKerja);
    }

    public function create()
    {
        $standars = standars::get();
        $unitKerja = unitKerjas::get();
        if(auth()->user()->role_id == 1){
                $auditReports = DB::table('jadwal_audit')
                            ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                            ->where('jadwal_audit.status', "aktif")
                            ->orderBy('laporan_audit.created_at', 'desc')
                            ->get();
                $jadwalaudits = jadwalAudit::where('status','aktif')->get();
        }else{
                $pivot = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->where('users_jadwalaudit.user_id', auth()->user()->id)
                        ->where('jadwal_audit.status', "aktif")
                        ->orderBy('laporan_audit.created_at', 'desc')
                        ->get();
                        
                $pivot1 = DB::table('users_jadwalaudit')
                        ->join('users', 'users.id', '=', 'users_jadwalaudit.user_id')
                        ->join('jadwal_audit', 'jadwal_audit.id', '=', 'users_jadwalaudit.jadwal_id')
                        // ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                        ->where('users_jadwalaudit.user_id', auth()->user()->id)
                        ->where('jadwal_audit.status', "aktif")
                        ->get()
                        ->groupBy('jadwal_id');
                if($pivot){
                    $auditReports = $pivot;
                    $jadwalaudits = $pivot1;
                }else{
                    $auditReports = [];
                    $jadwalaudits = [];
                }
                
                // $cekjadwal = jadwalAudit::with('users')->where('status', '=','aktif')->where(->get();
                // if($cekjadwal->count() > 0){
                //     foreach($cekjadwal as $cekkk){
                //         foreach($cekkk->users as $tes1){
                //             if($tes1->id == auth()->user()->id){
                //                 $audits[] = $cekkk;
                //             }
                //             // }else{
                //             //     $audits = array();
                //             // }
                //         }
                //     }
                // }else{
                //     $audits = [];
                // }          
        }

        return view('menu.auditReports.create', compact('auditReports', 'jadwalaudits', 'unitKerja', 'standars'));
    }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $valid = [
                'audit_id' => 'required',
                'standar_id' => 'required',
                'kategoriTemuan' => 'required',
                'uraianTemuan' => 'required',
            ];
            
            $request->validate($valid);
                    
            $laporan = laporanAudit::create($request->all());

            return redirect()->route('auditReports.show', $laporan->id)->with('success', 'Laporan Audit berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function auditReportsSaveMulti(Request $request)
    {

        try{
            // $errorArr = array();
            // $errorArrE = array();
            // for ($i = 0; $i <= (count($request->addmore) - 1); $i++) {
            //     $validate = Validator::make($request->addmore[$i], [
            //         'standar' => 'required'
            //     ]);
                
            //     if ($validate->fails()) {
            //         // return redirect('AMI')
            //         //     ->withErrors($validate)
            //         //     ->withInput();
            //         $tes = array_push($errorArrE, array($i => $validate));
            //     }else{
            //         $tes1 = array_push($errorArr, array($i => $request->addmore[$i]));
            //     }

            // }
            // // dd(count($errorArrE));
            // // dd($request->addmore);
            // // echo ($validate);
            // // echo ($tes);
            // // echo "=x & y=";
            // // echo ($tes1);
            // // echo "m=";
            // // echo (count($request->addmore));
            
            // if(count($errorArrE) > 0) {
            //     foreach ($errorArrE as $errorArrEs){
            //         dd([$errorArrEs]);
            //         // return redirect('AMI')
            //         //     ->withErrors($validate)
            //         //     ->withInput();
            //     }

            //     echo("bersial");
            // } else {
            //     echo("balikin");
            // }
            
            // exit(); 
            
            // dd($request);

            // $this->validate($request->addmore,[
            //     '.*.[audit_id]'   => 'required',
            //     '.*.[standar_id]'  => 'required',
            //     '.*.[kategoriTemuan]' => 'required',
            //     '.*.[uraianTemuan]' => 'required',
            // ]);
            // $validator = Validator::make($request->all(), [
            //     'addmore.*.audit_id' => 'required',
            //     'addmore.*.standar_id' => 'required',
            //     'addmore.*.kategoriTemuan' => 'required',
            //     'addmore.*.uraianTemuan' => 'required',
            // ]);

            // if ($validator->fails()) {
            //     // $input = Input::all();//Get all the old input.
            //     // $input['autoOpenModal'] = 'true';//Add the auto open indicator flag as an input.
            //     // return Redirect::back()
            //     //     ->withErrors($this->messageBag)
            //     //     ->withInput($input);//Passing the old input and the flag.
            //     // return redirect('AMI')
            //     $tes = $request->all();
            //     return redirect()->back()
            //                 ->withErrors($validator)
            //                 ->withInput($tes);
            // }

            foreach ($request->addmore as $key => $value) {
                
                if($value['audit_id'] != null && $value['standar_id'] != null && $value['kategoriTemuan'] != null && $value['uraianTemuan'] != null){
                    if ($value['audit_id'] != null || !empty($value['audit_id'])){
                        if($value['standar_id'] != null || !empty($value['standar_id'])){
                            if($value['kategoriTemuan'] != null || !empty($value['kategoriTemuan'])){
                                if($value['uraianTemuan'] != null || !empty($value['uraianTemuan'])){
                                    // if($value['saranPerbaikan'] != null){
    
                                        laporanAudit::create($value);
    
                                     // }else{
                                     //     return back()->with('error', 'Saran Perbaikan wajib di isi, Jadwal Audit gagal ditambah');
                                     // }
    
                                }else{
                                    return back()->with('error', 'Uraian Temuan wajib di isi, Laporan Audit gagal ditambah');
                                }

                            }else{
                                return back()->with('error', 'Kategori Temuan wajib di isi, Laporan Audit gagal ditambah');
                            }
    
                        }else{
                            return back()->with('error', 'Standar wajib di isi, Laporan Audit gagal ditambah');
                        }
    
                    }else{
                        return back()->with('error', 'Jadwal Audit wajib di isi, Laporan Audit gagal ditambah');
                    }
                
                }else{
                    return back()->with('error', 'Laporan Audit wajib di isi, Laporan Audit gagal ditambah');
                }
            }
            
            // return redirect()->to('AMI#laporanAMI')->with('success', 'Laporan Audit berhasil ditambah');
            return back()->with('success', 'Laporan Audit berhasil ditambah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        $unitKerja = unitKerjas::get();
        $auditReports = laporanAudit::findOrFail($id);
        // dd($auditReports->users());
        $audits = jadwalAudit::get();
        // $unitKerja = unitKerjas::get();
        return view('menu.auditReports.show', compact('auditReports', 'audits', 'unitKerja'));
    }

    public function edit($id)
    {
        $unitKerja = unitKerjas::get();
        // $auditReports = DB::table('jadwal_audit')
        //                 ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
        //                 ->where('laporan_audit.id', $id)
        //                 ->where('jadwal_audit.status', "aktif")
        //                 ->orderBy('laporan_audit.created_at', 'desc')
        //                 ->first();
        $auditReports = laporanAudit::findOrFail($id);
        // dd($auditReports->audit_id);
        $audits = jadwalAudit::where('status','aktif')->get();
        // $unitKerja = unitKerjas::get();
        $standars = standars::get();
        return view('menu.auditReports.edit', compact('auditReports', 'audits', 'unitKerja', 'standars'));
    }

    public function update(Request $request, $id)
    {
        try{
            // dd($request);
            $valid = [
                'audit_id' => 'required',
                'standar_id' => 'required',
                'kategoriTemuan' => 'required',
                'uraianTemuan' => 'required',
            ];
            
            $request->validate($valid);
                    
            $auditReports = laporanAudit::findOrFail($id);
            $auditReports->update($request->all());     

            return redirect()->route('auditReports.show', $auditReports->id)->with('success', 'Laporan Audit berhasil diubah');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function destroy($id)
    {
        try{

            $auditReports = laporanAudit::findOrFail($id);
            $auditReports->delete();

            return back()->with('success', 'Laporan Audit berhasil dihapus');

        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }
}
