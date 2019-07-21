<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentTableNullableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function($table)
        {
          $table->string('PersonalEmail')->nullable()->change();
          $table->text('Notes', 65535)->nullable()->change();
          $table->string('Bleep')->nullable()->change();
          $table->string('FirstBlockDrop')->nullable()->change();
          $table->string('SecondBlockDrop')->nullable()->change();
          $table->string('ThirdBlockDrop')->nullable()->change();
          $table->string('FirstPostpone')->nullable()->change();
          $table->string('SecondPostpone')->nullable()->change();
          $table->string('ThirdPostpone')->nullable()->change();
          $table->string('Dismissed')->nullable()->change();
          $table->string('Withdrawal')->nullable()->change();
          $table->string('LastActivationDate')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('students', function($table)
      {
        $table->string('PersonalEmail')->change();
        $table->text('Notes', 65535)->change();
        $table->string('Bleep')->change();
        $table->string('FirstBlockDrop')->change();
        $table->string('SecondBlockDrop')->change();
        $table->string('ThirdBlockDrop')->change();
        $table->string('FirstPostpone')->change();
        $table->string('SecondPostpone')->change();
        $table->string('ThirdPostpone')->change();
        $table->string('Dismissed')->change();
        $table->string('Withdrawal')->change();
        $table->string('LastActivationDate')->change();
      });
  }
}
