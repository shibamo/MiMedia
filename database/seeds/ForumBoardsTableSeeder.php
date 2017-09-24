<?php

use Illuminate\Database\Seeder;

class ForumBoardsTableSeeder extends Seeder
{
	public function run()   {
		App\ForumBoard::create(
      ['name'=>'usedThreads','caption'=>'二手交易','image'=>'icon_images/used.jpg']);

		App\ForumBoard::create(
      ['name'=>'relationshipThreads','caption'=>'单身交友','image'=>'icon_images/relationship.jpg']);

		App\ForumBoard::create(
      ['name'=>'jobThreads','caption'=>'求职招聘','image'=>'icon_images/job.jpg']);

    App\ForumBoard::create(
      ['name'=>'worldCrossingMallThreads','caption'=>'精品商城(代购)','image'=>'icon_images/worldCrossingMall.jpg']);

    App\ForumBoard::create(
      ['name'=>'groupThreads','caption'=>'社团信息','image'=>'icon_images/group.jpg']);
      
	}
}
