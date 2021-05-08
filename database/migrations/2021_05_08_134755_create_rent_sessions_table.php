<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_sessions', function (Blueprint $table) {
            $table->id();
            $table->date("start_time")->default(date("Y-m-d H:i:s"));
            $table->date("end_time")->nullable();
            $table->string("start_address")->nullable();
            $table->string("end_address")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_sessions');
    }
}
