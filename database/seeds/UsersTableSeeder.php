<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
		    'name'		=> 'Fernando',
		    'email'		=> 'fernando@vintec.com',
		    'password'	=> bcrypt('12345678'),
            'remember_token' => str_random(10)
		]);
    }
}
