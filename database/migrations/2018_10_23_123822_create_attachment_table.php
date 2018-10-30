<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('attachment', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title');
      $table->string('file');
      $table->integer('student_id')->index();
      $table->timestamps();
    });

    Schema::table('attachment', function($table) {
      $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('attachment');
  }
}
