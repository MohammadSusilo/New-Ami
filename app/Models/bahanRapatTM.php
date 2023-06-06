<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\tinjauanManajemen;

class bahanRapatTM extends Model
{
    use HasFactory;
    
    protected $table = "bahan_rapattm";
    protected $fillable = [
        'deskripsi', 
        'car_id',
        'status', 
        'tm_id',
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
}
