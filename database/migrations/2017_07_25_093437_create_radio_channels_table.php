<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadioChannelsTable extends Migration
{
  public function up()
  {
    Schema::create('radio_channels', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('caption');       
      $table->timestamps();
      $table->softDeletes();             
        });
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radio_channels');
    }
}
