<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\tinjauanManajemen;
use App\Models\tindakLanjutTM;

class hasilRapatTM extends Model
{
    use HasFactory;

    protected $table = "hasil_rapattm";
    protected $fillable = [
        'subjek', 
        'uraian', 
        'hasilPembahasan',
        'hadir',
        'tidakHadir',
        'status', 
        'tm_id',
        'bahan_id',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function tinjauanManajemen()
    {
        return $this->belongsTo(tinjauanManajemen::class,'tm_id', 'id');
    }

    public function tindakLanjutTM()
    {
        // return $this->hasMany(tindakLanjutTM::class, 'id', 'hslrpt_id');
        return $this->hasMany('App\Models\tindakLanjutTM');
    }
}
