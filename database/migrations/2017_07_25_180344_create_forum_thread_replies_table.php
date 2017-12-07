<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumThreadRepliesTable extends Migration
{
  public function up()
  {
    Schema::dropIfExists('forum_thread_replies');
    
    Schema::create('forum_thread_replies', function (Blueprint $table) {
      $table->increments('id');
      
      $table->bigInteger('forumThreadId');
      $table->bigInteger('forumBoardId');
      $table->bigInteger('authorId');      
      $table->string('guid');
      $table->text('content');
      $table->bigInteger('likedTimes')->nullable();
      $table->boolean('isChecked')->default(false)->index(); 
      $table->boolean('isPublished')->default(false);    

      $table->timestamps();
      $table->softDeletes();

      $table->index(['forumBoardId','forumThreadId']);
      $table->index(['forumBoardId','isChecked']);
      $table->index('authorId');
    });
  }

  public function down()
  {
    Schema::dropIfExists('forum_thread_replies');
  }
}
