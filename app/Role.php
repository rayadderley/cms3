<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    /**
     * User has many Role - that is why belongsToMany here
     */
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
