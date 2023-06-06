<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\LAMTeknik;
use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDPendahuluan;
use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDKondisiEksternal;
use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDProfilUPPS;
use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDPenjaminanMutu;
use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDPengembanganBerkelanjutan;
use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDPenutup;

use App\Models\unitKerjas;
use App\Models\dokumenInduk;
use App\Models\dokumenChecklist;

class LAMTeknikController extends Controller
{
    public function index()
    {
        if(auth()->user()->role_id == 1){
            $unitKerja = unitKerjas::get();
            return view('menu.spme.LAMTeknik.index', compact('unitKerja'));
        }else{
            $id = auth()->user()->unitkerja_id;
            return redirect()->route('LAMTeknik.show', $id);
        }

    }

    public function LEDCoverIndex($id)
    {
        $unitKerja = $id;
        $unitKerjas = unitKerjas::get();
        
        if(auth()->user()->role_id == 1){
            $dokchecklist = dokumenChecklist::where('unitkerja_id', $id)->get();
        }else{
            $dokchecklist = dokumenChecklist::where('unitkerja_id', auth()->user()->unitkerja_id)->get();
        }
        return view('menu.spme.LAMTeknik.LED.Cover.index', compact('unitKerja', 'unitKerjas', 'dokchecklist'));
    }

    public function LEDBAB1Index($id)
    {
        $unitKerja = $id;
        
        if(auth()->user()->role_id == 1){
            $LAMTeknikLEDPendahuluan = LAMTeknikLEDPendahuluan::where('uk_id', $id)->first();
        }else{
            $LAMTeknikLEDPendahuluan = LAMTeknikLEDPendahuluan::where('uk_id', auth()->user()->unitkerja_id)->first();
        }

        return view('menu.spme.LAMTeknik.LED.BAB1.index', compact('unitKerja', 'LAMTeknikLEDPendahuluan'));
    }

    public function LEDBAB2StrukturIndex()
    {
        return view('menu.spme.LAMTeknik.LED.BAB2.Struktur.index');
    }

    public function LEDBAB2KondisiEksternalIndex($id)
    {
        $unitKerja = $id;
        
        if(auth()->user()->role_id == 1){
            $LAMTeknikLEDKondisiEksternal = LAMTeknikLEDKondisiEksternal::where('uk_id', $id)->first();
        }else{
            $LAMTeknikLEDKondisiEksternal = LAMTeknikLEDKondisiEksternal::where('uk_id', auth()->user()->unitkerja_id)->first();
        }
        return view('menu.spme.LAMTeknik.LED.BAB2.KondisiEksternal.index', compact('unitKerja', 'LAMTeknikLEDKondisiEksternal'));
    }

    public function LEDBAB2ProfilUPPSIndex($id)
    {
        $unitKerja = $id;
        
        if(auth()->user()->role_id == 1){
            $LAMTeknikLEDProfilUPPS = LAMTeknikLEDProfilUPPS::where('uk_id', $id)->first();
        }else{
            $LAMTeknikLEDProfilUPPS = LAMTeknikLEDProfilUPPS::where('uk_id', auth()->user()->unitkerja_id)->first();
        }
        return view('menu.spme.LAMTeknik.LED.BAB2.ProfilUPPS.index', compact('unitKerja', 'LAMTeknikLEDProfilUPPS'));
    }

    public function LEDBAB2Kriteria1Index()
    {
        return view('menu.spme.LAMTeknik.LED.BAB2.Kriteria.K1.index');
    }

    public function LEDBAB2Kriteria2Index()
    {
        return view('menu.spme.LAMTeknik.LED.BAB2.Kriteria.K2.index');
    }

    public function LEDBAB2Kriteria3Index()
    {
        return view('menu.spme.LAMTeknik.LED.BAB2.Kriteria.K3.index');
    }

    public function LEDBAB2Kriteria4Index()
    {
        return view('menu.spme.LAMTeknik.LED.BAB2.Kriteria.K4.index');
    }

    public function LEDBAB2Kriteria5Index()
    {
        return view('menu.spme.LAMTeknik.LED.BAB2.Kriteria.K5.index');
    }

    public function LEDBAB2Kriteria6Index()
    {
        return view('menu.spme.LAMTeknik.LED.BAB2.Kriteria.K6.index');
    }

