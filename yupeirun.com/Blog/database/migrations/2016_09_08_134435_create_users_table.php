<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
			$table->string('email');
			$table->string('password');
			$table->string('nickname');
			$table->boolean('is_admin')->default(0);
			$table->boolean('block')->default(0);
			$table->string('remember_token')->nullable();
			$table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
