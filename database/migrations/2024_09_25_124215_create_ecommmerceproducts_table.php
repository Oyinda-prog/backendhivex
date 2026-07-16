<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommmerceproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommmerceproducts', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('price');
            $table->string('description');
            $table->string('image')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('name');
            $table->integer('commerceseller_id');
            $table->timestamps();
        }); 
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecommmerceproducts');
    }
}
