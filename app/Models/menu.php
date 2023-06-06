<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\tinjauanManajemen;

class menu extends Model
{
    use HasFactory;
    
    protected $table = "menu";
    protected $fillable = [
        'name',
        'level', 
        'master',
        'url',
        'icon',
        'role_id',
        'sorting',
        'status'
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }
}
