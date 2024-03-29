<?php
use App\Post; // Use the Post Model to enable eloquent.
use App\User; // Use the User Model to enable eloquent.
use App\Role;
use App\Country;
use App\Photo;
use App\Tag;

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

/**
 * ----------------------------------------
 * ELOQUENT EXAMPLE
 * ----------------------------------------
 */

// Function to read all the record inside Post table
Route::get('/read', function(){
    // $posts = App\Post;

    // Get all the information from Post Model (table)
    $posts = Post::all();
    return $posts;

    foreach($posts as $post){
        return $post->title;
    }
});

// Function to find based on ID provided
Route::get('/find', function(){
    // Get all the information from Post Model (table)
    $post = Post::find(2);
    return $post->title;
});

// Function to find based on WHERE clause
Route::get('/findwhere', function(){
    $post = Post::where('id',2)->orderBy('id','desc')->take(1)->get();
    return $post;
});

/**
 * NOTES: MORE WAYS TO RETRIEVE DATA
 * Post::findOrFail(2); -- Try to find record with ID 2, if not available a NotFoundHttpException error will be displayed
 * Post::where('users_count', '<', 50)->firstOrFail(); -- where clause together with firstOrFail
 */


 // Insert a new post using Eloquent
 Route::get('/basicinsert', function(){
    
    // Create a new Post
    $post = new Post();

    // You can also find a specific row by ID and update it
    // $post = Post::find(2);

    // Assign values to the columns
    $post->title = "New Eloqnet title insert";
    $post->content = "Wow eloquent is really cool";
    
    // Insert all the values assigned previously
    $post->save();
 });


 // Creating Data and configuring mass assignment
 Route::get('/createmassassignment', function(){
    Post::create(
        [
            'title'=>'Title 4',
            'content'=>'Content 4'
        ]);
 });

 // Update Data -- Different from Inserting and saving the new assigned value
 Route::get('/updatewitheloquent', function(){
     Post::where('id', 2)->where('is_admin', 0)->update([
         'title'=>'NEW TITLE',
         'content'=>'NEW CONTENT'
     ]);
 });

/**
 * NOTES: DELETE USING ELOQUENT 
 * 1. $post = Post::find(2);
 *    $post->delete();
 * 
 * 2. Post::destroy(3);
 * 
 * 3. Post::destroy([4,5]);
 * 
 * 4. Post::where('is_admin', 0)->delete():
 * 
 */

/**
 * 1. After setting up the Post Model to enable SoftDeletes (Two Lines)
 * 2. Create new migration (refer deleted_at_column_to_posts_table - both up -has shortcut- n down to drop) and migrate it.
 */
 Route::get('/softdelete', function(){
    Post::find(6)->delete();
    // NOTES:
    // This will create a timestamp in column 'deleted_at' when we decided to delete it. Not deleting the data. This is SoftDelete!
 });

 // NOTES: Reading soft deleted data, because you cannot read it in the usual way - it will return empty result
 Route::get('readsoftdelete', function(){
    $post = Post::withTrashed()->where('id',2)->get(); // read specific trashed item (soft deleted item)
    $post = Post::onlyTrashed()->get(); // read all the trashed item
    return $post;
 });

 // Restore the Trashed Item (Soft Deleted data)
 Route::get('/restoresoftdelete', function(){
    Post::withTrashed()->restore();
    // Post::withTrashed()->where('id',2)->restore();
 });

 // Permenantly Delete data after it is trashed (soft deleted)
 Route::get('/permenantdelete', function(){
    Post::onlyTrashed()->forceDelete();
 });

/**
 * ----------------------------------------
 * END ELOQUENT EXAMPLE
 * ----------------------------------------
 */


 /**
 * ----------------------------------------
 * END ELOQUENT RELATIONSHIP
 * ----------------------------------------
 */

 // Use App/User first at the file header, and access the post of user by ID given.
 Route::get('/user/{id}/post', function($id){
    // Return one result as this is set as <hasOne Post> in UserModel
    return User::find($id)->post->content; // Calling for post() function
 });


 // Inverse hasOne relationship from Post to User (pulling Post from User information) -- need to setup belongTo in Post model.
 Route::get('/posts/{id}/user', function($id){
    // Return the user from user information
    return Post::find($id)->user->name;
 });

 // One-To-Many relationship that calls for posts() function in User Model
 Route::get('/allposts', function(){
    $user = User::find(1);

    foreach($user->posts as $post){
        echo $post->title . "<br/>";
    }
 });

 // Get the Role of a User (Many to Many Relationship) - One User Has Many Role, One Role Has Many User
 Route::get('/user/{id}/role', function($id){
    $user = User::find($id);

    $user = User::find($id)->roles()->orderBy('id','desc')->get(); // Use roles() function in User Model

    return $user;

    foreach($user->roles as $role){
        return $role->name;
    }
 });

 // Inverse Relationship of Many-To-Many (Role to User) - need to create users() function in Role Model.
 Route::get('/role/{id}/user', function($id){
    $role = Role::find($id);
    
    foreach($role->users as $user){
        return $user->name;
    }

 });

 // Accessing the Bridge/Pivot table
 // Need to include withPivot in User Model if you want to access the Pivot table.
 Route::get('/user/pivot', function(){
    $user = User::find(1);

    foreach($user->roles as $role){
        echo $role->pivot->created_at;
    }
 });

 // THROUGH RELATION - Getting information about Post from Country. Country->User->Post
 Route::get('/user/country', function(){
    // Searching for Country(1) = Malaysia 
    $country = Country::find(1);
    
    foreach($country->posts as $post){ // Using posts() function in Country Model
        echo $post->title.'<br/>';
    }
 });

// POLYMORPHIC RELATIONSHIP (One Model referring to Multiple Model)
// Get the Photo (path) of User
Route::get('/user/photos', function(){
    $user = User::find(1);
    foreach($user->photos as $photo){
        return $photo->path;
    }
});

// POLYMORPHIC RELATIONSHIP
// Get Multiple Photo for Post ID = 1
Route::get('/post2/{id}/photos', function($id){
    $post = Post::find($id);
    foreach($post->photos as $photo){
        echo $photo->path.'<br/>';
    }
});


// INVERSE POLYMORPHIC RELATIONSHIP
// Searching USER/POST based on photo ID
Route::get('photo/{id}/postuser', function($id){
    $photo = Photo::findOrFail($id);
    return $photo->imageable;
});

// MANY-TO-MANY POLYMORPHIC RELATIONSHIP
Route::get('/post3/{id}/tag', function($id){
    $post = Post::find($id);
    foreach($post->tags as $tag){
        echo $tag->name;
    }
});

// MANY-TO-MANY INVERSE POLYMORPHIC RELATIONSHIP
// Find Post based on Tag ID
Route::get('/tag/{id}/post', function($id){
    $tag = Tag::find($id);

    foreach($tag->posts as $post){
        echo $post;
    }
});

 /**
 * ----------------------------------------
 * END ELOQUENT RELATIONSHIP EXAMPLE
 * ----------------------------------------
 */