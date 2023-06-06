<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\unitKerjas;

//Master Data
use App\Models\renstras;
use App\Models\renops;
use App\Models\kinerjaUnit;
use App\Models\buktiKinerja;
use App\Models\dokumenInduk;
use App\Models\pimpinans;
use App\Models\dokumenChecklist;
use App\Models\pengelolaUnitKerja;

//AMI
use App\Models\CAR;
use App\Models\jadwalAudit;
use App\Models\laporanAudit;

//Tinjauan Manajemen
use App\Models\hasilRapatTM;
use App\Models\bahanRapatTM;
use App\Models\tindakLanjutTM;
use App\Models\tinjauanManajemen;

class WelcomeController extends Controller
{
    public function index()
    {
        $dokInduks = dokumenInduk::where('sifatDokumen', 'public')->orderBy('created_at', 'desc')->get();
        $tile = [
            'users' => User::get()->count(),
            'renop' => renops::get()->count(),
            'renstra' => renstras::get()->count(),
            'pimpinan' => pimpinans::get()->count(),
            'unitKerja' => unitKerjas::get()->count(),
            'dokInduk' => dokumenInduk::get()->count(),
            'dokChecklist' => dokumenChecklist::get()->count(),
            'pengelola' => pengelolaUnitKerja::get()->count(),
            'jadwalAudit' => jadwalAudit::get()->count(),
            'laporanAudit' => laporanAudit::get()->count(),
            'CAR' => CAR::get()->count(),
            'jadwalTM' => tinjauanManajemen::get()->count(),
            'hasilTM' => hasilRapatTM::get()->count(),
            'bahanTM' => bahanRapatTM::get()->count(),
            'tindakTM' => tindakLanjutTM::get()->count(),
        ];

        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $tahun = \Carbon\Carbon::now()->format('Y');

        for($bulan=1;$bulan < 13;$bulan++){
            $allrens = collect(DB::SELECT("SELECT count(id) AS jumlah from renstra where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
            $renstra[] = $allrens->jumlah;

            $allrenp = collect(DB::SELECT("SELECT count(id) AS jumlah from renop where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
            $renop[] = $allrenp->jumlah;

            $alldokInd = collect(DB::SELECT("SELECT count(id) AS jumlah from dokumeninduk where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
            $dokInduk[] = $alldokInd->jumlah;

            $alldokCheck = collect(DB::SELECT("SELECT count(id) AS jumlah from dokumencheklist where month(created_at)='$bulan' AND year(created_at)='$tahun'"))->first();
            $dokCheck[] = $alldokCheck->jumlah;

            $alljadwalAudit = collect(DB::SELECT("SELECT count(id) AS jumlah from jadwal_audit where month(tglAudit)='$bulan' AND year(tglAudit)='$tahun'"))->first();
            $jadwalAudit[] = $alljadwalAudit->jumlah;
            
            $getAll = laporanAudit::with('jadwalAudit')->get();
            $alllaporanAudit = 0;
            foreach($getAll as $getAllh){
                if(date("m", strtotime($getAllh->jadwalAudit->tglAudit)) == $bulan AND date("Y", strtotime($getAllh->jadwalAudit->tglAudit)) == $tahun){
                    $alllaporanAudit++;
                }
            }
            
            $laporanAudit[] = $alllaporanAudit;

            $getAll = CAR::with('laporanAudit')->get();
            $allCAR = 0;
            foreach($getAll as $getAllh){
                if(date("m", strtotime($getAllh->laporanAudit->jadwalAudit->tglAudit)) == $bulan AND date("Y", strtotime($getAllh->laporanAudit->jadwalAudit->tglAudit)) == $tahun){
                    $allCAR++;
                }
            }
            
            $CAR[] = $allCAR;

            $alljadwalTM = collect(DB::SELECT("SELECT count(id) AS jumlah from tinjauan_manajemen where month(tglTM)='$bulan' AND year(tglTM)='$tahun'"))->first();
            $jadwalTM[] = $alljadwalTM->jumlah;


            $getAll = hasilRapatTM::with('tinjauanManajemen')->get();
            $allhasilTM = 0;
            foreach($getAll as $getAllh){
                if(date("m", strtotime($getAllh->tinjauanManajemen->tglTM)) == $bulan AND date("Y", strtotime($getAllh->tinjauanManajemen->tglTM)) == $tahun){
                    $allhasilTM++;
                }
            }
            
            $hasilTM[] = $allhasilTM;

            $getAll = bahanRapatTM::with('tinjauanManajemen')->get();
            $allbahanTM = 0;
            foreach($getAll as $getAllh){
                if(date("m", strtotime($getAllh->tinjauanManajemen->tglTM)) == $bulan AND date("Y", strtotime($getAllh->tinjauanManajemen->tglTM)) == $tahun){
                    $allbahanTM++;
                }
            }
            
            $bahanTM[] = $allbahanTM;

            $getAll = tindakLanjutTM::with('hasilRapatTM')->get();
            $alltindakTM = 0;
            foreach($getAll as $getAllh){
                if(date("m", strtotime($getAllh->hasilRapatTM->tinjauanManajemen->tglTM)) == $bulan AND date("Y", strtotime($getAllh->hasilRapatTM->tinjauanManajemen->tglTM)) == $tahun){
                    $alltindakTM++;
                }
            }
            
            $tindakTM[] = $alltindakTM;
            
        }

        $frontEnd = DB::table('frontEnd')->first();
        $banners = DB::table('frontEnd_banner')->where('status', 'aktif')->get();
        $first = DB::table('frontEnd_banner')->where('status', 'aktif')->latest()->first()->id;
        $FAQs = DB::table('faqs')->where('status', 'aktif')->orderBy('urutan', 'ASC')->get();
        
        // $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));
        // $files = $disk->files('/AMI/');
        // $files = public_path('storage/files/Pusat/PPMP/Dokumen Induk');
        // dd($files);
        // $dokInduk = [];
        // foreach ($files as $k => $f) {
        //   if (substr($f, -4) == '.zip' && $disk->exists($f)) {
        //         $dokInduk[] = [
        //             'file_path' => $f,
        //         //   'file_name' => str_replace(config('laravel-backup.backup.name') . 'AMI/', '', $f),
        //           'file_size' => $disk->size($f),
        //           'last_modified' => $disk->lastModified($f),
        //         ];
        //     }
        // }
        // dd($dokInduk);

        return view('welcome', compact('tile', 'label', 'renstra', 'renop', 'dokInduks', 'dokInduk', 'dokCheck', 'jadwalAudit', 'laporanAudit', 'CAR', 'jadwalTM', 'hasilTM', 'bahanTM', 'tindakTM', 'frontEnd', 'banners', 'FAQs', 'first'));
    }
}
