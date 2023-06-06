<?php

namespace App\Models\SPME\LAMTeknik\LED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDCover;

class LAMTeknikLEDCoverUPPS extends Model
{
    use HasFactory;
    
    protected $table = "led_cover_upps";
    protected $fillable = [
        'led_cover_id', 
        'jp_upps',
        'prodi_upps',
        'status',
        'no_tgl_sk',
        'tgl_kdw',
        'jml_mhs'
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function LAMTeknikLEDCover()
    {
        return $this->belongsTo(LAMTeknikLEDCover::class,'led_cover_id', 'id');
    }
}
