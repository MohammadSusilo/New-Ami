<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class jadwalAudit extends Model
{
    use HasFactory;

    protected $table = "jadwal_audit";
    protected $fillable = [
        'periode', 
        'tahun', 
        'tglAudit', 
        'waktu', 
        'status', 
        'unitkerja_id',
        // 'user_id',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_jadwalaudit', 'jadwal_id', 'user_id')->withTimestamps();
        // return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function laporanAudit()
    {
        return $this->hasMany('App\Models\laporanAudit');
    }

    public function tinjauanManajemen()
    {
        return $this->hasOne('App\Models\tinjauanManajemen');
    }
}
