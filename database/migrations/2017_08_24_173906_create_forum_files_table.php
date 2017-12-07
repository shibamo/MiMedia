<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumFilesTable extends Migration
{
  public function up()
  {
    Schema::dropIfExists('forum_files');
    
    Schema::create('forum_files', function (Blueprint $table) {
      $table->increments('id');
      $table->bigInteger('forumThreadMainId')->nullable();
      $table->bigInteger('forumThreadReplyId')->nullable();
      $table->bigInteger('authorId');
      $table->string('threadGuid');//用于保存threadMain或threadReply时找到对应的对象
      $table->string('url');
      
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down()
  {
    Schema::dropIfExists('forum_files');
  }
}
