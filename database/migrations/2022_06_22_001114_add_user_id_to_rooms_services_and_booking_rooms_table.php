<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToRoomsServicesAndBookingRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });
        Schema::table('booking_rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('booking_rooms', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
