<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**NOTES: MAKING A MIGRATION TO CREATE A TABLE
 * php artisan make:migration create_posts_table --create="posts" (this is to create migration for posts table)
 * php artisan migrate (push the changes)
 * php artisan migrate:rollback (rollback to the last pushed migration)
 * 
 * OTHER WAY TO CREATE MODEL & DIRECTLY MIGRATE IT: php artisan make:model Role -m (will create Role Model & Migration file)
 * 
 * NOTES: ADDING COLUMN TO EXISTING TABLE
 * php artisan make:migration add_is_admin_column_to_posts_tables --table="posts" (making new migration to add the column)
 * 
 * NOTES: OTHER MIGRATION COMMANDS
 * php artisan migrate:reset (to reset all of the migration)
 * php artisan migrate:refresh (rollback all the migration and migrate it all back)
 * php artisan migrate:status (checking the status of migration, migrated or not.)
 * 
 */
class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
