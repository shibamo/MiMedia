<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadioProgramesTable extends Migration
{
  public function up()
  {
    Schema::dropIfExists('radio_programes');
    
    Schema::create('radio_programes', function (Blueprint $table) {
      $table->increments('id');
      $table->bigInteger('radioChannelId');
      $table->string('guid');
      $table->string('name');
      $table->string('shortContent');
      $table->text('content');
      $table->string('image')->nullable();
      $table->string('url')->nullable();
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
    Schema::dropIfExists('radio_programes');
  }
}
