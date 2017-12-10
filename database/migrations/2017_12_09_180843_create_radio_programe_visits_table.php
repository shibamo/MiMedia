<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadioProgrameVisitsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('radio_programe_visits');

    Schema::create('radio_programe_visits', function (Blueprint $table) {
      $table->increments('id');
      $table->bigInteger('radioProgrameId');
      $table->bigInteger('userId')->nullable();
      $table->string('extentionCode',100)->nullable();

      $table->string('deviceUUID',50)->nullable();
      $table->string('model',50)->nullable();
      $table->string('platform',50)->nullable();
      $table->string('version',20)->nullable();

      $table->double('latitude',10,7)->nullable();
      $table->double('longitude',10,7)->nullable();

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
    Schema::dropIfExists('radio_programe_visits');
  }
}
