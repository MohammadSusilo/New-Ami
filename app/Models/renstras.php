<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class renstras extends Model
{
    use HasFactory;

    protected $table = "renstra";
    protected $fillable = [
        'kode', 
        'deskripsi', 
        'target', 
        'unit_target', 
        'tipe_indikator',
        'tahun', 
        'referensi', 
        'jenis',
        'status',
        'dokumen_id',        
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function dokumenInduk()
    {
        return $this->belongsTo('App\Models\dokumenInduk', 'dokumen_id', 'id');
    }
    
    public function renop()
    {
        return $this->belongsToMany(renops::class, 'renop_renstra', 'renstra_id', 'renop_id')->withTimestamps();
        // return $this->belongsToMany(pengelolaUnitKerja::class, 'pengelola_pimpinan', 'pengelola_id', 'pimpinan_id')->withTimestamps();
    }
}
