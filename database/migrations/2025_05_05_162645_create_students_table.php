<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //public function up()
    //{
        // Schema::create('students', function (Blueprint $table) {
        //     $table->increments('student_id');
        //     $table->string('fullname');
        //     $table->string('password');
        //     $table->string('email',100)->unique();
        //     $table->timestamps();
        // });
   // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
   
    public function up()
{
    Schema::create('students_table', function (Blueprint $table) {
        $table->increments('student_id');
        $table->string('fullname');
        $table->string('email', 100)->unique();
        $table->string('password');
        $table->string('phonenumber');
        $table->text('profilepicture')->nullable();
        $table->string('cloudinary_public_id')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('students_table');
}
}
