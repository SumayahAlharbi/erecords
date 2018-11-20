<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('ArabicFirstName');
			$table->string('ArabicMiddleName');
			$table->string('ArabicLastName');
			$table->string('FirstName');
			$table->string('MiddleName');
			$table->string('LastName');
			$table->string('NGHAEmail');
			$table->string('KSAUHSEmail');
			$table->string('PersonalEmail');
			$table->string('LastActivationDate');
			$table->integer('NationalID');
			$table->integer('Badge');
			$table->string('Status');
			$table->integer('Mobile');
			$table->text('Notes', 65535);
			$table->string('Bleep');
			$table->string('StudentNo');
			$table->boolean('Batch');
			$table->boolean('GraduationBatch');
			$table->boolean('Stream');
			$table->string('FirstPostpone');
			$table->string('SecondPostpone');
			$table->string('ThirdPostpone');
			$table->string('Dismissed');
			$table->string('Withdrawal');
			$table->boolean('GraduateExpectationsYear');
			$table->string('FirstBlockDrop');
			$table->string('FirstAcademicViolation');
			$table->string('SecondAcademicViolation');
			$table->string('ThirdAcademicViolation');
			$table->string('FirstAttemptAttendanceViolation');
			$table->string('SecondAttemptAttendanceViolation');
			$table->string('ThirdAttemptAttendanceViolation');
			$table->string('SecondBlockDrop');
			$table->string('ThirdBlockDrop');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('students');
	}

}
