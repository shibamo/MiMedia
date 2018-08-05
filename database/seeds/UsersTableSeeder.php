<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	public function run()   {
		$user_sysAdmin = App\User::create([
      'name'=>'sysAdmin',
      'guid' =>UUID::generate()->string, 
      'email'=>'qinchao@hotmail.com',
      'password' => bcrypt('dRadioC!'),
      'question'=>'我们的口号',
      'answer'=>'只有蛀牙',            
      'isSystemManager' => true,
    ]);

		$user_defaultAuditor = App\User::create([
      'name'=>'auditor1',
      'guid' =>UUID::generate()->string, 
      'email'=>'auditor1@dchineseradio.com',
      'password' => bcrypt('dARadUiodC!9'),
      'question'=>'我们的口号',
      'answer'=>'只有蛀牙',          
      'isAuditor' => true,
    ]);

		$user_defaultEditor = App\User::create([
      'name'=>'editor1',
      'guid' =>UUID::generate()->string, 
      'email'=>'editor1@dchineseradio.com',
      'password' => bcrypt('dREadioCd!0'),
      'question'=>'我们的口号',
      'answer'=>'只有蛀牙',          
      'isEditor' => true,
    ]);

    $user_defaultADManager= App\User::create([
      'name'=>'adManager1',
      'guid' =>UUID::generate()->string, 
      'email'=>'adManager1@dchineseradio.com',
      'password' => bcrypt('dRaAdiMoCD!3'),
      'question'=>'我们的口号',
      'answer'=>'只有蛀牙',          
      'isADManager' => true,
    ]);

		$user_testUser1 = App\User::create([
      'name'=>'测试用户1',
      'guid' =>UUID::generate()->string, 
      'email'=>'test1@dchineseradio.com',
      'avatar' => "avatar/avatar1.jpg",
      'password' => bcrypt('dRTadSieoC!1'),
      'question'=>'我们的口号',
      'answer'=>'只有蛀牙',          
    ]);

		$user_testUser2 = App\User::create([
      'name'=>'测试用户2',
      'guid' =>UUID::generate()->string, 
      'email'=>'test2@dchineseradio.com',
      'avatar' => "avatar/avatar2.jpg",
      'password' => bcrypt('dRTadi2oSCE!'),
      'question'=>'我们的口号',
      'answer'=>'只有蛀牙',          
    ]);

		$user_testUser3 = App\User::create([
      'name'=>'测试用户3',
      'guid' =>UUID::generate()->string, 
      'email'=>'test3@dchineseradio.com',
      'avatar' => "avatar/avatar3.jpg",
      'password' => bcrypt('dERTadi3soC!'),
      'question'=>'我们的口号',
      'answer'=>'只有蛀牙',          
    ]);

		$user_testAdClient = App\User::create([
      'name'=>'测试广告客户',
      'guid' =>UUID::generate()->string, 
      'email'=>'adclienttest@dchineseradio.com',
      'avatar' => "avatar/avatar3.jpg",
      'password' => bcrypt('dRTlCazdAioCD!5'),
      'question'=>'我们的口号',
      'answer'=>'只有蛀牙',          
      'isADClient' => true,
    ]);

		$user_testerForApple = App\User::create([
      'name'=>'Apple Test',
      'guid' =>UUID::generate()->string, 
      'email'=>'appletest@dchineseradio.com',
      'avatar' => "avatar/avatar3.jpg",
      'password' => bcrypt('AppleTest!1024'),
      'question'=>'我们的口号',
      'answer'=>'只有蛀牙', 
    ]);

		$user_testerForAndroid = App\User::create([
      'name'=>'Android Test',
      'guid' =>UUID::generate()->string, 
      'email'=>'androidtest@dchineseradio.com',
      'avatar' => "avatar/avatar3.jpg",
      'password' => bcrypt('androidTest!2048'),
      'question'=>'我们的口号',
      'answer'=>'只有蛀牙', 
    ]);    
	}
}
