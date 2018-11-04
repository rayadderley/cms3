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
        // Following the Name Convention, no need to set parameter
        return $this->belongsToMany('App\Role')->withPivot('created_at'); // Need to withPivot right here if you want to access the Pivot table.
        
        // With different table name (not following the convention), you can setup it in the parameter of belongsToMany like this:
        // eg return $this->belongsToMany('App\Role', 'pivot_table_name', 'foreign_key_in_pivot_table', 'foreign_key_referring_to_other_table');
        // eg return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
    }
}
