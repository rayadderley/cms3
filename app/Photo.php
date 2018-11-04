<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Creating Photo Model for Polymorphic Relationship
class Photo extends Model
{
    /*public function imageable(){
        return $this->belongsTo('App\Post');
    }*/

    /*public function photos(){
        return $this->morphMany('App\Photo', 'imageable');
    }*/

    // This is what enable the Photo Model to be related to User & Post
    public function imageable(){
        return $this->morphTo();
    }
}
