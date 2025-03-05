<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, ensure the columns exist with the correct type
        if (Schema::hasColumn('appointments', 'is_completed')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->integer('is_completed')->default(0)->change();
            });
        }
        
        if (Schema::hasColumn('appointments', 'not_completed')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->integer('not_completed')->default(0)->change();
            });
        }
        
        // Fix any existing data to ensure consistency
        DB::statement('UPDATE appointments SET is_completed = 1 WHERE is_completed = true');
        DB::statement('UPDATE appointments SET is_completed = 0 WHERE is_completed = false');
        DB::statement('UPDATE appointments SET not_completed = 1 WHERE not_completed = true');
        DB::statement('UPDATE appointments SET not_completed = 0 WHERE not_completed = false');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to revert as we're just ensuring data consistency
    }
};

