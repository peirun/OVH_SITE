<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
   
    public function up()
    {
        Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('summary')->nullable();
			$table->text('content');
			$table->text('resolved_content');
			$table->integer('user_id');
			$table->softDeletes();
			$table->timestamps();
		});
    }

    public function down()
    {
        Schema::drop('articles');
    }
}
