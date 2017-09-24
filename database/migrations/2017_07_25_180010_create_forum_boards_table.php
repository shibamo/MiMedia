<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumBoardsTable extends Migration
{
  public function up()
  {
    Schema::create('forum_boards', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('image');      
      $table->string('caption');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down()
  {
    Schema::dropIfExists('forum_boards');
  }
}
