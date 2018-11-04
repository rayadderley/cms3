<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    // Many-To-Many Polymorphic relationship with Tag
    public function tags(){
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
