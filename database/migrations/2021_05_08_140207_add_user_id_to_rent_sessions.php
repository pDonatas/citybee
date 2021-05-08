<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToRentSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_sessions', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
            $table->integer('car_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_sessions', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('car_id');
        });
    }
}
