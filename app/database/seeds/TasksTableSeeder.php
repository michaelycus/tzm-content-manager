 <?php

 class TasksTableSeeder extends Seeder {
 	public function run() {
 		DB::table('tasks')->delete();

 		$tasks = array(
 			array(
				'id' => '1',
				'type' => TASK_ARTICLE_APPROVED,
				'user_id' => '2',
				'media_id' => '4',
				'created_at' => '2014-09-24 10:22:13',
			),
			array(
				'id' => '2',
				'type' => TASK_ARTICLE_NEED_ADJUST,
				'user_id' => '2',
				'media_id' => '4',
				'created_at' => '2014-09-24 10:22:13',
			),
			array(
				'id' => '3',
				'type' => TASK_ARTICLE_NEED_ADJUST,
				'user_id' => '2',
				'media_id' => '5',
				'created_at' => '2014-09-24 10:22:13',
			),	

		);

 		DB::table('tasks')->insert($tasks);
 	}
 }