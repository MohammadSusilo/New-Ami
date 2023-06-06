<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\jadwalAudit;

class tinjauanManajemen extends Model
{
    use HasFactory;

    
    protected $table = "tinjauan_manajemen";
    protected $fillable = [
        'tahun', 
        'tglTM', 
        'waktuTM', 
        'status', 
        'audit_id',
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

    public function hasilRapatTM()
    {
        return $this->hasMany('App\Models\hasilRapatTM');
    }

    public function bahanRapatTM()
    {
        return $this->hasMany('App\Models\bahanRapatTM');
    }
}
