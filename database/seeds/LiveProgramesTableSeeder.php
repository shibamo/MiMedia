<?php

use Illuminate\Database\Seeder;

class LiveProgramesTableSeeder extends Seeder
{
  public function run()
  {
    App\LivePrograme::create([
      'liveChannelId'=>1, 
      'guid'=> UUID::generate()->string,
      'name' => '直播:测试1',
      "url" => "https://www.youtube.com/watch?v=LdGP16AXYTA",
      "date" => "2018-08-05",
      "isChecked" => true,
      "isPublished" => true,
    ]);

    App\LivePrograme::create([
      'liveChannelId'=>1, 
      'guid'=> UUID::generate()->string,
      'name' => '直播:测试2',
      "url" => "https://www.youtube.com/watch?v=KW4knP-oheo",
      "date" => "2018-08-06",
      "isChecked" => true,
      "isPublished" => true,
    ]);
  }
}
