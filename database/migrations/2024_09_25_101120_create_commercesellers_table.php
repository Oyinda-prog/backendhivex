<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercesellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('commercesellers', function (Blueprint $table) {
            // $table->increments('commerceseller_id');
            // $table->string('fullname');
            // $table->string('phonenumber');
            // $table->string('email')->unique();
            // $table->string('password');
            // $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commercesellers');
    }
}
