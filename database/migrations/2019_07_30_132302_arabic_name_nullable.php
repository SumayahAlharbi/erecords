<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArabicNameNullable extends Migration
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
        $table->string('ArabicFirstName')->nullable()->change();
        $table->string('ArabicMiddleName')->nullable()->change();
        $table->string('ArabicLastName')->nullable()->change();
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
        $table->string('ArabicFirstName')->change();
        $table->string('ArabicMiddleName')->change();
        $table->string('ArabicLastName')->change();
      });
    }
}
