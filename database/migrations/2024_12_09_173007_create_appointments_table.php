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
            $table->string('name'); // Store student's name
            $table->string('course');
            $table->string('purpose');
            $table->enum('meeting_mode', ['Face to face', 'Online']);
            $table->enum('meeting_preference', ['Zoom', 'Gmeet'])->nullable();
            $table->dateTime('appointment_date_time');
            $table->enum('consultant', ['Admin Consultant', 'Department Head'])->nullable();
            $table->enum('status', ['Pending', 'Accepted', 'Declined'])->default('Pending');
            $table->text('decline_reason')->nullable(); // Reason for decline if applicable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
