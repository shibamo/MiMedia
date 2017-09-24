<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumThreadMainsTable extends Migration
{
  public function up()
  {
    Schema::create('forum_thread_mains', function (Blueprint $table) {
      $table->increments('id');

      $table->bigInteger('forumBoardId');
      $table->bigInteger('authorId');      
      $table->string('guid');
      $table->string('name',200);
      $table->text('content')->nullable();
      $table->bigInteger('displayedTimes')->nullable();      
      $table->bigInteger('likedTimes')->nullable();
      $table->boolean('isChecked')->default(false)->index(); 
      $table->boolean('isPublished')->default(false);

      $table->timestamps();
      $table->softDeletes();        
    });
  }

  public function down()
  {
    Schema::dropIfExists('forum_thread_mains');
  }
}
