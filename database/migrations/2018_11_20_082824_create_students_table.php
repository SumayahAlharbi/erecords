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
			$table->string('FirstAcademicViolation')->nullable();
			$table->string('SecondAcademicViolation')->nullable();
			$table->string('ThirdAcademicViolation')->nullable();
			$table->string('FirstAttemptAttendanceViolation')->nullable();
			$table->string('SecondAttemptAttendanceViolation')->nullable();
			$table->string('ThirdAttemptAttendanceViolation')->nullable();
			$table->string('SecondBlockDrop');
			$table->string('ThirdBlockDrop');
			$table->string('Gender');
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
