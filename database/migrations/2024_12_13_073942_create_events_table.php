<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // Event title
            $table->text('description')->nullable(); // Event description
            $table->timestamp('start'); // Start time of the event
            $table->timestamp('end')->nullable(); // End time of the event
            $table->timestamps(); // For created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
