<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beverages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('brewer');
            $table->string('abv');
            $table->string('type');
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('style')->nullable();
            $table->string('producer')->nullable();
        });

        Schema::create('venue_beverage', function (Blueprint $table) { // still have an id column
            $table->id();
            // create the article id column and foreign key
            $table->foreignId('venue_id')
                  ->constrained()
                  ->onDelete('cascade');
            // create the tag id column and foreign key
            $table->foreignId('beverage_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('speciality');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venue_beverage');
        Schema::dropIfExists('beverages');
    }
};
