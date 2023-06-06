<?php

namespace App\Models\SPME;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\unitKerjas;
use App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDPendahuluan;

class SPME extends Model
{
    use HasFactory;
    
    protected $table = "kinerja_unit";
    protected $fillable = [
        'uk_id', 
        'pendahuluan',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function LAMTeknikLEDPendahuluan()
    {
        return $this->belongsTo(LAMTeknikLEDPendahuluan::class,'led_pendahuluan_id', 'id');
    }
}
