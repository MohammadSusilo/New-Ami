<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\AdminController;

//Menu
use App\Http\Controllers\menu\auditReports;
use App\Http\Controllers\menu\capaianKinerja;
use App\Http\Controllers\menu\CarReports;
use App\Http\Controllers\menu\chart;
use App\Http\Controllers\menu\checklist;
use App\Http\Controllers\menu\pengelola;
use App\Http\Controllers\menu\pimpinan;
use App\Http\Controllers\menu\standar;
use App\Http\Controllers\menu\renop;
use App\Http\Controllers\menu\renstra;
use App\Http\Controllers\menu\scheduling;
use App\Http\Controllers\menu\unitKerja;
use App\Http\Controllers\menu\dokumen;
use App\Http\Controllers\menu\profileController;
use App\Http\Controllers\menu\kinerjaUnits;
use App\Http\Controllers\menu\buktiKinerjas;
use App\Http\Controllers\menu\jadwalTM;
use App\Http\Controllers\menu\bahanTM;
use App\Http\Controllers\menu\hasilTM;
use App\Http\Controllers\menu\tindakTM;
use App\Http\Controllers\menu\mainMenu\renstraRenop;
use App\Http\Controllers\menu\mainMenu\pimpinanUK;
use App\Http\Controllers\menu\mainMenu\AMI;
use App\Http\Controllers\menu\mainMenu\TM;
use App\Http\Controllers\menu\importExports\importExport;
use App\Http\Controllers\menu\LAMTeknikController;
use App\Http\Controllers\menu\SPME\LAMTeknik\LED\LEDCover;
use App\Http\Controllers\menu\SPME\LAMTeknik\LED\LEDPendahuluan;
use App\Http\Controllers\menu\SPME\LAMTeknik\LED\LEDKondisiEksternal;
use App\Http\Controllers\menu\SPME\LAMTeknik\LED\LEDProfilUPPS;
use App\Http\Controllers\menu\SPME\LAMTeknik\LED\LEDPenjaminanMutu;
use App\Http\Controllers\menu\SPME\LAMTeknik\LED\LEDPengembanganBerkelanjutan;
use App\Http\Controllers\menu\SPME\LAMTeknik\LED\LEDPenutup;
use App\Http\Controllers\menu\LAMEmbaController;
use App\Http\Controllers\menu\LAMInfokomController;
use App\Http\Controllers\menu\BANPTController;

