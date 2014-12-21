<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table){
			$table->increments('id');
			$table->string('title', 255);
			$table->string('link_wordpress', 255);
			$table->string('link_extra', 255);
			$table->integer('owner_id');
			$table->integer('reviewer1_id');
			$table->boolean('reviewer1_approval');
			$table->integer('reviewer2_id');
			$table->boolean('reviewer2_approval');
			$table->tinyInteger('status');
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
		Schema::drop('articles');
	}

}
