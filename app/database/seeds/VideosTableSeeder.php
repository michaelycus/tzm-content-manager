 <?php

 class VideosTableSeeder extends Seeder {
 	public function run() {
 		DB::table('videos')->delete();

 		$videos = array(
			array(
				'media_id'		=> '1',
				'title' 		=> 'Humans Need Not Apply',
				'original_link' => 'https://www.youtube.com/watch?v=7Pq-S557XQU',
				'working_link' 	=> 'http://www.amara.org/pt/videos/FvwdhnsfXSs6/info/humans-need-not-apply/',
				'duration' 		=> '901',
				'thumbnail' 	=> 'http://i.ytimg.com/vi/7Pq-S557XQU/default.jpg',
			),
			array(
				'media_id' 		=> '2',
				'title' 		=> 'Origins and Adaptations II, Peter Joseph, March 15th 2014, ZDay',
				'original_link' => 'https://www.youtube.com/watch?v=zf64WzgJrvY',
				'working_link' 	=> 'http://www.amara.org/pt/videos/r9rU8Eihsmsc/info/origins-and-adaptations-ii-peter-joseph-march-15th-2014-zday-the-zeitgeist-movement/',
				'duration' 		=> '3341',
				'thumbnail' 	=> 'http://i.ytimg.com/vi/zf64WzgJrvY/default.jpg',
			),
			array(
				'media_id' 		=> '3',
				'title' 		=> 'Alan Watts - The veil of thoughts - complete - original',
				'original_link' => 'https://www.youtube.com/watch?v=fE5OGBjtTVU',
				'working_link' 	=> 'http://www.amara.org/pt/videos/9A2pGBY49dbJ/info/alan-watts-the-veil-of-thoughts-complete-original/',
				'duration' 		=> '4395',
				'thumbnail' 	=> 'http://i.ytimg.com/vi/fE5OGBjtTVU/default.jpg',
			),
		);

 		DB::table('videos')->insert($videos);
 	}
 }
