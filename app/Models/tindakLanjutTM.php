<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\hasilRapatTM;

class tindakLanjutTM extends Model
{
    use HasFactory;

    
    protected $table = "tindak_lanjuttm";
    protected $fillable = [
        'tindakLanjut', 
        'realisasi',
        'PIC', 
        'status', 
        'hslrpt_id',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function hasilRapatTM()
    {
        return $this->belongsTo(hasilRapatTM::class,'hslrpt_id', 'id');
    }
}
