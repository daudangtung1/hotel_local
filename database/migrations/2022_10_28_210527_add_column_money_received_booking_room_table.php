<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMoneyReceivedBookingRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_rooms', function (Blueprint $table) {
            $table->bigInteger('money_received')->nullable()->default(0);
            $table->bigInteger('money_unpaid')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_rooms', function (Blueprint $table) {
            $table->dropColumn(['money_received', 'money_unpaid']);
        });
    }
}
