<?php

namespace App\Models\SPME\LAMTeknik\LED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\unitKerjas;

class LAMTeknikLEDCover extends Model
{
    use HasFactory;
    
    protected $table = "led_cover";
    protected $fillable = [
        'uk_id', 
        'namaPT',
        'kotaPT',
        'tahun',
        'upps',
        'jenis_ps',
        'alamat',
        'telp',
        'email_web',
        'sk_pt',
        'tgl_sk_pt',
        'pp_sk_pt',
        'sk_ps',
        'tgl_sk_ps',
        'pp_sk_ps',
        'th_awal',
        'akre_ps',
        'sk_terakhir',
        'lamp_skppt',
        'lamp_skpps',
        'lamp_skapst',
        'nama_pys1',
        'nidn_pys1',
        'jabatan_pys1',
        'tgl_pya1',
        'ttd_pys1',
        'nama_pys2',
        'nidn_pys2',
        'jabatan_pys2',
        'tgl_pya2',
        'ttd_pys2',
        'nama_pys3',
        'nidn_pys3',
        'jabatan_pys3',
        'tgl_pya3',
        'ttd_pys3',
        'nama_pys4',
        'nidn_pys4',
        'jabatan_pys4',
        'tgl_pya4',
        'ttd_pys4',
        'kata_pengantar',
        'ringkasan'
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function unitKerjas()
    {
        return $this->belongsTo(unitKerjas::class,'uk_id', 'id');
    }

    public function SPME()
    {
        return $this->hasMany('App\Models\SPME\LAMTeknik\SPME');
    }

    public function LAMTeknikLEDCoverUPPS()
    {
        return $this->hasMany('App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDCoverUPPS');
    }
    
}