    public function LEDBAB2Kriteria7Index()
    {
        return view('menu.spme.LAMTeknik.LED.BAB2.Kriteria.K7.index');
    }

    public function LEDBAB2Kriteria8Index()
    {
        return view('menu.spme.LAMTeknik.LED.BAB2.Kriteria.K8.index');
    }

    public function LEDBAB2Kriteria9Index()
    {
        return view('menu.spme.LAMTeknik.LED.BAB2.Kriteria.K9.index');
    }

    public function LEDBAB3Index($id)
    {
        $unitKerja = $id;
        
        if(auth()->user()->role_id == 1){
            $LAMTeknikLEDPenjaminanMutu = LAMTeknikLEDPenjaminanMutu::where('uk_id', $id)->first();
        }else{
            $LAMTeknikLEDPenjaminanMutu = LAMTeknikLEDPenjaminanMutu::where('uk_id', auth()->user()->unitkerja_id)->first();
        }
        return view('menu.spme.LAMTeknik.LED.BAB3.index', compact('unitKerja', 'LAMTeknikLEDPenjaminanMutu'));
    }

    public function LEDBAB4Index($id)
    {
        $unitKerja = $id;
        
        if(auth()->user()->role_id == 1){
            $LAMTeknikLEDPengembanganBerkelanjutan = LAMTeknikLEDPengembanganBerkelanjutan::where('uk_id', $id)->first();
        }else{
            $LAMTeknikLEDPengembanganBerkelanjutan = LAMTeknikLEDPengembanganBerkelanjutan::where('uk_id', auth()->user()->unitkerja_id)->first();
        }
        return view('menu.spme.LAMTeknik.LED.BAB4.index', compact('unitKerja', 'LAMTeknikLEDPengembanganBerkelanjutan'));
        // return view('menu.spme.LAMTeknik.LED.BAB4.index');
    }

    public function LEDBAB5Index($id)
    {
        $unitKerja = $id;
        
        if(auth()->user()->role_id == 1){
            $LAMTeknikLEDPenutup = LAMTeknikLEDPenutup::where('uk_id', $id)->first();
        }else{
            $LAMTeknikLEDPenutup = LAMTeknikLEDPenutup::where('uk_id', auth()->user()->unitkerja_id)->first();
        }
        return view('menu.spme.LAMTeknik.LED.BAB5.index', compact('unitKerja', 'LAMTeknikLEDPenutup'));
        // return view('menu.spme.LAMTeknik.LED.BAB5.index');
    }

    public function LEDLampiranIndex()
    {
        return view('menu.spme.LAMTeknik.LED.Lampiran.index');
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
        $idku = $id;

        $countAllPendahuluan = LAMTeknikLEDPendahuluan::where('uk_id',$idku)->count();
        $countCheckPendahuluanNN = LAMTeknikLEDPendahuluan::where('uk_id',$idku)->where('pendahuluan','!=','')->count();
        $countCheckPendahuluanN = LAMTeknikLEDPendahuluan::where('uk_id',$idku)->where('pendahuluan','=','')->count();

        $countAllKondisiEksternal = LAMTeknikLEDKondisiEksternal::where('uk_id',$idku)->count();
        $countCheckKondisiEksternalNN = LAMTeknikLEDKondisiEksternal::where('uk_id',$idku)->where('des','!=','')->count();
        $countCheckKondisiEksternalN = LAMTeknikLEDKondisiEksternal::where('uk_id',$idku)->where('des','=','')->count();

        $countAllProfilUPPS = LAMTeknikLEDProfilUPPS::where('uk_id',$idku)->count();
        $countCheckProfilUPPSNN = LAMTeknikLEDProfilUPPS::where('uk_id',$idku)->where('des','!=','')->count();
        $countCheckProfilUPPSN = LAMTeknikLEDProfilUPPS::where('uk_id',$idku)->where('des','=','')->count();

        return view('menu.spme.LAMTeknik.list', compact('idku', 
        'countAllPendahuluan', 'countCheckPendahuluanNN', 'countCheckPendahuluanN', 
        'countAllKondisiEksternal', 'countCheckKondisiEksternalNN', 'countCheckKondisiEksternalN',
        'countAllProfilUPPS', 'countCheckProfilUPPSNN', 'countCheckProfilUPPSN'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
