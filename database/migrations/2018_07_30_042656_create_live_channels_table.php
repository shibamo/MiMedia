<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveChannelsTable extends Migration
{
	public function up(){
    
    Schema::dropIfExists('live_channels');
		
		Schema::create('live_channels', function (Blueprint $table) {
      $table->increments('id');
      
      $table->string('name');
      $table->string('caption');      
      $table->timestamps();
      $table->softDeletes();  
      
		});
	}
		
	public function down(){
		Schema::dropIfExists('live_channels');
	}
}
