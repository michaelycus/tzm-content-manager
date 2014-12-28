 <?php

 class ArticlesTableSeeder extends Seeder {
 	public function run() {
 		DB::table('articles')->delete();
 		DB::table('article_actions')->delete();

 		$articles = array(
			array(
				'id' 			=> '1',
				'title' 		=> 'NACIONALISMO: uma doença infantil?',
				'link_wordpress' => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1296&action=edit&message=10',
				'link_extra' 	=> '',
				'status' 		=> '0',
				'created_at' 	=> '2014-05-24 10:22:13',
			),
			array(
				'id' 			=> '2',
				'title' 		=> 'Moralidade e Ética - parte 2',
				'link_wordpress' => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1350&action=edit&message=10',
				'link_extra' 	=> '',
				'status' 		=> '0',
				'created_at' 	=> '2014-05-30 10:22:13',
			),
		);


		$article_actions = array(
			array(
				'article_id' 	    => '1',
				'author_id'			=> '1',
				'reviewer1_id' 		=> '1',
				'reviewer2_id' 		=> '2',
				'reviewer1_approval' => 'true',
				'reviewer2_approval' => 'false',
			),
			array(
				'article_id' 	    => '2',
				'author_id' 		=> '2',
				'reviewer1_id' 		=> '1',
				'reviewer2_id' 		=> '2',
				'reviewer1_approval' => 'false',
				'reviewer2_approval' => 'false',
			),
		);

 		DB::table('articles')->insert($articles);
 		DB::table('article_actions')->insert($article_actions);
 	}
 }