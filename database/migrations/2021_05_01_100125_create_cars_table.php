<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('model');
            $table->integer('year');
            $table->string('status');
            $table->date('registration_date')->nullable();
            $table->float('pay_per_minute')->nullable();
            $table->string('number_plate');
            $table->date('maintenance_end');
            $table->date('insurance_end');
            $table->string('registration_certificate_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
