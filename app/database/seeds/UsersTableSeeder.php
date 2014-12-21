 <?php

 class UsersTableSeeder extends Seeder {
 	public function run() {
 		DB::table('users')->delete();

 		$users = array(
			array(
				'firstname' => 'Michael',
				'lastname' => 'Marques',
				'password' => Hash::make('michael'),
				'email' => 'michaelycus@gmail.com',
				'score' => '0,0,0,0,0,0,0'
			)
		);

 		DB::table('users')->insert($users);
 	}
 }