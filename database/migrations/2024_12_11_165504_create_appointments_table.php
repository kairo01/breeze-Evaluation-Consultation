<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            // Foreign keys to users table
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('consultant_role')->constrained('users')->onDelete('cascade');
            $table->string('course');
            $table->enum('purpose', ['Transfer', 'Return to Class', 'Academic', 'Graduating', 'Personal']);
            $table->enum('meeting_mode', ['Face to Face', 'Online']);
            $table->enum('meeting_preference', ['Zoom', 'Gmeet'])->nullable();
            $table->dateTime('date_time');
            $table->enum('status', ['Pending', 'Approved', 'Declined'])->default('Pending');
            $table->text('decline_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
