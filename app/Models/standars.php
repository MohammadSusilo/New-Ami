<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\standars;

class standars extends Model
{
    use HasFactory;

    protected $table = "standar";
    protected $fillable = [
        'kodeStandar',
        'namaStandar',
        'kriteria',
    ];

    public function laporanAudit()
    {
        return $this->hasMany('App\Models\laporanAudit');
    }
}
