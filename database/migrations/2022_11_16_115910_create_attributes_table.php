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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
        });

        Schema::create("attribute_venue", function (Blueprint $table) {
            $table->id();
            $table->foreignId("venue_id")
                ->constrained()
                ->onDelete("cascade");
            $table->foreignId("attribute_id")
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
        Schema::dropIfExists('attribute_venue');
        Schema::dropIfExists('attributes');
    }
};
