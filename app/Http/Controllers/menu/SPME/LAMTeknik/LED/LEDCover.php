<?php

namespace App\Http\Controllers\menu\SPME\LAMTeknik\LED;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;
use File;

use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDCover;
use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDCoverUPPS;
use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDCoverLampiran;

class LEDCover extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        try{
            // $this->validate($request, [
            //     'uk_id' => 'required',
            //     'pendahuluan' => 'required'
            // ]);

            // $cover = LAMTeknikLEDCover::create($request->all());
            // $data1 = LAMTeknikLEDCover::create($request->all());

            $data1 = new LAMTeknikLEDCover();

            $data1->uk_id = $request->uk_id;
            $data1->namaPT = $request->namaPT;
            $data1->kotaPT = $request->kotaPT;
            $data1->tahun = $request->tahun;
    
            $data1->upps = $request->upps;
            $data1->jenis_ps = $request->jenis_ps;
            $data1->alamat = $request->alamat;
            $data1->telp = $request->telp;
            $data1->email_web = $request->email_web;
            $data1->sk_pt = $request->sk_pt;
            $data1->tgl_sk_pt = $request->tgl_sk_pt;
            $data1->pp_sk_pt = $request->pp_sk_pt;
            $data1->sk_ps = $request->sk_ps;
            $data1->tgl_sk_ps = $request->tgl_sk_ps;
            $data1->pp_sk_ps = $request->pp_sk_ps;
            $data1->th_awal = $request->th_awal;
            $data1->akre_ps = $request->akre_ps;
            $data1->sk_terakhir = $request->sk_terakhir;
            
            $data1->nama_pys1 = $request->nama_pys1;
            $data1->nidn_pys1 = $request->nidn_pys1;
            $data1->jabatan_pys1 = $request->jabatan_pys1;
            $data1->tgl_pya1 = $request->tgl_pya1;
            $data1->ttd_pys1 = $request->ttd_pys1;

            $data1->nama_pys2 = $request->nama_pys2;
            $data1->nidn_pys2 = $request->nidn_pys2;
            $data1->jabatan_pys2 = $request->jabatan_pys2;
            $data1->tgl_pya2 = $request->tgl_pya2;
            $data1->ttd_pys2 = $request->ttd_pys2;

            $data1->nama_pys3 = $request->nama_pys3;
            $data1->nidn_pys3 = $request->nidn_pys3;
            $data1->jabatan_pys3 = $request->jabatan_pys3;
            $data1->tgl_pya3 = $request->tgl_pya3;
            $data1->ttd_pys3 = $request->ttd_pys3;

            $data1->nama_pys4 = $request->nama_pys4;
            $data1->nidn_pys4 = $request->nidn_pys4;
            $data1->jabatan_pys4 = $request->jabatan_pys4;
            $data1->tgl_pya4 = $request->tgl_pya4;
            $data1->ttd_pys4 = $request->ttd_pys4; 

            $data1->kata_pengantar = $request->kt_pengantar;
            $data1->ringkasan = $request->ringkasan_eks;

            //ARRAY
            if( $data1->save()){
                $data['jenis_pro_input']=$request->jenis_pro_input;
                $data['nama_pro_input']=$request->nama_pro_input;
                $data['status_input']=$request->status_input;
                $data['sk_input']=$request->sk_input;
                $data['tgl_kadaluarsa_input']=$request->tgl_kadaluarsa_input;
                $data['jum_mhs_input']=$request->jum_mhs_input;
        
                $cek=count($data['jenis_pro_input']);        
                $arr=[];
                $id_get=$data1->id;
                for($i=1;$i<=$cek;$i++){
                    $list['led_cover_id']=$id_get;
                    $list['jp_upps']=$data['jenis_pro_input'][$i];
                    $list['prodi_upps']=$data['nama_pro_input'][$i];
                    $list['status']=$data['status_input'][$i];
                    $list['no_tgl_sk']=$data['sk_input'][$i];
                    $list['tgl_kdw']=$data['tgl_kadaluarsa_input'][$i];
                    $list['jml_mhs']=$data['jum_mhs_input'][$i];
                    array_push($arr,$list);
                }
                $upps = LAMTeknikLEDCoverUPPS::insert($arr);

                if($upps){
                    $data['lampiran']=$request->lampiran;
    
                    $cek=count($data['lampiran']);        
                    $arr=[];
                    $id_get=$data1->id;
                    for($i=1;$i<=$cek;$i++){
                        $list['led_cover_id']=$id_get;
                        $list['lampiran']=$data['lampiran'][$i];
                        array_push($arr,$list);
                    }
                    LAMTeknikLEDCoverLampiran::insert($arr);
                }
            }
            //END ARRAY

            return redirect(url("LAMTeknik/LED/Cover/".$data1->uk_id))->with('success', 'Data Cover Laporan Evaluasi Diri telah dibuat');
            // return redirect()->back()->with('success', 'LED Cover berhasil ditambah');
            // return redirect()->route('LAMTeknik.index')->with('success', 'LED Pendahuluan berhasil ditambah');
                    
        }catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    public function show($id)
    {
        //
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
