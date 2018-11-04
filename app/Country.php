<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // Function to pull posts from Country (Through Relationship)
    // Through Relationship - User Create Post, User live in a Country. Get Post by Country (not directly related)
    public function posts(){
        /** hasManyThrough 
         * First Parameter: FIRST TABLE Used (Post), 
         * Second Parameter: SECOND TABLE Used (User), 
         * Third Parameter: Country ID in User Table (FK to THIS Country Table),
         * Fourth Parameter: User ID in Post Table (FK in FIRST TABLE referring to SECOND TABLE)
         * 
         * eg; return $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'user_id');
        */ 

        //return $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'user_id');
        return $this->hasManyThrough('App\Post', 'App\User');
        
    }
}
