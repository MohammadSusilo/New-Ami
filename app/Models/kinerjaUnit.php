<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\renops;

class kinerjaUnit extends Model
{
    use HasFactory;
    
    protected $table = "kinerja_unit";
    protected $fillable = [
        'nilaiCapaian', 
        'tahun', 
        'unitCapaian', 
        'deskripsi', 
        'status', 
        'unitkerja_id',
        'renop_id',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function renops()
    {
        return $this->belongsTo(renops::class,'renop_id', 'id');
    }

    public function buktiKinerja()
    {
        return $this->hasMany('App\Models\buktiKinerja');
    }
}
