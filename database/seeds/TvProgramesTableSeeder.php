<?php

use Illuminate\Database\Seeder;

class TvProgramesTableSeeder extends Seeder
{
	public function run()   {
    #region newsItems
      App\TvPrograme::create([
        'tvChannelId'=>1, //newsItems
        'guid'=> UUID::generate()->string,
        'name' => '新闻1:华赢凯来涉嫌非法集资',
        'shortContent' => '北京华赢凯来资产管理有限公司因涉嫌非法集资被投资者举报...',
        'content' => "7月2日下午，北京市公安局东城分局官方微博@平安东城发布消息称，北京华赢凯来资产管理有限公司（以下简称华赢凯来）因涉嫌非法集资被投资者举报，目前包括白某某等32人已经抓捕归案。另据《三联生活周刊》报道，白某某即白志明。\n “中国绝大部分的技术创新来源于国有企业”，宝武钢铁董事长马国强的这句话成为2017年夏季达沃斯的“金句”之一。对中国而言，创新变得越来越重要，国内外对于国企创新能力的研究也一直不断。那么，国企在技术创新领域是否优于民企和外企？1921年，美国经济学家奈特曾指出，与不确定性风险不同，创新本身并没有统计规律可言，因为创新是独一无二的。相较于其他的创新，技术创新的产出有着较为明确的量化指标。结合国内外学者的研究成果，网易研究局（微信公号：hccyjj163）在本文中将更加关注专利的增长。\n《总编辑时间》特朗普会否遵守中美不对抗共识？印度骑虎难下理应回头是岸 奥迪广告把女人比做二手车",
        'image' => "cover_images/img001.jpg",
        "url" => "tv/v001.mp4",
        "date" => "2017-07-02",
        "isChecked" => true,
        "isPublished" => true,
      ]);

      App\TvPrograme::create([
        'tvChannelId'=>1, //newsItems
        'guid'=> UUID::generate()->string,
        'name' => '新闻2:华赢凯来涉嫌非法集资',
        'shortContent' => '北京华赢凯来资产管理有限公司因涉嫌非法集资被投资者举报...',
        'content' => "7月2日下午，北京市公安局东城分局官方微博@平安东城发布消息称，北京华赢凯来资产管理有限公司（以下简称华赢凯来）因涉嫌非法集资被投资者举报，目前包括白某某等32人已经抓捕归案。另据《三联生活周刊》报道，白某某即白志明。\n “中国绝大部分的技术创新来源于国有企业”，宝武钢铁董事长马国强的这句话成为2017年夏季达沃斯的“金句”之一。对中国而言，创新变得越来越重要，国内外对于国企创新能力的研究也一直不断。那么，国企在技术创新领域是否优于民企和外企？1921年，美国经济学家奈特曾指出，与不确定性风险不同，创新本身并没有统计规律可言，因为创新是独一无二的。相较于其他的创新，技术创新的产出有着较为明确的量化指标。结合国内外学者的研究成果，网易研究局（微信公号：hccyjj163）在本文中将更加关注专利的增长。\n《总编辑时间》特朗普会否遵守中美不对抗共识？印度骑虎难下理应回头是岸 奥迪广告把女人比做二手车",
        'image' => "cover_images/img002.jpg",
        "url" => "tv/v002.mp4",
        "date" => "2017-07-03",
        "isChecked" => true,
        "isPublished" => true,
      ]);

      App\TvPrograme::create([
        'tvChannelId'=>1, //newsItems
        'guid'=> UUID::generate()->string,
        'name' => '新闻3:华赢凯来涉嫌非法集资',
        'shortContent' => '北京华赢凯来资产管理有限公司因涉嫌非法集资被投资者举报...',
        'content' => "7月2日下午，北京市公安局东城分局官方微博@平安东城发布消息称，北京华赢凯来资产管理有限公司（以下简称华赢凯来）因涉嫌非法集资被投资者举报，目前包括白某某等32人已经抓捕归案。另据《三联生活周刊》报道，白某某即白志明。\n “中国绝大部分的技术创新来源于国有企业”，宝武钢铁董事长马国强的这句话成为2017年夏季达沃斯的“金句”之一。对中国而言，创新变得越来越重要，国内外对于国企创新能力的研究也一直不断。那么，国企在技术创新领域是否优于民企和外企？1921年，美国经济学家奈特曾指出，与不确定性风险不同，创新本身并没有统计规律可言，因为创新是独一无二的。相较于其他的创新，技术创新的产出有着较为明确的量化指标。结合国内外学者的研究成果，网易研究局（微信公号：hccyjj163）在本文中将更加关注专利的增长。\n《总编辑时间》特朗普会否遵守中美不对抗共识？印度骑虎难下理应回头是岸 奥迪广告把女人比做二手车",
        'image' => "cover_images/img003.jpg",
        "url" => "tv/v003.mp4",
        "date" => "2017-07-04",
        "isChecked" => true,
        "isPublished" => true,
      ]);
    #endregion

    #region entertainItems
      App\TvPrograme::create([
        'tvChannelId'=>2, 
        'guid'=> UUID::generate()->string,
        'name' => '娱乐1:华赢凯来涉嫌非法集资',
        'shortContent' => '北京华赢凯来资产管理有限公司因涉嫌非法集资被投资者举报...',
        'content' => "7月2日下午，北京市公安局东城分局官方微博@平安东城发布消息称，北京华赢凯来资产管理有限公司（以下简称华赢凯来）因涉嫌非法集资被投资者举报，目前包括白某某等32人已经抓捕归案。另据《三联生活周刊》报道，白某某即白志明。\n “中国绝大部分的技术创新来源于国有企业”，宝武钢铁董事长马国强的这句话成为2017年夏季达沃斯的“金句”之一。对中国而言，创新变得越来越重要，国内外对于国企创新能力的研究也一直不断。那么，国企在技术创新领域是否优于民企和外企？1921年，美国经济学家奈特曾指出，与不确定性风险不同，创新本身并没有统计规律可言，因为创新是独一无二的。相较于其他的创新，技术创新的产出有着较为明确的量化指标。结合国内外学者的研究成果，网易研究局（微信公号：hccyjj163）在本文中将更加关注专利的增长。\n《总编辑时间》特朗普会否遵守中美不对抗共识？印度骑虎难下理应回头是岸 奥迪广告把女人比做二手车",
        'image' => "cover_images/img001.jpg",
        "url" => "tv/v001.mp4",
        "date" => "2017-07-02",
        "isChecked" => true,
        "isPublished" => true,
      ]);

      App\TvPrograme::create([
        'tvChannelId'=>2, 
        'guid'=> UUID::generate()->string,
        'name' => '娱乐2:华赢凯来涉嫌非法集资',
        'shortContent' => '北京华赢凯来资产管理有限公司因涉嫌非法集资被投资者举报...',
        'content' => "7月2日下午，北京市公安局东城分局官方微博@平安东城发布消息称，北京华赢凯来资产管理有限公司（以下简称华赢凯来）因涉嫌非法集资被投资者举报，目前包括白某某等32人已经抓捕归案。另据《三联生活周刊》报道，白某某即白志明。\n “中国绝大部分的技术创新来源于国有企业”，宝武钢铁董事长马国强的这句话成为2017年夏季达沃斯的“金句”之一。对中国而言，创新变得越来越重要，国内外对于国企创新能力的研究也一直不断。那么，国企在技术创新领域是否优于民企和外企？1921年，美国经济学家奈特曾指出，与不确定性风险不同，创新本身并没有统计规律可言，因为创新是独一无二的。相较于其他的创新，技术创新的产出有着较为明确的量化指标。结合国内外学者的研究成果，网易研究局（微信公号：hccyjj163）在本文中将更加关注专利的增长。\n《总编辑时间》特朗普会否遵守中美不对抗共识？印度骑虎难下理应回头是岸 奥迪广告把女人比做二手车",
        'image' => "cover_images/img002.jpg",
        "url" => "tv/v002.mp4",
        "date" => "2017-07-03",
        "isChecked" => true,
        "isPublished" => true,
      ]);

      App\TvPrograme::create([
        'tvChannelId'=>2, 
        'guid'=> UUID::generate()->string,
        'name' => '娱乐3:华赢凯来涉嫌非法集资',
        'shortContent' => '北京华赢凯来资产管理有限公司因涉嫌非法集资被投资者举报...',
        'content' => "7月2日下午，北京市公安局东城分局官方微博@平安东城发布消息称，北京华赢凯来资产管理有限公司（以下简称华赢凯来）因涉嫌非法集资被投资者举报，目前包括白某某等32人已经抓捕归案。另据《三联生活周刊》报道，白某某即白志明。\n “中国绝大部分的技术创新来源于国有企业”，宝武钢铁董事长马国强的这句话成为2017年夏季达沃斯的“金句”之一。对中国而言，创新变得越来越重要，国内外对于国企创新能力的研究也一直不断。那么，国企在技术创新领域是否优于民企和外企？1921年，美国经济学家奈特曾指出，与不确定性风险不同，创新本身并没有统计规律可言，因为创新是独一无二的。相较于其他的创新，技术创新的产出有着较为明确的量化指标。结合国内外学者的研究成果，网易研究局（微信公号：hccyjj163）在本文中将更加关注专利的增长。\n《总编辑时间》特朗普会否遵守中美不对抗共识？印度骑虎难下理应回头是岸 奥迪广告把女人比做二手车",
        'image' => "cover_images/img003.jpg",
        "url" => "tv/v003.mp4",
        "date" => "2017-07-04",
        "isChecked" => true,
        "isPublished" => true,
      ]);
    #endregion

    #region automanItems    
      App\TvPrograme::create([
        'tvChannelId'=>3, 
        'guid'=> UUID::generate()->string,
        'name' => '华赢凯来涉嫌非法集资',
        'shortContent' => '北京华赢凯来资产管理有限公司因涉嫌非法集资被投资者举报...',
        'content' => "7月2日下午，北京市公安局东城分局官方微博@平安东城发布消息称，北京华赢凯来资产管理有限公司（以下简称华赢凯来）因涉嫌非法集资被投资者举报，目前包括白某某等32人已经抓捕归案。另据《三联生活周刊》报道，白某某即白志明。\n “中国绝大部分的技术创新来源于国有企业”，宝武钢铁董事长马国强的这句话成为2017年夏季达沃斯的“金句”之一。对中国而言，创新变得越来越重要，国内外对于国企创新能力的研究也一直不断。那么，国企在技术创新领域是否优于民企和外企？1921年，美国经济学家奈特曾指出，与不确定性风险不同，创新本身并没有统计规律可言，因为创新是独一无二的。相较于其他的创新，技术创新的产出有着较为明确的量化指标。结合国内外学者的研究成果，网易研究局（微信公号：hccyjj163）在本文中将更加关注专利的增长。\n《总编辑时间》特朗普会否遵守中美不对抗共识？印度骑虎难下理应回头是岸 奥迪广告把女人比做二手车",
        'image' => "cover_images/img001.jpg",
        "url" => "tv/v001.mp4",
        "date" => "2017-07-02",
        "isChecked" => true,
        "isPublished" => true,
      ]);

      App\TvPrograme::create([
        'tvChannelId'=>3, 
        'guid'=> UUID::generate()->string,
        'name' => '华赢凯来涉嫌非法集资',
        'shortContent' => '北京华赢凯来资产管理有限公司因涉嫌非法集资被投资者举报...',
        'content' => "7月2日下午，北京市公安局东城分局官方微博@平安东城发布消息称，北京华赢凯来资产管理有限公司（以下简称华赢凯来）因涉嫌非法集资被投资者举报，目前包括白某某等32人已经抓捕归案。另据《三联生活周刊》报道，白某某即白志明。\n “中国绝大部分的技术创新来源于国有企业”，宝武钢铁董事长马国强的这句话成为2017年夏季达沃斯的“金句”之一。对中国而言，创新变得越来越重要，国内外对于国企创新能力的研究也一直不断。那么，国企在技术创新领域是否优于民企和外企？1921年，美国经济学家奈特曾指出，与不确定性风险不同，创新本身并没有统计规律可言，因为创新是独一无二的。相较于其他的创新，技术创新的产出有着较为明确的量化指标。结合国内外学者的研究成果，网易研究局（微信公号：hccyjj163）在本文中将更加关注专利的增长。\n《总编辑时间》特朗普会否遵守中美不对抗共识？印度骑虎难下理应回头是岸 奥迪广告把女人比做二手车",
        'image' => "cover_images/img002.jpg",
        "url" => "tv/v002.mp4",
        "date" => "2017-07-03",
        "isChecked" => true,
        "isPublished" => true,
      ]);

      App\TvPrograme::create([
        'tvChannelId'=>3, 
        'guid'=> UUID::generate()->string,
        'name' => '华赢凯来涉嫌非法集资',
        'shortContent' => '北京华赢凯来资产管理有限公司因涉嫌非法集资被投资者举报...',
        'content' => "7月2日下午，北京市公安局东城分局官方微博@平安东城发布消息称，北京华赢凯来资产管理有限公司（以下简称华赢凯来）因涉嫌非法集资被投资者举报，目前包括白某某等32人已经抓捕归案。另据《三联生活周刊》报道，白某某即白志明。\n “中国绝大部分的技术创新来源于国有企业”，宝武钢铁董事长马国强的这句话成为2017年夏季达沃斯的“金句”之一。对中国而言，创新变得越来越重要，国内外对于国企创新能力的研究也一直不断。那么，国企在技术创新领域是否优于民企和外企？1921年，美国经济学家奈特曾指出，与不确定性风险不同，创新本身并没有统计规律可言，因为创新是独一无二的。相较于其他的创新，技术创新的产出有着较为明确的量化指标。结合国内外学者的研究成果，网易研究局（微信公号：hccyjj163）在本文中将更加关注专利的增长。\n《总编辑时间》特朗普会否遵守中美不对抗共识？印度骑虎难下理应回头是岸 奥迪广告把女人比做二手车",
        'image' => "cover_images/img003.jpg",
        "url" => "tv/v003.mp4",
        "date" => "2017-07-04",
        "isChecked" => true,
        "isPublished" => true,
      ]);
    #endregion
	}
}