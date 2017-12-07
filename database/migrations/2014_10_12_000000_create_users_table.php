<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  public function up()
  {
    Schema::dropIfExists('users');
    
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('guid');
      $table->string('name', 128)->unique();
      $table->string('email', 128)->unique();
      $table->string('password', 256);
      $table->bigInteger('loginFailCount')->default(0); //登录失败次数
      $table->dateTime('loginFailLockEndDateTime')->nullable(); //登录失败被封锁登录的结束时间
      $table->string('question', 256); //重置密码的问题
      $table->string('answer', 256); //重置密码的答案
      $table->bigInteger('resetFailCount')->default(0); //重置密码失败次数
      $table->dateTime('resetFailLockEndDateTime')->nullable();//重置密码被封锁重置的结束时间
      $table->string('avatar')->default('avatar/avatar.png');
      $table->boolean('isSystemManager')->default(false);//是否系统管理员
      $table->boolean('isAuditor')->default(false);//是否审核人员
      $table->boolean('isEditor')->default(false);//是否内容编辑
      $table->boolean('isADManager')->default(false);//是否广告管理员
      $table->boolean('isADClient')->default(false);//是否广告客户
      $table->boolean('isLocked')->default(false);//是否被关小黑屋的用户       
      $table->boolean('isVerified')->default(false);//用户信息是否已验证(目前主要是邮箱) 

      $table->rememberToken();
      $table->timestamps();

      $table->index('name');
      $table->index('email');
      
    });

    DB::update("ALTER TABLE users AUTO_INCREMENT = 5000;");
  }

  public function down()
  {
    Schema::dropIfExists('users');
  }
}
