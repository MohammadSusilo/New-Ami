<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\setting;

class slider extends Model
{
    use HasFactory;
    
    protected $table = "frontEnd_banner";
    protected $fillable = [
        'name',
        'deskripsi', 
        'path',
        'status', 
        'frontend_id',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function setting()
    {
        return $this->belongsTo(setting::class,'frontend_id', 'id');
    }
}
