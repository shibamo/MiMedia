<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdSettingsTableSeeder extends Seeder
{
	public function run()   {
		App\AdSetting::create(
      ['name'=>'tv-programe-list',
      'caption'=>'电视节目广告1',
      'contentUrl'=>'https://www.youtube.com',
      'startFrom'=>new Carbon(), 
      'endTo'=> (new Carbon())->addMonths(2),
      'maintainerId'=>5003,   
      'customerId'=>5007, 
      'displayOrder'=>1,
      'memo'=>'vip客户常年广告' ]);

    App\AdSetting::create(
      ['name'=>'tv-programe-list',
      'caption'=>'电视节目广告2',
      'startFrom'=>new Carbon(), 
      'endTo'=> (new Carbon())->addMonth(),
      'maintainerId'=>5003,   
      'customerId'=>5007, 
      'displayOrder'=>2]);

		App\AdSetting::create(
      ['name'=>'radio-station-list',
      'caption'=>'电台节目广告1',
      'startFrom'=>new Carbon(), 
      'maintainerId'=>5000,   
      'customerId'=>5007, 
      'displayOrder'=>1]); 

		App\AdSetting::create(
      ['name'=>'forum-board-list',
      'caption'=>'交流版块',
      'startFrom'=>new Carbon(), 
      'maintainerId'=>5003,   
      'customerId'=>5007, 
      'displayOrder'=>1]); 
	}
}
