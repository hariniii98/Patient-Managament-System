<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodTestParameters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_test_parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('blood_test_name');
            $table->decimal('min_optimal_range');
            $table->decimal('max_optimal_range');
            $table->string('units_of_measurement')->nullable();
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
        Schema::dropIfExists('blood_test_parameters');
    }
}
