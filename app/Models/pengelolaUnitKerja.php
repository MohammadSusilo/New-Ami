<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class pengelolaUnitKerja extends Model
{
    use HasFactory;

    protected $table = "pengelolaunitkerja";
    
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

    public function unitKerja()
    {
        return $this->hasMany('App\Models\unitKerja');
    }

    public function pimpinan()
    {
        return $this->belongsToMany(pimpinans::class, 'pengelola_pimpinan', 'pengelola_id', 'pimpinan_id')->withTimestamps();
        // return $this->belongsToMany('App\Models\pimpinans');
    }

    // public function pengelola_pimpinan()
    // {
    //     // protected $table = "pengelola_pimpinan";

    //     // protected $fillable = ['pimpinan_id', 'pengelola_id'];
    // }

}