<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\jadwalAudit;
use App\Models\Role;
use App\Models\User;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'unitkerja_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        // return $this->belongsTo('App\Models\Role');
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function unitKerja()
    {
        // return $this->belongsTo('App\Models\unitKerjas');
        return $this->belongsTo(unitKerjas::class, 'unitkerja_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\profile');
    }

    public function jadwalAudit()
    {
        // return $this->hasMany('App\Models\jadwalAudit');
        // return $this->hasMany(jadwalAudit::class);
        return $this->belongsToMany(jadwalAudit::class, 'users_jadwalaudit', 'user_id', 'jadwal_id')->withTimestamps();
    }

}
