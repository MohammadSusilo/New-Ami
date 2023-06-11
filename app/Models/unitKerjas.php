<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unitKerjas extends Model
{
    use HasFactory;

    protected $table = "unitkerja";
    protected $fillable = [
        'name',
        'namaRepo',
        'status',
        'pengelola_id',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function dokumenChecklist()
    {
        return $this->hasMany('App\Models\dokumenChecklist');
    }

    public function pengelolaUnitKerja()
    {
        return $this->belongsTo(pengelolaUnitKerja::class, 'pengelola_id', 'id');
    }

    public function renop()
    {
        return $this->belongsTo(renops::class, 'unitkerja_id', 'id');
    }

    public function LAMTeknikLEDCover()
    {
        return $this->hasMany('App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDCover');
    }

    public function LAMTeknikLEDPendahuluan()
    {
        return $this->hasMany('App\Models\SPME\LAMTeknik\LED\LAMTeknikLEDPendahuluan');
    }

    public function DokumenPolines()
    {
        return $this->hasMany(DokumenPolines::class , 'unitkerja_id');
    }
}
