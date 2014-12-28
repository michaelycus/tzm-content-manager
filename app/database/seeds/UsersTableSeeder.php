 <?php

 class UsersTableSeeder extends Seeder {
 	public function run() {
 		DB::table('users')->delete();

 		$users = array(
 			array(
				'id' => '1',
				'firstname' => 'Henrique',
				'lastname' => 'Prado',
				'password' => Hash::make('henrique'),
				'email' => 'henriquedprado@gmail.com',
				'score' => '0,0,0,0,0,0,0',
				'photo' => 'https://graph.facebook.com/100005445409373/picture?type=large',
			),
			array(
				'id' => '2',
				'firstname' => 'Michael',
				'lastname' => 'Marques',
				'password' => Hash::make('michael'),
				'email' => 'michaelycus@gmail.com',
				'score' => '0,0,0,0,0,0,0',
				'photo' => 'https://graph.facebook.com/10205629977212214/picture?type=large',
			),
			

		);

 		DB::table('users')->insert($users);
 	}
 }