<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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
            $table->string('type');
            $table->string('style');
            $table->string('brewery');
            $table->string('country');
            $table->float('abv');
        });

        Schema::create("beverage_venue", function (Blueprint $table) {
            $table->id();
            $table->foreignId("venue_id")
                ->constrained()
                ->onDelete("cascade");
            $table->foreignId("beverage_id")
                ->constrained()
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beverage_venue');
        Schema::dropIfExists('beverages');
    }
};
