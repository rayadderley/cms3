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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The name of function to create relationship with Post Model (One-To-One)
     */
    public function post(){
        // One-to-One Relationship
        return $this->hasOne('App\Post'); // This will refer to user_id
        // return $this->hasOne('App\Post', 'FK in posts table', 'PK in posts table');  -- if you have different name in Post Model
    }

    /**
     * The name of function to create relationship with Post Model (One-To-Many)
     */
    public function posts(){
        return $this->hasMany('App\Post');
    }

    /**
     * Role has many User - that is why belongsToMany here
     */
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
}
