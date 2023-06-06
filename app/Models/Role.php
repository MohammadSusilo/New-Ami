<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Role;
use App\Models\User;

class Role extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'desc',
        'status',
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
