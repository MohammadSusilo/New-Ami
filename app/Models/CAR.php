<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\laporanAudit;

class CAR extends Model
{
    use HasFactory;

    protected $table = "car";
    protected $fillable = [
        'analisiPenyebabMasalah', 
        'tindakanPenyelesaian', 
        'tindakanPencegahan', 
        'hasilPemeriksaan', 
        'rekomendasi',
        'status', 
        'is_bahanTM',
        'laporanaudit_id',
        'acc',
        'file',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function laporanAudit()
    {
        return $this->belongsTo(laporanAudit::class,'laporanaudit_id', 'id');
    }

}
