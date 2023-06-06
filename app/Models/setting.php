<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\slider;

class setting extends Model
{
    use HasFactory;
    
    protected $table = "frontEnd";
    protected $fillable = [
        'tittle',
        'welcome', 
        'logo',
        'favicon',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function slider()
    {
        return $this->hasMany('App\Models\slider');
    }
}
