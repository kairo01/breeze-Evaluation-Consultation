<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Check if the user_id column exists before adding the foreign key
            if (Schema::hasColumn('appointments', 'user_id')) {
                // Add the foreign key constraint
                $table->foreign('user_id') // Name of the column in appointments
                      ->references('id')  // Name of the column in users table
                      ->on('users')       // Table to reference (users)
                      ->onDelete('cascade'); // What to do on user delete (optional: cascade)
            }
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop the foreign key constraint if it exists
            if (Schema::hasColumn('appointments', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
        });
    }
}
