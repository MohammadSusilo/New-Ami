<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPolines extends Model
{
    use HasFactory;

    public function unitkerja()
    {
        return $this->belongsTo(unitKerjas::class);
    }
}
