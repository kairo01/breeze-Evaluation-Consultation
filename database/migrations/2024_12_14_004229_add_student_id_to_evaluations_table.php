<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id'); // Add this column
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade'); // Create foreign key relation
        });
    }
    
    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropForeign(['student_id']); // Drop foreign key if rolling back
            $table->dropColumn('student_id'); // Drop the student_id column
        });
    }
    
};
