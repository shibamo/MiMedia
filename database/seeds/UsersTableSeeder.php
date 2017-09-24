<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	public function run()   {
		$user_sysAdmin = App\User::create([
      'name'=>'sysAdmin',
      'guid' =>UUID::generate()->string, 
      'email'=>'qinchao@hotmail.com',
      'password' => bcrypt('111111'),
      'isSystemManager' => true,
    ]);

		$user_defaultAuditor = App\User::create([
      'name'=>'auditor',
      'guid' =>UUID::generate()->string, 
      'email'=>'chao.qin01@stclairconnect.ca',
      'password' => bcrypt('111111'),
      'isAuditor' => true,
    ]);

		$user_defaultEditor = App\User::create([
      'name'=>'editor',
      'guid' =>UUID::generate()->string, 
      'email'=>'shibamo@gmail.com',
      'password' => bcrypt('111111'),
      'isEditor' => true,
    ]);

    $user_defaultADManager= App\User::create([
      'name'=>'adManager',
      'guid' =>UUID::generate()->string, 
      'email'=>'5544537@qq.com',
      'password' => bcrypt('111111'),
      'isADManager' => true,
    ]);

		$user_testUser1 = App\User::create([
      'name'=>'测试用户1',
      'guid' =>UUID::generate()->string, 
      'email'=>'test1@test.com',
      'avatar' => "avatar/avatar1.jpg",
      'password' => bcrypt('111111'),
    ]);

		$user_testUser2 = App\User::create([
      'name'=>'测试用户2',
      'guid' =>UUID::generate()->string, 
      'email'=>'test2@test.com',
      'avatar' => "avatar/avatar2.jpg",
      'password' => bcrypt('111111'),
    ]);    

		$user_testUser3 = App\User::create([
      'name'=>'测试用户3',
      'guid' =>UUID::generate()->string, 
      'email'=>'test3@test.com',
      'avatar' => "avatar/avatar3.jpg",
      'password' => bcrypt('111111'),
    ]);

		$user_testAdClient = App\User::create([
      'name'=>'测试广告客户',
      'guid' =>UUID::generate()->string, 
      'email'=>'adclient@test.com',
      'avatar' => "avatar/avatar3.jpg",
      'password' => bcrypt('111111'),
      'isADClient' => true,
    ]);
	}
}
