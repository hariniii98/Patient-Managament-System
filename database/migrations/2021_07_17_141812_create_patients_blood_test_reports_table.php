<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsBloodTestReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_blood_test_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient_id');
            $table->decimal('glucose');
            $table->decimal('insulin_fasting');
            $table->decimal('albumin');
            $table->decimal('calcium');
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
        Schema::dropIfExists('patients_blood_test_reports');
    }
}
