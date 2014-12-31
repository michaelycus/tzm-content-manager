 <?php

 class MediasTableSeeder extends Seeder {
 	public function run() {
 		DB::table('medias')->delete(); 		

 		$medias = array(
			array(
				'id' 			=> '1',
				'user_id' 		=> '1',
				'status' 		=> MEDIA_VIDEO_AVAILABLE,
				'created_at' 	=> '2014-09-14 10:22:13',
			),
			array(
				'id' 			=> '2',
				'user_id' 		=> '2',
				'status' 		=> MEDIA_VIDEO_AVAILABLE,
				'created_at' 	=> '2014-09-24 10:22:13',
			),
			array(
				'id' 			=> '3',
				'user_id' 		=> '2',
				'status' 		=> MEDIA_VIDEO_AVAILABLE,
				'created_at' 	=> '2014-09-10 10:22:13',
			),
			array(
				'id' 			=> '4',
				'user_id' 		=> '1',
				'status' 		=> MEDIA_ARTICLE_AVAILABLE,
				'created_at' 	=> '2014-09-13 10:22:13',
			),
			array(
				'id' 			=> '5',
				'user_id' 		=> '2',
				'status' 		=> MEDIA_ARTICLE_AVAILABLE,
				'created_at' 	=> '2014-09-15 10:22:13',
			),
		);


 		DB::table('medias')->insert($medias);
 	}
 }