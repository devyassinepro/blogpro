<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\URL;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
        	'fullname'=>'Touzani Admin',
        	'email' => 'admin@gmail.com',
        	'username' => 'admin',
        	'password' => bcrypt('admin1996@@'),
			    'avatar' => URL::to('/')."/uploads/avatar/avatar.png",
          'email_verified_at' => time(),
        ]);
        $admin->assignRole('admin');

        $admin = User::create([
        	'fullname'=>'Touzani Yassine',
        	'email' => 'touzanicontact1@gmail.com',
        	'username' => 'Touzaniyassine',
        	'password' => bcrypt('touzani'),
			    'avatar' => URL::to('/')."/uploads/avatar/avatar.png",
          'email_verified_at' => time(),
        ]);
        $admin->assignRole('users');

    }
}
