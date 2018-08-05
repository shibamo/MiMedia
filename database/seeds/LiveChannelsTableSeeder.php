<?php

use Illuminate\Database\Seeder;

class LiveChannelsTableSeeder extends Seeder
{
	public function run(){
		App\LiveChannel::create(
      ['name'=>'realtime','caption'=>'实时直播']);

    App\LiveChannel::create(
      ['name'=>'playback','caption'=>'精彩历史']);
	}
}
