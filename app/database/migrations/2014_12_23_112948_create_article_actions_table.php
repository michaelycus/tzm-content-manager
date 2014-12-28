<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_actions', function(Blueprint $table){
			$table->integer('article_id');
			$table->integer('author_id');
			$table->integer('reviewer1_id');			
			$table->integer('reviewer2_id');
			$table->boolean('reviewer1_approval');
			$table->boolean('reviewer2_approval');
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
		Schema::drop('article_actions');
	}

}
