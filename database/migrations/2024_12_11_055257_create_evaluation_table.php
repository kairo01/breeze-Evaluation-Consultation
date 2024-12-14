<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationTable extends Migration
{
    public function up()
{
    Schema::create('evaluations', function (Blueprint $table) {
        $table->unsignedBigInteger('student_id'); // Add this column
        $table->string('teacher_name');
        $table->string('subject');
        $table->json('teaching_skills');
        $table->json('facilities');
        $table->string('teacher_comment')->default('');       // New column for teacher comments
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
