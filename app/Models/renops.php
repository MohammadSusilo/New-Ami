<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class renops extends Model
{
    use HasFactory;

    protected $table = "renop";
    protected $fillable = [
        'kode', 
        'deskripsi', 
        'target', 
        'unit_target', 
        'tahun', 
        'status', 
        'unitkerja_id',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function unitKerja()
    {
        return $this->hasMany(unitKerjas::class, 'id', 'unitkerja_id');
    }

    public function renstra()
    {
        return $this->belongsToMany(renstras::class, 'renop_renstra', 'renop_id', 'renstra_id')->withTimestamps();
        // return $this->belongsToMany(pengelolaUnitKerja::class, 'pengelola_pimpinan', 'pengelola_id', 'pimpinan_id')->withTimestamps();
    }
    
    public function kinerjaUnit()
    {
        return $this->hasMany('App\Models\kinerjaUnit');
    }
}
