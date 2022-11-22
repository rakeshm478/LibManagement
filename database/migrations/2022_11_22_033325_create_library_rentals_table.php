<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_rentals', function (Blueprint $table) {
            $table->id('rental_id');
            $table->string('book_name',255)->unique();
            $table->string('user_id',255);
            $table->string('take_off_date',255);
            $table->string('take_off_time',255);
            $table->string('return_date',255)->nullable();
            $table->string('return_time',255)->nullable();
            $table->string('damage_remarks',255)->nullable();
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
        Schema::dropIfExists('library_rentals');
    }
}
