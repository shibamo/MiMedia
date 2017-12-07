<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdSettingsTable extends Migration
{
  public function up()
  {
    Schema::dropIfExists('ad_settings');
    
    Schema::create('ad_settings', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('caption')->nullable();
      $table->boolean('useAdmob')->default(false);
      $table->string('imageUrl')->default('ad/adpromotion.jpg');
      $table->string('contentUrl')->nullable();
      $table->dateTime('startFrom');
      $table->dateTime('endTo')->nullable();
      $table->bigInteger('maintainerId');
      $table->bigInteger('customerId');
      $table->bigInteger('displayOrder');
      $table->string('memo')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down()
  {
    Schema::dropIfExists('ad_settings');
  }
}
