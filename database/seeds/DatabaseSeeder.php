<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $this->call(UsersTableSeeder::class);
    $this->call(TvChannelsTableSeeder::class);
    $this->call(TvProgramesTableSeeder::class);
    $this->call(RadioChannelsTableSeeder::class);
    $this->call(RadioProgramesTableSeeder::class);
    $this->call(ForumBoardsTableSeeder::class);   
    $this->call(ForumThreadMainsTableSeeder::class);   
    $this->call(ForumThreadRepliesTableSeeder::class);          
    $this->call(AdSettingsTableSeeder::class);   
    
  }
}
