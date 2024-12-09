<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Ensure the user_id column does not already exist before adding
            if (!Schema::hasColumn('appointments', 'user_id')) {
                // Add the user_id column to appointments
                $table->unsignedBigInteger('user_id')->after('id');
            }
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop the user_id column if it exists
            if (Schema::hasColumn('appointments', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
}
