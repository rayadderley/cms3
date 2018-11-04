<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Many-To-Many Polymorhphic Relationship to Post Model
    public function posts(){
        return $this->morphedByMany('App\Post','taggable');
    }

    // Many-To-Many Polymorhphic Relationship to Post Model
    public function videos(){
        return $this->morphedByMany('App\Video','taggable');
    }
}
