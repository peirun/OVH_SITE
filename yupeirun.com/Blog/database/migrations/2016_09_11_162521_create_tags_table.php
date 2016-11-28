<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
   
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->unique();
			$table->integer('count')->default(0);
			$table->softDeletes();
			$table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('tags');
    }
}