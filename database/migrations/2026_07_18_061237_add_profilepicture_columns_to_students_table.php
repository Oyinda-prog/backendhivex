<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfilepictureColumnsToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students_table', function (Blueprint $table) {
              $table->text('profilepicture')->nullable()->after('password');
            $table->string('cloudinary_public_id')->nullable()->after('profilepicture');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students_table', function (Blueprint $table) {
             $table->dropColumn([
                'profilepicture',
                'cloudinary_public_id'
            ]);
        });
    }
}
