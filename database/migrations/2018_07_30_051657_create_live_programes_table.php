<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveProgramesTable extends Migration
{
  public function up()
  {
    Schema::dropIfExists('live_programes');

    Schema::create('live_programes', function (Blueprint $table) {
      $table->increments('id');
      $table->bigInteger('liveChannelId');
      $table->string('guid');
      $table->string('name');
      $table->string('shortContent')->nullable();
      $table->text('content')->nullable();
      $table->string('image')->nullable();      
      $table->string('url')->nullable();
      $table->dateTime('availableDateTime')->nullable(); // 开始在前台显示时间点,用于控制是否显示该直播节目
      $table->string('date')->nullable();
      $table->bigInteger('playedTimes')->nullable();      
      $table->bigInteger('likedTimes')->nullable();
      $table->boolean('isChecked')->default(false); 
      $table->boolean('isPublished')->default(false);

      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down()
  {
    Schema::dropIfExists('live_programes');
  }
}
