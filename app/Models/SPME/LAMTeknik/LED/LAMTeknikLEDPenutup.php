<?php

namespace App\Models\SPME\LAMTeknik\LED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\unitKerjas;

class LAMTeknikLEDPenutup extends Model
{
    use HasFactory;
    
    protected $table = "led_penutup";
    protected $fillable = [
        'uk_id', 
        'penutup',
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
}
