<?php

namespace App\Models\SPME\LAMTeknik\LED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\unitKerjas;

class LAMTeknikLEDProfilUPPS extends Model
{
    use HasFactory;
    
    protected $table = "led_upps";
    protected $fillable = [
        'uk_id', 
        'des',
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
