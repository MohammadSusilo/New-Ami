<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokumenInduk extends Model
{
    use HasFactory;

    protected $table = "dokumeninduk";
    protected $fillable = [
        'name', 
        'tahun_aktif', 
        'tahun_selesai', 
        'nomor',
        'revisi',
        'lokasi',  
        'status',
        'sifatDokumen',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }
}
