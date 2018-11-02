<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Returning Views
Route::get('/', function () {
    return view('welcome');
});

// Returning Text
Route::get('/about', function () {
    return "About Page";
});

// Returning Text
Route::get('/contact', function () {
    return "Contact Page";
});

// Returning values
Route::get('/post/{id}/{name}', function ($id, $name) {
    return "This is Post ID: ". $id . " with NAME: " . $name;
});

// Naming Route example: to avoid writting a long route repeatedly
Route::get('/admin/posts/example', array('as'=>'admin.home', function () {
    $url = route('admin.home');
    return "This URL is ".$url;
}));

/*NOTES:
    php artisan route:list --- to list out the routes available in our apps using terminal 
*/

// Routing to a controller
// Route::get('/post', 'PostsController@index');

// Creating all the route for the CRUD functions (resources) in the controller
Route::resource('post', 'PostsController');

Route::get('/contacts', 'PostsController@contact');