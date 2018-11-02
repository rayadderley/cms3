<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * NOTES: CREATE A MIGRATION FOR PIVOT/BRIDGE TABLE (WITHOUT MODEL?)
 * php artisan make:migration create_users_roles_table --create=role_user (the name for table [a convention] is important as Laravel will automatically detect this is pivot table)
 */
class CreateUsersRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('role_id');
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
        Schema::drop('role_user');
    }
}
