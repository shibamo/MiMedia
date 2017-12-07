<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumThreadMainComplainsTable extends Migration
{
  /**
    * Run the migrations.
    *
    * @return void
    */
  public function up()
  {
    Schema::dropIfExists('forum_thread_main_complains');
    
    Schema::create('forum_thread_main_complains', function (Blueprint $table) {
      $table->increments('id');

      $table->bigInteger('forumThreadId');
      $table->bigInteger('forumBoardId');
      $table->bigInteger('complainerId')->nullable();
      $table->text('complainContent');
      $table->boolean('isProcessed')->default(false);
      $table->bigInteger('supervisorId')->nullable();      
      $table->text('memo')->nullable(); 

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
    Schema::dropIfExists('forum_thread_main_complains');
  }
}
