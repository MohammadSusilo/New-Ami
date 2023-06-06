<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\jadwalAudit;
use App\Models\standars;

class laporanAudit extends Model
{
    use HasFactory;

    protected $table = "laporan_audit";
    protected $fillable = [
        'kategoriTemuan', 
        'uraianTemuan', 
        'saranPerbaikan',
        'audit_id',
        'standar_id', 
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function jadwalAudit()
    {
        return $this->belongsTo(jadwalAudit::class,'audit_id', 'id');
    }

    public function standars()
    {
        return $this->belongsTo(standars::class,'standar_id', 'id');
    }

    public function CAR()
    {
        return $this->hasMany('App\Models\CAR');
    }

}
