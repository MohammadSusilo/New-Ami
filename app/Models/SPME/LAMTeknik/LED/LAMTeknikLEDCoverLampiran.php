<?php

namespace App\Models\SPME\LAMTeknik\LED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDCover;

class LAMTeknikLEDCoverLampiran extends Model
{
    use HasFactory;
    
    protected $table = "led_cover_lampiran";
    protected $fillable = [
        'led_cover_id', 
        'lampiran'
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
