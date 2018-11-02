<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Use SoftDeletes library/class

/**
 * NOTES: CREATING MODEL
 * php artisan make:model Post (name of the model should be singular - the table name is read as posts; all lowercase and plural)
 */
class Post extends Model
{
    use SoftDeletes; // Need to place right here to use SoftDelete

    // telling the framework that the table name is posts if the Model name is odd (eg; PostAdmin - read as postadmins table)
    // protected $table = 'posts';

    // telling the framework the primary key of the table
    // protected $primaryKey = 'post_id';

    // This is dates when deleted
    protected $dates = ['deleted_at'];

    // Enable Mass Assignment (assigning multiple values during creation of data -- see example in route file)
    protected $fillable = [
        'title',
        'content'
    ];
}
