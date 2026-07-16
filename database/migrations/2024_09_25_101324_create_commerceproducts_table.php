<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommerceproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('commerceproducts', function (Blueprint $table) {
            // $table->increments('product_id');
            // $table->integer('price');
            // $table->string('description');
            // $table->string('image')->nullable();
            // $table->integer('quantity')->nullable();
            // $table->string('name');
            // $table->integer('commerceseller_id');
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
        Schema::dropIfExists('commerceproducts');
    }
}
