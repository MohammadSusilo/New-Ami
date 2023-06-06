<?php

namespace App\Http\Controllers\menu\importExports;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;
use Excel;
use PDF;
use View;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\TemplateProcessor;

//Master Data
use App\Models\renstras;
use App\Models\renops;
use App\Models\kinerjaUnit;
use App\Models\buktiKinerja;
use App\Models\dokumenInduk;

//AMI
use App\Models\CAR;
use App\Models\jadwalAudit;
use App\Models\laporanAudit;

//Tinjauan Manajemen
use App\Models\tinjauanManajemen;
use App\Models\hasilRapatTM;
use App\Models\bahanRapatTM;
use App\Models\tindakLanjutTM;

//Second Model
use App\Models\User;
use App\Models\unitKerjas;
use App\Models\pengelolaUnitKerja;
use App\Models\pimpinans;


class importExport extends Controller
{
    //IMPORT
        //Master Data
            //Renstra
            public function importRenstra()
            {

            }

            //Renop
            public function importRenop()
            {
            
            }

            //Kinerja Unit
            public function importKinerjaUnit()
            {

            }

            //Bukti Kinerja
            public function importBuktiKinerja()
            {

            }

        //AMI
            //Jadwal Audit
            public function importJadwalAudit()
            {

            }

            //Laporan Audit
            public function importLaporanAudit()
            {

            }

            //CAR
            public function importCAR()
            {

            }

        //Tinjauan Manajemen
            //JadwalTM
            public function importJadwalTM()
            {

            }

            //BahanTM
            public function importBahanTM()
            {

            }

            //HasilTM
            public function importHasilTM()
            {

            }

            //TindakLanjutTM
            public function importTindakLanjutTM()
            {

            }

    //EXPORT
        //Master Data
            //Renstra
            public function exportRenstra()
            {

            }

            //Renop
            public function exportRenop()
            {
            
            }

            //Kinerja Unit
            public function exportKinerjaUnit()
            {

            }

            //Bukti Kinerja
            public function exportBuktiKinerja()
            {

            }

