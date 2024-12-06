<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role', 255)->change(); // Increase the length of the role column
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role', 50)->change(); // Revert to the previous length if needed
    });
}

};
