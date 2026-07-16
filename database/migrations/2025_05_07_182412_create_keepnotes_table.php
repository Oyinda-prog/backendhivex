<?php

use App\Models\Students;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeepnotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('keepnotes', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title',100);
        //     $table->longText('description');
        //     $table->integer('student_id');
        //     // $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade')->onUpdate('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keepnotes');
    }
}
