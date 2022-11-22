<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_user', function (Blueprint $table) {
            $table->id('library_user_id');
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('mobile_number',10)->unique();
            $table->string('email',255)->unique();
            $table->string('age',3);
            $table->enum('gender',["m","f","o"]);
            $table->string('city',255);
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
        Schema::dropIfExists('library_user');
    }
}
