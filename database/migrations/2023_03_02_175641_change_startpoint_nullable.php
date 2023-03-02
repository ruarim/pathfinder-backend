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
        Schema::table('paths', function (Blueprint $table) {
            $precision = 18;
            $scale = 15;

            $table->string('startpoint_name')->nullable()->change();
            $table->decimal('startpoint_lat', $precision, $scale)->nullable()->change();
            $table->decimal('startpoint_long', $precision, $scale)->nullable()->change();
        });
    }
};
