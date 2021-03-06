<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('MediasTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('ArticlesTableSeeder');
		$this->call('VideosTableSeeder');
		$this->call('TasksTableSeeder');
	}

}
