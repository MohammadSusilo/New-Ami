<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\kinerjaUnit;

class buktiKinerja extends Model
{
    use HasFactory;
    
    
    protected $table = "bukti_kinerja";
    protected $fillable = [
        'namaBukti', 
        'tahun', 
        'lokDokBukti', 
        'deskripsi', 
        'status', 
        'unitkerja_id',
        'renop_id',
        'kinerjaUnit_id',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function kinerjaUnit()
    {
        return $this->belongsTo(kinerjaUnit::class,'kinerjaUnit_id', 'id');
    }
}
