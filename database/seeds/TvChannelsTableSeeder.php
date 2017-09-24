<?php

use Illuminate\Database\Seeder;

class TvChannelsTableSeeder extends Seeder
{
	public function run()   {
		App\TvChannel::create(
      ['name'=>'newsItems','caption'=>'新闻']);

		App\TvChannel::create(
      ['name'=>'entertainItems','caption'=>'娱乐']);

		App\TvChannel::create(
      ['name'=>'automanItems','caption'=>'汽车人']);

	}
}
