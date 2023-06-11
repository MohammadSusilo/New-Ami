<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPolines extends Model
{
    use HasFactory;

    protected $table = 'dokumen_polines';

    protected $fillable = ['unitkerja_id'];

    public function unitkerja()
    {
        return $this->belongsTo(unitKerjas::class , 'unitkerja_id');
    }
}
