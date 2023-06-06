<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    protected $table = "profile";
    protected $fillable = [
        // 'name',
        'jabatan',
        'foto',
        'signature',
        'user_id',
        // 'status',
    ];

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at->format('d F Y');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
