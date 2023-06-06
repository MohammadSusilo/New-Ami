<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pimpinans extends Model
{
    use HasFactory;

    protected $table = "pimpinan";

    protected $fillable = [
        'name', 
        'status',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function pengelola()
    {
        return $this->belongsToMany(pengelolaUnitKerja::class, 'pengelola_pimpinan', 'pimpinan_id', 'pengelola_id')->withTimestamps();
        // return $this->belongsToMany('App\Models\pengelola');
    }
}
