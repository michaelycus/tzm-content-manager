 <?php

 class ArticlesTableSeeder extends Seeder {
 	public function run() {
 		DB::table('articles')->delete(); 		

 		$articles = array(
			array(
				'media_id' 		=> '4',
				'title' 		=> 'NACIONALISMO: uma doença infantil?',
				'link_wordpress'=> 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1296&action=edit&message=10',
				'link_extra' 	=> '',
			),
			array(
				'media_id' 		=> '5',
				'title' 		=> 'Moralidade e Ética - parte 2',
				'link_wordpress'=> 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1350&action=edit&message=10',
				'link_extra' 	=> '',
			),
		);

 		DB::table('articles')->insert($articles);

 	}
 }