<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('booking_rooms', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('booking_room_customers', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('booking_room_services', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('group_customers', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('logs', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('lost_items', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('options', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        
        Schema::table('revenue_and_expenditures', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('shifts', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });

        Schema::table('type_rooms', function (Blueprint $table) {
            $table->bigInteger('branch_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('booking_rooms', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('booking_room_customers', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('booking_room_services', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('group_customers', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('logs', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('lost_items', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });
        
        Schema::table('revenue_and_expenditures', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });

        Schema::table('shifts', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });
        
        Schema::table('type_rooms', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });
    }
}
