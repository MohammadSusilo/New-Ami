<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokumenChecklist extends Model
{
    use HasFactory;

    protected $table = "dokumencheklist";
    protected $fillable = [
        'name', 
        'tahun', 
        'lokasi', 
        'name', 
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
        return $this->belongsTo(unitKerja::class,'unitkerja_id', 'id');
    }
}
