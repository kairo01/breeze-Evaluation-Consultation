<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('consultant_role')->constrained('users')->onDelete('cascade');
            $table->string('course');
            $table->enum('purpose', ['Transfer Interview', 'Return to Class Interview', 'Academic Problem', 'Graduating Interview and Exit Interview', 'Counseling']);
            $table->enum('meeting_mode', ['Face to Face', 'Online']);
            $table->enum('meeting_preference', ['Zoom', 'Whatsapp'])->nullable();
            $table->date('date');
            $table->time('time');
            $table->enum('status', ['Pending', 'Approved', 'Declined'])->default('Pending');
            $table->text('decline_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}

