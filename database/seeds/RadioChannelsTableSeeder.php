<?php

use Illuminate\Database\Seeder;

class RadioChannelsTableSeeder extends Seeder
{
	public function run()   {
		App\RadioChannel::create(
      ['name'=>'morningItems','caption'=>'早安密西根']);

		App\RadioChannel::create(
      ['name'=>'livingItems','caption'=>'密西根生活']);

		// App\RadioChannel::create(
    //   ['name'=>'trumpetItems','caption'=>'密西根小喇叭']);

		App\RadioChannel::create(
      ['name'=>'musicItems','caption'=>'音乐台']);

		App\RadioChannel::create(
      ['name'=>'automanItems','caption'=>'汽车人']);
	}
}