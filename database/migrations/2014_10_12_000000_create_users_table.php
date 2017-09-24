<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('guid');
      $table->string('name');
      $table->string('email',100)->unique();
      $table->string('password');
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
    });

    DB::update("ALTER TABLE users AUTO_INCREMENT = 5000;");
  }

  public function down()
  {
    Schema::dropIfExists('users');
  }
}
