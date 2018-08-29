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

		App\User::truncate();

        DB::table('users')->insert([
            'name' => 'Thiago Sobrinho',
            'email' => 'thiago122@gmail.com',
            'password' => bcrypt('123456'),
        ]);

	    factory(App\User::class, 50)->create();

    }
}
