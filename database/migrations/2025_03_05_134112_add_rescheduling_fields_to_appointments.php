<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the columns already exist before adding them
        if (!Schema::hasColumn('appointments', 'is_rescheduled')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->boolean('is_rescheduled')->default(false);
            });
        }
        
        if (!Schema::hasColumn('appointments', 'original_appointment_id')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->unsignedBigInteger('original_appointment_id')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('is_rescheduled');
            $table->dropColumn('original_appointment_id');
        });
    }
};