        //AMI
            //Jadwal Audit
            public function exportJadwalAudit()
            {
                try{
                    $jadwalAudit = jadwalAudit::with('users')->where('status', 'aktif')->orderBy('tglAudit', 'desc')->get();
                    $jadwalAudit_ = jadwalAudit::with('users')->where('status', 'aktif')->orderBy('tglAudit', 'desc')->first();
                    if($jadwalAudit_ != null){
                        if(!empty($jadwalAudit)){
                            $unitKerja = unitKerjas::get();
                            $DokumenInduk = DB::table('dokumeninduk')
                                    ->where('tahun_aktif', date('Y'))
                                    ->where('status', 'aktif')
                                    ->where('sifatDokumen', 'private')
                                    ->first();
                            $pimpinan = pimpinans::where('status', "D0")->first();
                            $signature = DB::table('users')
                                    ->join('profile', 'profile.user_id', '=', 'users.id')
                                    ->select('users.*', 'profile.signature')
                                    ->where('users.role_id', 4)
                                    ->where('users.unitkerja_id', null)
                                    ->where('users.is_pimpinan', "D0")
                                    ->where('users.status', 'aktif')
                                    ->first();
                            // $audits = jadwalAudit::with('users')->get();
                            // $userAudit = User::get();
                            // $userAudits = User::get();
                                        
                            $pdf = PDF::loadView('menu.scheduling.exportPDF', compact('jadwalAudit', 'jadwalAudit_', 'unitKerja', 'pimpinan', 'DokumenInduk', 'signature'))
                                ->setPaper('a4', 'portrait');
                            $pdf->getDomPDF()->setHttpContext(
                                stream_context_create([
                                    'ssl' => [
                                        'allow_self_signed'=> TRUE,
                                        'verify_peer' => FALSE,
                                        'verify_peer_name' => FALSE,
                                    ]
                                ])
                            );
                            return $pdf->stream();
                            
                        }else{
                            return back()->with('error', 'Laporan Audit Kosong, Silahkan inputkan terlebih dahulu');
                        }

                    }else{
                        return back()->with('error', 'Laporan Audit Kosong, Silahkan inputkan terlebih dahulu');
                    }
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

            public function exportSuratPemberitahuanAudit($id)
            {
                try{
                    // dd($id);
                    $jadwalAudit_ = jadwalAudit::with('users')->where('id', $id)->first();
                    // dd($jadwalAudit_);
                    if($jadwalAudit_ != null){
                        $unitKerja = unitKerjas::get();
                                        
                        $pdf = PDF::loadView('menu.scheduling.exportsuratPDF', compact('jadwalAudit_', 'unitKerja'))
                            ->setPaper('a4', 'portrait');
                        $pdf->getDomPDF()->setHttpContext(
                            stream_context_create([
                                'ssl' => [
                                    'allow_self_signed'=> TRUE,
                                    'verify_peer' => FALSE,
                                    'verify_peer_name' => FALSE,
                                ]
                            ])
                        );
                        return $pdf->stream();

                    }else{
                        return back()->with('error', 'Laporan Audit Kosong, Silahkan inputkan terlebih dahulu');
                    }
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

            //Laporan Audit
            public function exportLaporanAudit(Request $request)
            {
                try{
                    $auditReports = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('standar', 'laporan_audit.standar_id', 'standar.id')
                                ->select('laporan_audit.*', 'standar.*')
                                ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                                ->where('jadwal_audit.status', 'aktif')
                                ->orderBy('laporan_audit.created_at','desc')
                                ->get();
                    $auditReports_ = jadwalAudit::with('users')->where('unitkerja_id', $request->unitkerja_id)->where('jadwal_audit.status', 'aktif')->first();
                    $DokumenInduk = DB::table('dokumeninduk')
                                ->where('tahun_aktif', date('Y'))
                                ->where('status', 'aktif')
                                ->where('sifatDokumen', 'private')
                                ->first();
                    // $auditReports = laporanAudit::with('jadwalAudit')->where('audit_id', $request->audit_id)->get();
                    // $auditReports_ = laporanAudit::with('jadwalAudit')->where('audit_id', $request->audit_id)->first();
                    if($auditReports_ != null){
                        if(!empty($auditReports)){
                            // $audits = jadwalAudit::with('users')->get();
                            // $userAudit = User::get();
                            // $userAudits = User::get();
                                        
                            $pdf = PDF::loadView('menu.auditReports.exportPDF', compact('auditReports', 'auditReports_', 'DokumenInduk'))
                            // $pdf = PDF::loadView('menu.auditReports.exportPDF')
                                // ->setOptions(['defaultFont' => 'sans-serif'])
                                ->setPaper('a4', 'portrait');
                            $pdf->getDomPDF()->setHttpContext(
                                stream_context_create([
                                    'ssl' => [
                                        'allow_self_signed'=> TRUE,
                                        'verify_peer' => FALSE,
                                        'verify_peer_name' => FALSE,
                                    ]
                                ])
                            );
                            return $pdf->stream();
                            
                        }else{
                            return back()->with('error', 'Laporan Audit Kosong, Silahkan inputkan terlebih dahulu');
                        }

                    }else{
                        return back()->with('error', 'Laporan Audit Kosong, Silahkan inputkan terlebih dahulu');
                    }
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

            public function exportDaftarAudit(Request $request)
            {
                try{
                    $auditReports = DB::table('jadwal_audit')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('standar', 'laporan_audit.standar_id', 'standar.id')
                                ->select('laporan_audit.*', 'standar.*')
                                ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                                ->where('jadwal_audit.status', 'aktif')
                                ->orderBy('laporan_audit.created_at','desc')
                                ->get();
                    // $auditReports_ = DB::table('users_jadwalaudit')
                    //             ->join('jadwal_audit', 'jadwal_audit.id', 'users_jadwalaudit.jadwal_id')
                    //             ->join('users', 'users.id', 'users_jadwalaudit.user_id')
                    //             ->select('jadwal_audit.*', 'users_jadwalaudit.user_id')
                    //             ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                    //             ->where('jadwal_audit.status', 'aktif')
                    //             ->first();
                    
                    $DokumenInduk = DB::table('dokumeninduk')
                                ->where('tahun_aktif', date('Y'))
                                ->where('status', 'aktif')
                                ->where('sifatDokumen', 'private')
                                ->first();
                    // $auditReports = laporanAudit::with('jadwalAudit')->where('audit_id', $request->audit_id)->get();
                    $auditReports_ = jadwalAudit::with('users')->where('unitkerja_id', $request->unitkerja_id)->where('jadwal_audit.status', 'aktif')->first();
                    // dd($auditReports_->jadwalAudit);
                    if($auditReports_ != null){
                        if(!empty($auditReports)){
                            $unitKerja = unitKerjas::get();
                            $pengelola = pengelolaUnitKerja::get();
                            // $audits = jadwalAudit::with('users')->get();
                            // $userAudit = User::get();
                            // $userAudits = User::get();
                                        
                            $pdf = PDF::loadView('menu.auditReports.exportdaftarPDF', compact('auditReports', 'auditReports_', 'unitKerja', 'pengelola', 'DokumenInduk'))
                                ->setPaper('a4', 'portrait');
                            $pdf->getDomPDF()->setHttpContext(
                                stream_context_create([
                                    'ssl' => [
                                        'allow_self_signed'=> TRUE,
                                        'verify_peer' => FALSE,
                                        'verify_peer_name' => FALSE,
                                    ]
                                ])
                            );
                            return $pdf->stream();
                            
                        }else{
                            return back()->with('error', 'Laporan Audit Kosong, Silahkan inputkan terlebih dahulu');
                        }

                    }else{
                        return back()->with('error', 'Laporan Audit Kosong, Silahkan inputkan terlebih dahulu');
                    }
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

            //CAR
            public function exportCAR(Request $request)
            {
                // dd($request);
                try{
                    $CAR = DB::table('jadwal_audit')
                                // ->join('users', 'users.id', 'users_jadwalaudit.user_id')
                                // ->join('jadwal_audit', 'jadwal_audit.id', 'users_jadwalaudit.jadwal_id')
                                ->join('laporan_audit', 'laporan_audit.audit_id', 'jadwal_audit.id')
                                ->join('standar', 'laporan_audit.standar_id', 'standar.id')
                                ->join('car', 'car.laporanaudit_id', 'laporan_audit.id')
                                ->select('car.*', 'standar.kodeStandar', 'standar.namaStandar', 'laporan_audit.uraianTemuan', 'laporan_audit.kategoriTemuan', 'jadwal_audit.id as jadwal_id')
                                ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                                ->where('jadwal_audit.status', 'aktif')
                                ->where('car.status', 'closed')
                                ->orderBy('car.created_at','desc')
                                ->get();
                                // dd($CAR);
                    $CAR_ = jadwalAudit::with('users')->where('unitkerja_id', $request->unitkerja_id)->where('jadwal_audit.status', 'aktif')->first();
                    $DokumenInduk = DB::table('dokumeninduk')
                                ->where('tahun_aktif', date('Y'))
                                ->where('status', 'aktif')
                                ->where('sifatDokumen', 'private')
                                ->first();
                    $checkPPMP = DB::table('users')
                                ->join('profile', 'profile.user_id', '=', 'users.id')
                                ->select('users.*', 'profile.signature')
                                ->where('users.role_id', 4)
                                ->where('users.unitkerja_id', 86)
                                ->where('users.status', 'aktif')
                                ->first();

                    if($checkPPMP != null){
                        $PPMP = $checkPPMP;
                    }else{
                        $PPMP = [
                            'name' => " ",
                        ];
                    }

                    if($CAR_ != null){
                        if(!empty($CAR)){
                            $audits = jadwalAudit::with('users')->get();
                            $userAudit = User::get();
                            $userAudits = User::get();
                            $unitKerja = unitKerjas::get();

                            $pdf = PDF::loadView('menu.CarReports.exportPDF', compact('CAR', 'CAR_', 'audits', 'userAudit', 'userAudits', 'unitKerja', 'DokumenInduk', 'PPMP'))
                                ->setPaper('a4', 'portrait');
                            $pdf->getDomPDF()->setHttpContext(
                                stream_context_create([
                                    'ssl' => [
                                        'allow_self_signed'=> TRUE,
                                        'verify_peer' => FALSE,
                                        'verify_peer_name' => FALSE,
                                    ]
                                ])
                            );
                            return $pdf->stream();

                        }else{
                            return back()->with('error', 'Laporan CAR Kosong, Silahkan inputkan terlebih dahulu');
                        }

                    }else{
                        return back()->with('error', 'Laporan CAR Kosong, Silahkan inputkan terlebih dahulu');
                    }
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

            //Convert Word
            const CELL_STYLE = ['valign' => 'center'];
            const ROW_STYLE = ['cantSplit' => true];
            const ROW_HEIGHT = 300;
            const CELL_WIDTH = 2000;

            public function exportCARNotInAccordance(Request $request)
            {
                try{
                    if(auth()->user()->role_id == 1){
                        $tes = DB::table('car')
                            ->where('status','closed')
                            ->where('hasilPemeriksaan', 'nonsesuai')
                            ->where('laporanaudit_id', $request->laporanaudit_id)
                            ->get();
                    }else{
                        $tes = DB::table('car')
                            ->where('status','closed')
                            ->where('hasilPemeriksaan', 'nonsesuai')
                            ->where('laporanaudit_id', $request->laporanaudit_id)
                            ->get();
                    }

                    $PPMP = DB::table('users')
                            ->join('profile', 'profile.user_id', '=', 'users.id')
                            ->select('users.*', 'profile.signature')
                            ->where('users.role_id', 4)
                            ->where('users.unitkerja_id', 4)
                            ->where('users.status', 'aktif')
                            ->first();
                    $DokumenInduk = DB::table('dokumeninduk')
                            ->where('tahun_aktif', date('Y'))
                            ->where('status', 'aktif')
                            ->first();
                    
                    $table = new Table([
                        'alignment' => 'center',
                        'borderSize' => 10,
                        'width' => 8000,
                        'unit' => TblWidth::TWIP,
                        'align' => 'center',
                        'layout' => 'autofit']);
                    $table->addRow(self::ROW_HEIGHT, self::ROW_STYLE);
                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('No');
                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Laporan Temuan');

                    foreach ($tes as $key=>$detail) {
                        $table->addRow(self::ROW_HEIGHT, self::ROW_STYLE);
                        $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText(++$key);
                        $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText($detail->laporanTemuan);
                    }
            
                    
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('template.docx'));

                    if($DokumenInduk == null){
                        $templateProcessor->setValue('no', '');
                        $templateProcessor->setValue('revisi', '');
                        $templateProcessor->setValue('tgl', '');
                        $templateProcessor->setComplexBlock('table', $table);
                        $templateProcessor->setValue('date', \Carbon\Carbon::parse()->isoFormat('D MMMM Y'));
                        $templateProcessor->setImageValue('signature', $PPMP->signature);
                        $templateProcessor->setValue('PPMP', $PPMP->name);
                    }elseif($table == null){
                        $templateProcessor->setValue('no', $DokumenInduk->nomor);
                        $templateProcessor->setValue('revisi', $DokumenInduk->revisi);
                        $templateProcessor->setValue('tgl', $DokumenInduk->update_at);
                        $templateProcessor->setValue('table', '');
                        $templateProcessor->setValue('date', \Carbon\Carbon::parse()->isoFormat('D MMMM Y'));
                        $templateProcessor->setImageValue('signature', $PPMP->signature);
                        $templateProcessor->setValue('PPMP', $PPMP->name);
                    }elseif($PPMP == null){
                        $templateProcessor->setValue('no', $DokumenInduk->nomor);
                        $templateProcessor->setValue('revisi', $DokumenInduk->revisi);
                        $templateProcessor->setValue('tgl', $DokumenInduk->update_at);
                        $templateProcessor->setComplexBlock('table', $table);
                        $templateProcessor->setValue('date', \Carbon\Carbon::parse()->isoFormat('D MMMM Y'));
                        $templateProcessor->setValue('signature', '');
                        $templateProcessor->setValue('PPMP', '');
                    }else{
                        $templateProcessor->setValue('no', $DokumenInduk->nomor);
                        $templateProcessor->setValue('revisi', $DokumenInduk->revisi);
                        $templateProcessor->setValue('tgl', $DokumenInduk->update_at);
                        $templateProcessor->setComplexBlock('table', $table);
                        $templateProcessor->setValue('date', \Carbon\Carbon::parse()->isoFormat('D MMMM Y'));
                        $templateProcessor->setImageValue('signature', $PPMP->signature);
                        $templateProcessor->setValue('PPMP', $PPMP->name);
                    }


                    $file_name = 'Bahan TM'. '-' .now()->toDateString() . '.docx';
                    $templateProcessor->saveAs(public_path('storage/files/Pusat/PPMP/TM/downloadBahanTM/'.$file_name));
            
                    return response()->download(public_path('storage/files/Pusat/PPMP/TM/downloadBahanTM/'.$file_name));
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

        //Tinjauan Manajemen
            //JadwalTM
            public function exportJadwalTM()
            {
                try{
                    $jadwalAudit = tinjauanManajemen::with('jadwalAudit')->where('status', 'aktif')->orderBy('tglTM', 'asc')->get();
                    $jadwalAudit_ = tinjauanManajemen::with('jadwalAudit')->where('status', 'aktif')->orderBy('tglTM', 'asc')->first();
                    if($jadwalAudit_ != null){
                        if(!empty($jadwalAudit)){
                            $unitKerja = unitKerjas::get();
                            $DokumenInduk = DB::table('dokumeninduk')
                                    ->where('tahun_aktif', date('Y'))
                                    ->where('status', 'aktif')
                                    ->where('sifatDokumen', 'private')
                                    ->first();
                            $pimpinan = pimpinans::where('status', "D0")->first();
                            $signature = DB::table('users')
                                    ->join('profile', 'profile.user_id', '=', 'users.id')
                                    ->select('users.*', 'profile.signature')
                                    ->where('users.role_id', 4)
                                    ->where('users.unitkerja_id', null)
                                    ->where('users.is_pimpinan', "D0")
                                    ->where('users.status', 'aktif')
                                    ->first();
                            // $audits = jadwalAudit::with('users')->get();
                            // $userAudit = User::get();
                            // $userAudits = User::get();
                                        
                            $pdf = PDF::loadView('menu.jadwalTM.exportPDF', compact('jadwalAudit', 'jadwalAudit_', 'unitKerja', 'pimpinan', 'signature', 'DokumenInduk'))
                                ->setPaper('a4', 'portrait');
                            $pdf->getDomPDF()->setHttpContext(
                                stream_context_create([
                                    'ssl' => [
                                        'allow_self_signed'=> TRUE,
                                        'verify_peer' => FALSE,
                                        'verify_peer_name' => FALSE,
                                    ]
                                ])
                            );
                            return $pdf->stream();
                            
                        }else{
                            return back()->with('error', 'Laporan Audit Kosong, Silahkan inputkan terlebih dahulu');
                        }

                    }else{
                        return back()->with('error', 'Laporan Audit Kosong, Silahkan inputkan terlebih dahulu');
                    }
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

            //BahanTM
            public function exportBahanTM()
            {
                try{
                    // $BahanTM = DB::table('jadwal_audit')
                    //         ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                    //         ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                    //         // ->join('laporan_audit', 'laporan_audit.audit_id', '=', 'jadwal_audit.id')
                    //         // ->join('car', 'car.laporanaudit_id', '=', 'laporan_audit.id')
                    //         ->select('bahan_rapattm.*', 'jadwal_audit.unitkerja_id', 'jadwal_audit.id as jadwalID', 'tinjauan_manajemen.id as tm_id', 'tinjauan_manajemen.tglTM')
                    //         ->where('tinjauan_manajemen.status', 'aktif')
                    //         ->where('jadwal_audit.status', 'aktif')
                    //         // ->where('car.status', 'closed')
                    //         ->get();
                            
                    $unitKerja = DB::table('unitkerja')->get();
                    $car = DB::table('car')->get();

                    if(auth()->user()->role_id == 1){
                        $BahanTM = DB::table('jadwal_audit')
                                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                                    ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                                    ->select('bahan_rapattm.*', 'jadwal_audit.unitkerja_id', 'jadwal_audit.id as jadwalID', 'tinjauan_manajemen.id as tm_id', 'tinjauan_manajemen.tglTM')
                                    ->where('tinjauan_manajemen.status', 'aktif')
                                    ->where('jadwal_audit.status', 'aktif')
                                    ->get();
                    }else{
                        $BahanTM = DB::table('jadwal_audit')
                                    ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', '=', 'jadwal_audit.id')
                                    ->join('bahan_rapattm', 'bahan_rapattm.tm_id', '=', 'tinjauan_manajemen.id')
                                    ->select('bahan_rapattm.*', 'jadwal_audit.unitkerja_id', 'jadwal_audit.id as jadwalID', 'tinjauan_manajemen.id as tm_id', 'tinjauan_manajemen.tglTM')
                                    ->where('tinjauan_manajemen.status', 'aktif')
                                    ->where('jadwal_audit.status', 'aktif')
                                    ->where('jadwal_audit.unitkerja_id', auth()->user()->unitkerja_id)
                                    ->get();
                    }

                    $PPMP = DB::table('users')
                            ->join('profile', 'profile.user_id', '=', 'users.id')
                            ->select('users.*', 'profile.signature')
                            ->where('users.role_id', 4)
                            ->where('users.unitkerja_id', 4)
                            ->where('users.status', 'aktif')
                            ->first();
                    $DokumenInduk = DB::table('dokumeninduk')
                            ->where('tahun_aktif', date('Y'))
                            ->where('status', 'aktif')
                            ->first();
                    
                    $table = new Table([
                        'alignment' => 'center',
                        'borderSize' => 5,
                        'width' => 10000,
                        'unit' => TblWidth::TWIP,
                        // 'unit' => TblWidth::auto,
                        // 'unit' => 'auto',
                        'align' => 'center',
                        'layout' => 'autofit']);
                    $table->addRow(self::ROW_HEIGHT, self::ROW_STYLE);
                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('No');
                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Jadwal TM');
                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Unit Kerja');
                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Auditor');
                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Auditee');
                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Laporan Temuan');
                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Hasil Pemeriksaan');
                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Status');

                    foreach ($BahanTM as $key=>$BahanTMs) {
                        $table->addRow(self::ROW_HEIGHT, self::ROW_STYLE);
                        $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText(++$key);
                        $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText(date('d F Y', strtotime($BahanTMs->tglTM)));
                        foreach ($unitKerja as $unitKerjas) {
                            if($BahanTMs->unitkerja_id == $unitKerjas->id){
                                $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText($unitKerjas->name);
                            }
                        }

                        $users = DB::table('users_jadwalaudit')
                            ->join('jadwal_audit', 'users_jadwalaudit.jadwal_id', '=', 'jadwal_audit.id')
                            ->join('users', 'users_jadwalaudit.user_id', '=', 'users.id')
                            ->select('users.*')
                            ->where('jadwal_audit.id', $BahanTMs->jadwalID)
                            ->where('users.status', 'aktif')
                            ->get();
                            foreach ($users as $user) {
                                if($user->role_id == 2){
                                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText($user->name);
                                }
                                if($user->role_id == 3){
                                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText($user->name);
                                }
                            }
                        $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText($BahanTMs->deskripsi);
                        foreach ($car as $cars) {
                            if($BahanTMs->car_id == $cars->id){
                                if($cars->hasilPemeriksaan == "nonsesuai"){
                                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Tidak Sesuai');
                                }else{
                                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Sesuai');
                                }
                                
                            }
                        }
                        foreach ($car as $cars) {
                            if($BahanTMs->car_id == $cars->id){
                                if($cars->status == "closed"){
                                    $table->addCell(self::CELL_WIDTH, self::CELL_STYLE)->addText('Closed');
                                }
                                
                            }
                        }
                    }
            
                    
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('template.docx'));

                    if($DokumenInduk == null){
                        $templateProcessor->setValue('no', '');
                        $templateProcessor->setValue('revisi', '');
                        $templateProcessor->setValue('tgl', '');
                        $templateProcessor->setComplexBlock('table', $table);
                        $templateProcessor->setValue('date', \Carbon\Carbon::parse()->isoFormat('D MMMM Y'));
                        $templateProcessor->setImageValue('signature', $PPMP->signature);
                        $templateProcessor->setValue('PPMP', $PPMP->name);
                    }elseif($table == null){
                        $templateProcessor->setValue('no', $DokumenInduk->nomor);
                        $templateProcessor->setValue('revisi', $DokumenInduk->revisi);
                        $templateProcessor->setValue('tgl', \Carbon\Carbon::parse($DokumenInduk->updated_at)->isoFormat('D MMMM Y'));
                        $templateProcessor->setValue('table', '');
                        $templateProcessor->setValue('date', \Carbon\Carbon::parse()->isoFormat('D MMMM Y'));
                        $templateProcessor->setImageValue('signature', $PPMP->signature);
                        $templateProcessor->setValue('PPMP', $PPMP->name);
                    }elseif($PPMP == null){
                        $templateProcessor->setValue('no', $DokumenInduk->nomor);
                        $templateProcessor->setValue('revisi', $DokumenInduk->revisi);
                        $templateProcessor->setValue('tgl', \Carbon\Carbon::parse($DokumenInduk->updated_at)->isoFormat('D MMMM Y'));
                        $templateProcessor->setComplexBlock('table', $table);
                        $templateProcessor->setValue('date', \Carbon\Carbon::parse()->isoFormat('D MMMM Y'));
                        $templateProcessor->setValue('signature', '');
                        $templateProcessor->setValue('PPMP', '');
                    }else{
                        $templateProcessor->setValue('no', $DokumenInduk->nomor);
                        $templateProcessor->setValue('revisi', $DokumenInduk->revisi);
                        $templateProcessor->setValue('tgl', \Carbon\Carbon::parse($DokumenInduk->updated_at)->isoFormat('D MMMM Y'));
                        $templateProcessor->setComplexBlock('table', $table);
                        $templateProcessor->setValue('date', \Carbon\Carbon::parse()->isoFormat('D MMMM Y'));
                        $templateProcessor->setImageValue('signature', $PPMP->signature);
                        $templateProcessor->setValue('PPMP', $PPMP->name);
                    }


                    $file_name = 'Bahan TM'. '-' .now()->toDateString() . '.docx';
                    $templateProcessor->saveAs(public_path('storage/files/Pusat/PPMP/TM/downloadBahanTM/'.$file_name));
            
                    return response()->download(public_path('storage/files/Pusat/PPMP/TM/downloadBahanTM/'.$file_name));
                    // $bahanTM = bahanRapatTM::first();
                    // $pdf = PDF::loadView('menu.bahanTM.exportPDF', compact('bahanTM'))
                    //     ->setPaper('a4', 'portrait');
                    // $pdf->getDomPDF()->setHttpContext(
                    //     stream_context_create([
                    //         'ssl' => [
                    //             'allow_self_signed'=> TRUE,
                    //             'verify_peer' => FALSE,
                    //             'verify_peer_name' => FALSE,
                    //         ]
                    //     ])
                    // );
                    // return $pdf->stream();
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

            //HasilTM
            public function exportHasilTM(Request $request)
            {
                try{

                    $HasilTM = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->select('hasil_rapattm.*', 'tinjauan_manajemen.tglTM', 'jadwal_audit.unitkerja_id')
                                // ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                                ->where('jadwal_audit.status', 'aktif')
                                ->where('tinjauan_manajemen.status', 'aktif')
                                ->orderBy('hasil_rapattm.created_at','desc')
                                ->get();
                    $HasilTM_ = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->select('hasil_rapattm.*', 'tinjauan_manajemen.tglTM', 'tinjauan_manajemen.waktuTM', 'jadwal_audit.unitkerja_id')
                                // ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                                ->where('jadwal_audit.status', 'aktif')
                                ->where('tinjauan_manajemen.status', 'aktif')
                                ->orderBy('hasil_rapattm.created_at','desc')
                                ->first();

                    $Direktur = DB::table('users')
                            ->join('profile', 'profile.user_id', '=', 'users.id')
                            ->select('users.*', 'profile.signature')
                            ->where('users.role_id', 4)
                            ->where('users.unitkerja_id', null)
                            ->where('users.is_pimpinan', "D0")
                            ->where('users.status', 'aktif')
                            ->first();
                    $getDirektur = DB::table('pimpinan')->where('status', 'D0')->first();
                    $PPMP = DB::table('users')
                            ->join('profile', 'profile.user_id', '=', 'users.id')
                            ->select('users.*', 'profile.signature')
                            ->where('users.role_id', 4)
                            ->where('users.unitkerja_id', 4)
                            ->where('users.status', 'aktif')
                            ->first();
                    
                    $DokumenInduk = DB::table('dokumeninduk')
                            ->where('tahun_aktif', date('Y'))
                            ->where('status', 'aktif')
                            ->where('sifatDokumen', 'private')
                            ->first();

                    if($DokumenInduk == null){
                        $nomor = null;
                        $revisi = null;
                        $tgl = null;
                        $signature = $PPMP->signature;
                        $PPMP = $PPMP->name;
                        $Direktur = $Direktur->name;
                    }elseif($PPMP == null){
                        $nomor = $DokumenInduk->nomor;
                        $revisi = $DokumenInduk->revisi;
                        $tgl = $DokumenInduk->updated_at;
                        $signature = null;
                        $PPMP = null;
                        $Direktur = null;
                    }else{
                        $nomor = $DokumenInduk->nomor;
                        $revisi = $DokumenInduk->revisi;
                        $tgl = $DokumenInduk->updated_at;
                        $signature = $PPMP->signature;
                        $PPMP = $PPMP->name;
                        $Direktur = $Direktur->name;
                    }

                    // dd($Direktur);

                    if(count($HasilTM) > 0){
                        $tindakLanjut = tindakLanjutTM::get();
                        $unitKerjas = unitKerjas::get();
                        $unitKerja = unitKerjas::where('id', $request->unitkerja_id)->first();
                        $users = User::get();

                        $pdf = PDF::loadView('menu.hasilTM.exportPDF', compact('HasilTM', 'HasilTM_', 'tindakLanjut', 'unitKerjas', 'unitKerja', 'users', 'nomor', 'revisi', 'tgl', 'signature', 'PPMP', 'Direktur'))
                            ->setPaper('a4', 'portrait');
                        $pdf->getDomPDF()->setHttpContext(
                            stream_context_create([
                                'ssl' => [
                                    'allow_self_signed'=> TRUE,
                                    'verify_peer' => FALSE,
                                    'verify_peer_name' => FALSE,
                                ]
                            ])
                        );
                        return $pdf->stream();

                    }else{
                        return back()->with('error', 'Laporan CAR Kosong, Silahkan inputkan terlebih dahulu');
                    }
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

            public function exportNotulenHasilTM(Request $request)
            {
                try{

                    $notulenHasilTM = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->select('hasil_rapattm.*', 'tinjauan_manajemen.tglTM', 'jadwal_audit.unitkerja_id')
                                // ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                                ->where('jadwal_audit.status', 'aktif')
                                ->where('tinjauan_manajemen.status', 'aktif')
                                ->orderBy('hasil_rapattm.created_at','desc')
                                ->get();

                                foreach($notulenHasilTM as $notulenHasilTMs){
                                    $getHadir[] = $notulenHasilTMs->hadir;
                                    $getTidakHadir[] = $notulenHasilTMs->tidakHadir;
                                }

                                $hadir = array_sum($getHadir);
                                $tidakHadir = array_sum($getTidakHadir);

                    $notulenHasilTM_ = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->select('hasil_rapattm.*', 'tinjauan_manajemen.tglTM', 'jadwal_audit.unitkerja_id', 'tinjauan_manajemen.tglTM', 'tinjauan_manajemen.waktuTM')
                                // ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                                ->where('jadwal_audit.status', 'aktif')
                                ->where('tinjauan_manajemen.status', 'aktif')
                                ->first();

                    $Direktur = DB::table('users')
                            ->join('profile', 'profile.user_id', '=', 'users.id')
                            ->select('users.*', 'profile.signature')
                            ->where('users.role_id', 4)
                            ->where('users.unitkerja_id', null)
                            ->where('users.status', 'aktif')
                            ->first();
                    $PPMP = DB::table('users')
                            ->join('profile', 'profile.user_id', '=', 'users.id')
                            ->select('users.*', 'profile.signature')
                            ->where('users.role_id', 4)
                            ->where('users.unitkerja_id', 4)
                            ->where('users.status', 'aktif')
                            ->first();
                    $DokumenInduk = DB::table('dokumeninduk')
                            ->where('tahun_aktif', date('Y'))
                            ->where('status', 'aktif')
                            ->where('sifatDokumen', 'private')
                            ->first();

                    if($DokumenInduk == null){
                        $nomor = null;
                        $revisi = null;
                        $tgl = null;
                        $signature = $PPMP->signature;
                        $PPMP = $PPMP->name;
                        $Direktur = $Direktur->name;
                    }elseif($PPMP == null){
                        $nomor = $DokumenInduk->nomor;
                        $revisi = $DokumenInduk->revisi;
                        $tgl = $DokumenInduk->updated_at;
                        $signature = null;
                        $PPMP = null;
                        $Direktur = null;
                    }else{
                        $nomor = $DokumenInduk->nomor;
                        $revisi = $DokumenInduk->revisi;
                        $tgl = $DokumenInduk->updated_at;
                        $signature = $PPMP->signature;
                        $PPMP = $PPMP->name;
                        $Direktur = $Direktur->name;
                    }

                    if($notulenHasilTM_ != null){
                        if(count($notulenHasilTM) > 0){
                            $tindakLanjut = tindakLanjutTM::get();
                            $unitKerjas = unitKerjas::get();
                            // $unitKerja = unitKerjas::where('id', $request->unitkerja_id)->first();
                            $users = User::get();

                            $pdf = PDF::loadView('menu.hasilTM.exportNotulenPDF', compact('notulenHasilTM', 'notulenHasilTM_', 'tindakLanjut', 'unitKerjas', 'hadir', 'tidakHadir', 'users', 'nomor', 'revisi', 'tgl', 'signature', 'PPMP', 'Direktur'))
                                ->setPaper('a4', 'portrait');
                            $pdf->getDomPDF()->setHttpContext(
                                stream_context_create([
                                    'ssl' => [
                                        'allow_self_signed'=> TRUE,
                                        'verify_peer' => FALSE,
                                        'verify_peer_name' => FALSE,
                                    ]
                                ])
                            );
                            return $pdf->stream();

                        }else{
                            return back()->with('error', 'Laporan CAR Kosong, Silahkan inputkan terlebih dahulu');
                        }

                    }else{
                        return back()->with('error', 'Laporan CAR Kosong, Silahkan inputkan terlebih dahulu');
                    }
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

            //TindakLanjutTM
            public function exportCatatanHasilTM(Request $request)
            {
                // dd($id);
                try{
                    // $catatanTM = hasilRapatTM::with('tinjauanManajemen')->where('tm_id', $request->tm_id)->get();
                    // $catatanTM_ = hasilRapatTM::with('tinjauanManajemen')->where('tm_id', $request->tm_id)->first(); 
                    
                    $catatanTM = DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                            ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                            ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                            ->select('hasil_rapattm.*', 'tinjauan_manajemen.tglTM', 'jadwal_audit.unitkerja_id', 'tindak_lanjuttm.tindakLanjut', 'tindak_lanjuttm.status as statusTindakTM')
                            // ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                            ->where('jadwal_audit.status', 'aktif')
                            ->where('tinjauan_manajemen.status', 'aktif')
                            ->orderBy('hasil_rapattm.created_at','desc')
                            ->get();

                    $catatanTM_ = DB::table('jadwal_audit')
                            ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                            ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                            ->select('hasil_rapattm.*', 'tinjauan_manajemen.tglTM', 'jadwal_audit.unitkerja_id', 'tinjauan_manajemen.tglTM', 'tinjauan_manajemen.waktuTM')
                            // ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                            ->where('jadwal_audit.status', 'aktif')
                            ->where('tinjauan_manajemen.status', 'aktif')
                            ->first();

                    $PPMP = DB::table('users')
                            ->join('profile', 'profile.user_id', '=', 'users.id')
                            ->select('users.*', 'profile.signature')
                            ->where('users.role_id', 4)
                            ->where('users.unitkerja_id', 4)
                            ->where('users.status', 'aktif')
                            ->first();

                    $DokumenInduk = DB::table('dokumeninduk')
                            ->where('tahun_aktif', date('Y'))
                            ->where('status', 'aktif')
                            ->where('sifatDokumen', 'private')
                            ->first();

                    if($DokumenInduk == null){
                        $nomor = null;
                        $revisi = null;
                        $tgl = null;
                        $signature = $PPMP->signature;
                        $PPMP = $PPMP->name;
                    }elseif($PPMP == null){
                        $nomor = $DokumenInduk->nomor;
                        $revisi = $DokumenInduk->revisi;
                        $tgl = $DokumenInduk->updated_at;
                        $signature = null;
                        $PPMP = null;
                    }else{
                        $nomor = $DokumenInduk->nomor;
                        $revisi = $DokumenInduk->revisi;
                        $tgl = $DokumenInduk->updated_at;
                        $signature = $PPMP->signature;
                        $PPMP = $PPMP->name;
                    }

                    if($catatanTM_ != null){
                        if(count($catatanTM) > 0){
                            $tindakLanjut = tindakLanjutTM::get();
                            $unitKerja = unitKerjas::where('id', $request->unitkerja_id)->first();
                            $users = User::get();

                            $pdf = PDF::loadView('menu.hasilTM.exportCatatanPDF', compact('catatanTM', 'catatanTM_', 'tindakLanjut', 'unitKerja', 'users', 'nomor', 'revisi', 'tgl', 'signature', 'PPMP'))
                                ->setPaper('a4', 'portrait');
                            $pdf->getDomPDF()->setHttpContext(
                                stream_context_create([
                                    'ssl' => [
                                        'allow_self_signed'=> TRUE,
                                        'verify_peer' => FALSE,
                                        'verify_peer_name' => FALSE,
                                    ]
                                ])
                            );
                            return $pdf->stream();

                        }else{
                            return back()->with('error', 'Laporan CAR Kosong, Silahkan inputkan terlebih dahulu');
                        }

                    }else{
                        return back()->with('error', 'Laporan CAR Kosong, Silahkan inputkan terlebih dahulu');
                    }
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }
            
            public function exportPenyelesaianTindakTM(Request $request)
            {
                try{
                    $penyelesaianTM = DB::table('jadwal_audit')
                                ->join('tinjauan_manajemen', 'tinjauan_manajemen.audit_id', 'jadwal_audit.id')
                                ->join('hasil_rapattm', 'hasil_rapattm.tm_id', 'tinjauan_manajemen.id')
                                ->join('tindak_lanjuttm', 'tindak_lanjuttm.hslrpt_id', 'hasil_rapattm.id')
                                ->select('tindak_lanjuttm.*', 'hasil_rapattm.subjek', 'tinjauan_manajemen.tglTM', 'jadwal_audit.unitkerja_id')
                                // ->where('jadwal_audit.unitkerja_id', $request->unitkerja_id)
                                ->where('jadwal_audit.status', 'aktif')
                                ->where('tinjauan_manajemen.status', 'aktif')
                                ->where('hasil_rapattm.status', 'aktif')
                                ->orderBy('tindak_lanjuttm.created_at','desc')
                                ->get();

                        $PPMP = DB::table('users')
                                ->join('profile', 'profile.user_id', '=', 'users.id')
                                ->select('users.*', 'profile.signature')
                                ->where('users.role_id', 4)
                                ->where('users.unitkerja_id', 4)
                                ->where('users.status', 'aktif')
                                ->first();
                        $DokumenInduk = DB::table('dokumeninduk')
                                ->where('tahun_aktif', date('Y'))
                                ->where('status', 'aktif')
                                ->where('sifatDokumen', 'private')
                                ->first();

                        if($DokumenInduk == null){
                            $nomor = null;
                            $revisi = null;
                            $tgl = null;
                            $signature = $PPMP->signature;
                            $PPMP = $PPMP->name;
                        }elseif($PPMP == null){
                            $nomor = $DokumenInduk->nomor;
                            $revisi = $DokumenInduk->revisi;
                            $tgl = $DokumenInduk->updated_at;
                            $signature = null;
                            $PPMP = null;
                        }else{
                            $nomor = $DokumenInduk->nomor;
                            $revisi = $DokumenInduk->revisi;
                            $tgl = $DokumenInduk->updated_at;
                            $signature = $PPMP->signature;
                            $PPMP = $PPMP->name;
                        }

                    if(count($penyelesaianTM) > 0){
                        $unitKerja = unitKerjas::where('id', $request->unitkerja_id)->first();
                        $users = User::get();
                                        
                        $pdf = PDF::loadView('menu.tindakTM.exportPDF', compact('penyelesaianTM', 'unitKerja', 'users', 'nomor', 'revisi', 'tgl', 'signature', 'PPMP'))
                            ->setPaper('a4', 'portrait');
                        $pdf->getDomPDF()->setHttpContext(
                            stream_context_create([
                                'ssl' => [
                                    'allow_self_signed'=> TRUE,
                                    'verify_peer' => FALSE,
                                    'verify_peer_name' => FALSE,
                                ]
                            ])
                        );
                        return $pdf->stream();

                    }else{
                        return back()->with('error', 'Laporan Audit Kosong, Silahkan inputkan terlebih dahulu');
                    }
                    
                }catch (Exception $exc) {
                    abort(404, $exc->getMessage());
                }
            }

}