use App\Http\Controllers\SettingController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\FAQsController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\DokumenPolines;
use App\Http\Controllers\menu\dokumenChecklist;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    

    Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
    Route::group(['prefix' => 'filemanager'], function (){
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::group(['middleware' => ['auth']], function () {
        //HOME
        Route::get('dashboard', [HomeController::class, 'index'])->name('home.dashboard');

        //MASTER DATA
            //PIMPINAN PENGELOLA UNIT KERJA
            Route::get('PimpinanUnitKerja', [pimpinanUK::class, 'index'])->name('pimpinanUK.index');

                //PIMPINAN
                Route::resource('pimpinan', pimpinan::class);
                Route::post('pimpinanchange', 'App\Http\Controllers\menu\pimpinan@Change');

                //PENGELOLA
                Route::resource('pengelola', pengelola::class);
                Route::post('pengelolachange', 'App\Http\Controllers\menu\pengelola@Change');

                //UNIT KERJA
                Route::resource('unitKerja', unitKerja::class);
            
            //STANDAR
            Route::resource('standar', standar::class);


            //DOKUMEN UMUM & RENCANA STRATEGIS
            Route::get('RencanaStrategisRencanaOperasional', [renstraRenop::class, 'index'])->name('renstraRenop.index');

                //DOKUMEN POLINES
                Route::resource('dokumenPolines', DokumenPolines::class);
                Route::post('dokumenPolines/post/multi', [DokumenPolines::class, 'StoreMulti'])->name('dokumenPolines.saveMulti');


                //RENSTRA
                Route::resource('renstra', renstra::class);
                Route::post('renstra/multi', [renstra::class, 'renstraSaveMulti'])->name('renstra.saveMulti');
                Route::get('dokAcuanhistory/history', [renstra::class, 'history']);

                //RENOP
                Route::resource('renop', renop::class);
                Route::get('/renopget', [renop::class, 'renopget']);
                Route::get('/renopread', [renop::class, 'renopread']);
                Route::get('/renopreadhistory', [renop::class, 'renopreadhistory']);
                Route::get('Renophistory/history', [renop::class, 'history']);

                
                Route::post('renop/multi', [renop::class, 'renopSaveMulti'])->name('renop.saveMulti');
                            
                    //KINERJA UNIT
                    Route::resource('kinerjaUnit', kinerjaUnits::class);
                    Route::get('kinerjaUnit/{id}', [kinerjaUnits::class, 'dataget'])->name('kinerjaUnit.get');
                    Route::post('kinerjaUnit/multi', [kinerjaUnits::class, 'kinerjaUnitSaveMulti'])->name('kinerjaUnit.saveMulti');
                    Route::get('kinerjaUnithistory/history', [kinerjaUnits::class, 'history']);
                    
                    //BUKTI KINERJA
                    Route::resource('buktiKinerja', buktiKinerjas::class);
                    Route::get('buktiKinerja/{id}', [buktiKinerjas::class, 'dataget'])->name('buktiKinerja.get');
                    Route::get('buktiKinerja/create/{id}', [buktiKinerjas::class, 'buktinew'])->name('buktiKinerja.new');
                    Route::get('buktiKinerja/list/{id}', [buktiKinerjas::class, 'buktilist'])->name('buktiKinerja.list');
                    Route::get('buktiKinerja/multi/create/{id}', [buktiKinerjas::class, 'buktinewMulti'])->name('buktiKinerja.newMulti');
                    Route::post('buktiKinerja/multi', [buktiKinerjas::class, 'buktiKinerjaSaveMulti'])->name('buktiKinerja.saveMulti');
                    Route::get('buktiUnithistory/history', [buktiKinerjas::class, 'history']);

                //DOKUMEN
                Route::get('dokumen/induk', [dokumen::class, 'dokumenInduk'])->name('dokumen.induk');
                Route::post('dokumen/induk/post', [dokumen::class, 'dokumenIndukSave'])->name('dokumen.induk.save');
                Route::post('dokumen/induk/post/multi', [dokumen::class, 'dokumenIndukSaveMulti'])->name('dokumen.induk.saveMulti');
                Route::get('dokumen/induk/edit/{id}', [dokumen::class, 'dokumenIndukEdit'])->name('dokumen.induk.edit');
                Route::put('dokumen/induk/update/{id}', [dokumen::class, 'dokumenIndukUpdate'])->name('dokumen.induk.update');
                Route::delete('dokumen/induk/destroy/{id}', [dokumen::class, 'dokumenIndukDestroy'])->name('dokumen.induk.destroy');
                Route::get('dokIndukhistory/history', [dokumen::class, 'historyDokInduk']);
                
                Route::get('dokumen/checklist', [dokumen::class, 'dokumenChecklist'])->name('dokumen.checklist');
                Route::get('dokumen/checklist/show/{id}', [dokumen::class, 'dokumenChecklistShow'])->name('dokumen.checklist.show');
                Route::post('dokumen/checklist/post', [dokumen::class, 'dokumenChecklistSave'])->name('dokumen.checklist.save');
                Route::get('dokumen/checklist/edit/{id}', [dokumen::class, 'dokumenChecklistEdit'])->name('dokumen.checklist.edit');
                Route::put('dokumen/checklist/update/{id}', [dokumen::class, 'dokumenChecklistUpdate'])->name('dokumen.checklist.update');
                Route::delete('dokumen/checklist/destroy/{id}', [dokumen::class, 'dokumenChecklistDestroy'])->name('dokumen.checklist.destroy');
                Route::post('dokumen/checklist/multi', [dokumen::class, 'dokChecklistSaveMulti'])->name('dokumen.checklist.saveMulti');
                Route::get('dokChecklisthistory/history', [dokumen::class, 'historyDokChecklist']);
                
        //AMI
        Route::get('AMI', [AMI::class, 'index'])->name('ami.index');

            //PENJADWALAN
            Route::resource('scheduling', scheduling::class);
            Route::post('scheduling/multi', [scheduling::class, 'schedulingSaveMulti'])->name('scheduling.saveMulti');
            Route::get('selectSchedulingExportPDF', [importExport::class, 'exportJadwalAudit'])->name('scheduling.selectExportPDF');
            Route::get('selectSchedulingExportSuratPemberitahuanPDF/{id}', [importExport::class, 'exportSuratPemberitahuanAudit'])->name('scheduling.selectExportSuratPDF');
            Route::get('jadwalAudit/history', [scheduling::class, 'history']);
            Route::post('jadwalAudit/disabled', [scheduling::class, 'disabled']);

            //AUDIT REPORT    
            Route::resource('auditReports', auditReports::class);
            Route::post('auditReports/multi', [auditReports::class, 'auditReportsSaveMulti'])->name('auditReports.saveMulti');
            Route::get('/auditReportsExportPDF/{id}', [importExport::class, 'exportLaporanAudit'])->name('auditReports.exportPDF');
            Route::post('selectauditReportsExportPDF', [importExport::class, 'exportLaporanAudit'])->name('auditReports.selectExportPDF');
            Route::post('selectdaftarAuditReportsExportPDF', [importExport::class, 'exportDaftarAudit'])->name('auditReports.selectExportDaftarPDF');
            Route::get('laporanAudit/history', [auditReports::class, 'history']);

            //CAR
            Route::resource('CarReports', CarReports::class);
            Route::post('CarReports/multi', [CarReports::class, 'CarReportsSaveMulti'])->name('CarReports.saveMulti');
            Route::get('/CarReportsExportPDF/{id}', [importExport::class, 'exportCAR'])->name('CarReports.exportPDF');
            Route::post('selectCarReportsExportPDF', [importExport::class, 'exportCAR'])->name('CarReports.selectExportPDF');
            Route::post('selectCarNotInAccordanceExportWord', [importExport::class, 'exportCARNotInAccordance'])->name('CarReports.selectExportWord');
            Route::get('CAR/history', [CarReports::class, 'history']);
            Route::post('carchange', [CarReports::class, 'Change']);
            Route::get('/CARget', [CarReports::class, 'CARget']);

        //SPME
            //LAM TEKNIK
            Route::resource('LAMTeknik', LAMTeknikController::class);
            Route::get('/LAMTeknik/LED/Cover', [LAMTeknikController::class, 'LEDCoverIndex']);
            Route::get('/LAMTeknik/LED/Cover/{id}', [LAMTeknikController::class, 'LEDCoverIndex']);
            Route::get('/LAMTeknik/LED/BAB1', [LAMTeknikController::class, 'LEDBAB1Index']);
            Route::get('/LAMTeknik/LED/BAB1/{id}', [LAMTeknikController::class, 'LEDBAB1Index']);
            Route::get('/LAMTeknik/LED/BAB2/Struktur', [LAMTeknikController::class, 'LEDBAB2StrukturIndex']);
            Route::get('/LAMTeknik/LED/BAB2/KondisiEksternal', [LAMTeknikController::class, 'LEDBAB2KondisiEksternalIndex']);
            Route::get('/LAMTeknik/LED/BAB2/KondisiEksternal/{id}', [LAMTeknikController::class, 'LEDBAB2KondisiEksternalIndex']);
            Route::get('/LAMTeknik/LED/BAB2/ProfilUPPS', [LAMTeknikController::class, 'LEDBAB2ProfilUPPSIndex']);
            Route::get('/LAMTeknik/LED/BAB2/ProfilUPPS/{id}', [LAMTeknikController::class, 'LEDBAB2ProfilUPPSIndex']);
            Route::get('/LAMTeknik/LED/BAB2/Kriteria1', [LAMTeknikController::class, 'LEDBAB2Kriteria1Index']);
            Route::get('/LAMTeknik/LED/BAB2/Kriteria2', [LAMTeknikController::class, 'LEDBAB2Kriteria2Index']);
            Route::get('/LAMTeknik/LED/BAB2/Kriteria3', [LAMTeknikController::class, 'LEDBAB2Kriteria3Index']);
            Route::get('/LAMTeknik/LED/BAB2/Kriteria4', [LAMTeknikController::class, 'LEDBAB2Kriteria4Index']);
            Route::get('/LAMTeknik/LED/BAB2/Kriteria5', [LAMTeknikController::class, 'LEDBAB2Kriteria5Index']);
            Route::get('/LAMTeknik/LED/BAB2/Kriteria6', [LAMTeknikController::class, 'LEDBAB2Kriteria6Index']);
            Route::get('/LAMTeknik/LED/BAB2/Kriteria7', [LAMTeknikController::class, 'LEDBAB2Kriteria7Index']);
            Route::get('/LAMTeknik/LED/BAB2/Kriteria8', [LAMTeknikController::class, 'LEDBAB2Kriteria8Index']);
            Route::get('/LAMTeknik/LED/BAB2/Kriteria9', [LAMTeknikController::class, 'LEDBAB2Kriteria9Index']);
            Route::get('/LAMTeknik/LED/BAB3', [LAMTeknikController::class, 'LEDBAB3Index']);
            Route::get('/LAMTeknik/LED/BAB3/{id}', [LAMTeknikController::class, 'LEDBAB3Index']);
            Route::get('/LAMTeknik/LED/BAB4', [LAMTeknikController::class, 'LEDBAB4Index']);
            Route::get('/LAMTeknik/LED/BAB4/{id}', [LAMTeknikController::class, 'LEDBAB4Index']);
            Route::get('/LAMTeknik/LED/BAB5', [LAMTeknikController::class, 'LEDBAB5Index']);
            Route::get('/LAMTeknik/LED/BAB5/{id}', [LAMTeknikController::class, 'LEDBAB5Index']);
            Route::get('/LAMTeknik/LED/Lampiran', [LAMTeknikController::class, 'LEDLampiranIndex']);

                //Create LED
                Route::resource('LAMTeknik_LED_Cover', LEDCover::class);
                Route::resource('LAMTeknik_LED_Pendahuluan', LEDPendahuluan::class);
                Route::resource('LAMTeknik_LED_KondisiEksternal', LEDKondisiEksternal::class);
                Route::resource('LAMTeknik_LED_ProfilUPPS', LEDProfilUPPS::class);
                Route::resource('LAMTeknik_LED_PenjaminanMutu', LEDPenjaminanMutu::class);
                Route::resource('LAMTeknik_LED_PengBer', LEDPengembanganBerkelanjutan::class);
                Route::resource('LAMTeknik_LED_Penutup', LEDPenutup::class);

            //LAM EMBA
            Route::resource('LAMEmba', LAMEmbaController::class);

            //LAM INFOKOM
            Route::resource('LAMInfokom', LAMInfokomController::class);

            //BAN PT
            Route::resource('BANPT', BANPTController::class);

        //TINJAUAN MANAJEMEN
        Route::get('TinjauanManajemen', [TM::class, 'index'])->name('tinjauanManajemen.index');

            //JADWAL TM
            Route::resource('jadwalTM', jadwalTM::class);
            Route::get('jadwalTM/create/{id}', [jadwalTM::class, 'jadwalTMnew'])->name('jadwalTM.new');
            Route::get('jadwalTMMulti/create/{id}', [jadwalTM::class, 'jadwalTMnewMulti'])->name('jadwalTM.newMulti');
            Route::post('jadwalTM/multi', [jadwalTM::class, 'jadwalTMSaveMulti'])->name('jadwalTM.saveMulti');
            Route::get('selectJadwalTMExportPDF', [importExport::class, 'exportJadwalTM'])->name('jadwalTM.selectExportPDF');
            Route::get('jadwalTinjauanManajemen/history', [jadwalTM::class, 'history']);
            
            //BAHAN TM
            Route::resource('bahanTM', bahanTM::class);
            Route::post('bahanTM/multi', [bahanTM::class, 'bahanTMSaveMulti'])->name('bahanTM.saveMulti');
            Route::get('selectBahanTMExportPDF', [importExport::class, 'exportBahanTM'])->name('bahanTM.selectExportPDF');
            Route::get('bahanTinjauanManajemen/history', [bahanTM::class, 'history']);
            Route::get('/bahanTMImport', [bahanTM::class, 'importBahanTM'])->name('bahanTM.import');
            Route::get('/getbahanTM', [bahanTM::class, 'importBahanTM']);
            // Route::post('selectBahanTMExportPDF', [importExport::class, 'exportCARNotInAccordance'])->name('CarReports.selectExportWord');

            //HASIL TM
            Route::resource('hasilTM', hasilTM::class);
            Route::post('hasilTM/multi', [hasilTM::class, 'hasilTMSaveMulti'])->name('hasilTM.saveMulti');
            Route::post('selectHasilTMExportPDF', [importExport::class, 'exportHasilTM'])->name('hasilTM.selectExportPDF');
            Route::post('selectNotulenHasilTMExportPDF', [importExport::class, 'exportNotulenHasilTM'])->name('hasilTM.selectExportNotulenPDF');
            Route::get('hasilTinjauanManajemen/history', [hasilTM::class, 'history']);
            Route::get('hasilTMget', [hasilTM::class, 'hasilTMget']);
            Route::get('/gethasilTM', [hasilTM::class, 'importHasilTM']);

            //TINDAK LANJUT TM
            Route::resource('tindakLanjutTM', tindakTM::class);
            Route::post('tindakLanjutTM/multi', [tindakTM::class, 'tindakLanjutTMSaveMulti'])->name('tindakLanjutTM.saveMulti');
            Route::post('selectCatatanTMExportPDF', [importExport::class, 'exportCatatanHasilTM'])->name('hasilTM.selectExportCatatanPDF');
            Route::post('selectPenyelesaianTMExportPDF', [importExport::class, 'exportPenyelesaianTindakTM'])->name('tindakLanjutTM.selectExportPenyelesaianPDF');
            Route::get('tindakLanjutTinjauanManajemen/history', [tindakTM::class, 'history']);
        //REPORT

            //CHART
            Route::resource('chart', chart::class);

            Route::get('/chartDateTimeDokumenIndukget', [chart::class, 'chartDateTimeDokumenIndukget']);
            Route::get('/chartStatusDokumenIndukget', [chart::class, 'chartStatusDokumenIndukget']);
            Route::get('/dokumenIndukread', [chart::class, 'dokumenIndukread']);

            Route::get('/chartUnitKerjaDokumenChecklistget', [chart::class, 'chartUnitKerjaDokumenChecklistget']);
            Route::get('/chartDateTimeDokumenChecklistget', [chart::class, 'chartDateTimeDokumenChecklistget']);
            Route::get('/chartStatusDokumenChecklistget', [chart::class, 'chartStatusDokumenChecklistget']);
            Route::get('/dokumenChecklistread', [chart::class, 'dokumenChecklistread']);

            Route::get('/chartJenisDokumenAcuanget', [chart::class, 'chartJenisDokumenAcuanget']);
            Route::get('/chartStatusDokumenAcuanget', [chart::class, 'chartStatusDokumenAcuanget']);
            Route::get('/chartDateTimeDokumenAcuanget', [chart::class, 'chartDateTimeDokumenAcuanget']);
            Route::get('/dokumenAcuanread', [chart::class, 'dokumenAcuanread']);

            Route::get('/chartUnitKerjaRenopget', [chart::class, 'chartUnitKerjaRenopget']);
            Route::get('/chartStatusRenopget', [chart::class, 'chartStatusRenopget']);
            Route::get('/chartDateTimeRenopget', [chart::class, 'chartDateTimeRenopget']);
            Route::get('/Renopread', [chart::class, 'Renopread']);

            Route::get('/chartUnitKerjaKinerjaUnitget', [chart::class, 'chartUnitKerjaKinerjaUnitget']);
            Route::get('/chartStatusKinerjaUnitget', [chart::class, 'chartStatusKinerjaUnitget']);
            Route::get('/chartDateTimeKinerjaUnitget', [chart::class, 'chartDateTimeKinerjaUnitget']);
            Route::get('/kinerjaUnitread', [chart::class, 'kinerjaUnitread']);

            Route::get('/chartUnitKerjaBuktiKinerjaget', [chart::class, 'chartUnitKerjaBuktiKinerjaget']);
            Route::get('/chartStatusBuktiKinerjaget', [chart::class, 'chartStatusBuktiKinerjaget']);
            Route::get('/chartDateTimeBuktiKinerjaget', [chart::class, 'chartDateTimeBuktiKinerjaget']);
            Route::get('/buktiKinerjaread', [chart::class, 'buktiKinerjaread']);

            //AMI
            Route::get('/AMIread', [chart::class, 'AMIread']);
            Route::get('/chartUKAMIget', [chart::class, 'chartUKAMIget']);
            Route::get('/chartDateTimeAMIget', [chart::class, 'chartDateTimeAMIget']);
            Route::get('/chartSelectAMIget/Sesuai', [chart::class, 'chartSelectAMISesuaiget']);
            Route::get('/chartSelectAMIget/NonSesuai', [chart::class, 'chartSelectAMINonSesuaiget']);
            Route::get('/chartSelectAMIget/Open', [chart::class, 'chartSelectAMIOpenget']);
            Route::get('/chartSelectAMIget/Process', [chart::class, 'chartSelectAMIProcessget']);
            
            //TM
            Route::get('/TMread', [chart::class, 'TMread']);
            Route::get('/chartUKTMget', [chart::class, 'chartUKTMget']);
            Route::get('/chartDateTimeTMget', [chart::class, 'chartDateTimeTMget']);
            Route::get('/chartSelectTMget/Selesai', [chart::class, 'chartSelectTMSelesaiget']);
            Route::get('/chartSelectTMget/NonSelesai', [chart::class, 'chartSelectTMNonSelesaiget']);

            
            Route::get('/chartUnitKerjaJadwalAuditget', [chart::class, 'chartUnitKerjaJadwalAuditget']);
            Route::get('/chartJadwalAuditget', [chart::class, 'chartJadwalAuditget']);
            Route::get('/chartStatusJadwalAuditget', [chart::class, 'chartStatusJadwalAuditget']);
            Route::get('/jadwalAuditread', [chart::class, 'jadwalAuditread']);

            Route::get('/chartUnitKerjaLaporanAuditget', [chart::class, 'chartUnitKerjaLaporanAuditget']);
            Route::get('/chartStandarLaporanAuditget', [chart::class, 'chartStandarLaporanAuditget']);
            Route::get('/chartKategoriLaporanAuditget', [chart::class, 'chartKategoriLaporanAuditget']);
            Route::get('/chartLaporanAuditget', [chart::class, 'chartLaporanAuditget']);
            Route::get('/chartStatusLaporanAuditget', [chart::class, 'chartStatusLaporanAuditget']);
            Route::get('/laporanAuditread', [chart::class, 'laporanAuditread']);

            Route::get('/chartUnitKerjaCARget', [chart::class, 'chartUnitKerjaCARget']);
            Route::get('/chartStandarCARget', [chart::class, 'chartStandarCARget']);
            Route::get('/chartStatusCARget', [chart::class, 'chartStatusCARget']);
            Route::get('/CARread', [chart::class, 'CARread']);
            
            Route::get('/chartUnitKerjaJadwalTMget', [chart::class, 'chartUnitKerjaJadwalTMget']);
            Route::get('/chartDateTimeJadwalTMget', [chart::class, 'chartDateTimeJadwalTMget']);
            Route::get('/chartStatusJadwalTMget', [chart::class, 'chartStatusJadwalTMget']);
            Route::get('/jadwalTMread', [chart::class, 'jadwalTMread']);

            Route::get('/chartUnitKerjaBahanTMget', [chart::class, 'chartUnitKerjaBahanTMget']);
            Route::get('/chartStatusBahanTMget', [chart::class, 'chartStatusBahanTMget']);
            Route::get('/BahanTMread', [chart::class, 'BahanTMread']);

            Route::get('/chartUnitKerjaHasilTMget', [chart::class, 'chartUnitKerjaHasilTMget']);
            Route::get('/chartStatusHasilTMget', [chart::class, 'chartStatusHasilTMget']);
            Route::get('/HasilTMread', [chart::class, 'HasilTMread']);

            Route::get('/chartUnitKerjaTindakTMget', [chart::class, 'chartUnitKerjaTindakTMget']);
            Route::get('/chartStatusTindakTMget', [chart::class, 'chartStatusTindakTMget']);
            Route::get('/TindakTMread', [chart::class, 'TindakTMread']);

        //MASTER USER
            //USER
            Route::resource('users', UsersController::class);
            Route::post('userschange', 'App\Http\Controllers\UsersController@Change');
            Route::post('users/multi', [UsersController::class, 'UsersSaveMulti'])->name('users.saveMulti');

            //ROLE
            Route::resource('roles', RolesController::class);

            //PROFILE
            Route::resource('profile', profileController::class);
            Route::put('profile/password/{id}', [profileController::class, 'password'])->name('profile.password');

        //APPS
            //SETTING
            Route::resource('setting', SettingController::class);
            Route::resource('slider', SliderController::class);
            Route::post('slider/multi', [SliderController::class, 'sliderSaveMulti'])->name('slider.saveMulti');
            Route::resource('faqs', FAQsController::class);
            Route::post('faqs/multi', [FAQsController::class, 'faqsSaveMulti'])->name('faqs.saveMulti');
            
            Route::resource('menu', MenuController::class);
            Route::post('menu/multi', [MenuController::class, 'menuSaveMulti'])->name('menu.saveMulti');
            Route::get('/backup', [BackupController::class, 'index']);
            Route::get('/backup/create', [BackupController::class, 'create']);
            Route::get('/backup/download/{file_name}', [BackupController::class, 'download']);
            Route::get('/backup/restore/{file_name}', [BackupController::class, 'restore']);
            Route::get('/backup/delete/{file_name}', [BackupController::class, 'delete']);

            Route::group(
                [
                    'namespace' => 'Sarfraznawaz2005\BackupManager\Http\Controllers',
                    'prefix' => config('backupmanager.route', 'backupmanager')
                ],
                function () {
                    // list backups
                    Route::get('/', 'BackupManagerController@index')->name('backupmanager');
            
                    // create backups
                    Route::post('create', 'BackupManagerController@createBackup')->name('backupmanager_create');
            
                    // restore/delete backups
                    Route::post('restore_delete',
                        'BackupManagerController@restoreOrDeleteBackups')->name('backupmanager_restore_delete');
            
                    // download backup
                    Route::get('download/{file}', 'BackupManagerController@download')->name('backupmanager_download');
                }
            );

        //DOKUMENTASI
            Route::get('dokumen', [dokumen::class, 'dokumenRead']);
            Route::get('documentation', function()
            {
                return view('menu.documentation.index');
            });
    });

    //OTHER
        Route::get('/tes/{id}', function ($id) {
            $post = \App\Models\User::with('roles')->find($id);
            return response()->json($post, 200);
        });

        Route::get('/tes1/{id}', function ($id) {
            $role = \App\Models\Role::with('users')->find($id);
            return response()->json($role, 200);
        });
        
        //Clear Cache facade value:
            Route::get('/clearCache', function() {
                $exitCode = Artisan::call('cache:clear');
                return '<h1>Cache facade value cleared</h1>';
            });

        //Reoptimized class loader:
            Route::get('/optimize', function() {
                $exitCode = Artisan::call('optimize');
                return '<h1>Reoptimized class loader</h1>';
            });
        
        //Route cache:
            Route::get('/routeCache', function() {
                $exitCode = \Illuminate\Support\Facades\Artisan::call('route:cache');
                return '<h1>Routes cached</h1>';
            });
        
        //Clear Route cache:
            Route::get('/routeClear', function() {
                $exitCode = Artisan::call('route:clear');
                return '<h1>Route cache cleared</h1>';
            });
        
        //Clear View cache:
            Route::get('/viewClear', function() {
                $exitCode = Artisan::call('view:clear');
                return '<h1>View cache cleared</h1>';
            });
        
        //Clear Config cache:
            Route::get('/configCache', function() {
                $exitCode = Artisan::call('config:cache');
                return '<h1>Clear Config cleared</h1>';
            });
            
        //Create Command:
            Route::get('/createCommand', function() {
                $exitCode = Artisan::call('make:command DatabaseBackUp');
                return '<h1>Create Command is Finish</h1>';
            });
            
        //Backup:
            //Route::get('/backup', function() {
                //$exitCode = \Illuminate\Support\Facades\Artisan::call('database:backup');
                //return '<h1>Databases is Backup</h1>';
            //});
            
        Route::get('generate', function (){
            \Illuminate\Support\Facades\Artisan::call('storage:link');
            echo 'ok';
        });
        
        Route::get('/symlink', function () {
           $target =$_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
           $link = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
           symlink($target, $link);
           echo "Done";
        });
        
        Route::get('foo', function(){
            Artisan::call('storage:link', []);
            return 'success';
        });

        Route::get('/linkstorage', function () {
            Artisan::call('storage:link');
        });