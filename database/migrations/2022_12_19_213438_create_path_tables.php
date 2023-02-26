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
        Schema::create('paths', function (Blueprint $table) {
            $precision = 18;
            $scale = 15;

            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('startpoint_name');
            $table->decimal('startpoint_lat', $precision, $scale);
            $table->decimal('startpoint_long', $precision, $scale);
            $table->string('endpoint_name')->nullable();
            $table->decimal('endpoint_lat', $precision, $scale)->nullable();
            $table->decimal('endpoint_long', $precision, $scale)->nullable();
            $table->double('rating')->nullable();
            $table->boolean('is_public')->default(false);
        });

        Schema::create("path_venue", function (Blueprint $table) {
            $table->id();
            $table->foreignId("path_id")
                ->constrained()
                ->onDelete("cascade");
            $table->foreignId("venue_id")
                ->constrained()
                ->onDelete("cascade");
            $table->integer('stop_number');
        });

        Schema::create("path_user", function (Blueprint $table) {
            $table->id();
            $table->foreignId("path_id")
                ->constrained()
                ->onDelete("cascade");
            $table->foreignId("user_id")
                ->constrained()
                ->onDelete("cascade");
            $table->boolean('is_creator')->default(false);
            $table->boolean('has_completed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('path_user');
        Schema::dropIfExists('path_venue');
        Schema::dropIfExists('paths');
    }
};
