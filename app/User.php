<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'photo_id', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relación OneToOne Users-Roles
    public function role() {
        return $this->belongsTo('App\Role');
    }
    // Relación OneToOne Users-Photos
    public function photo() {
        return $this->belongsTo('App\Photo');
    }
}
