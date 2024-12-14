<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusySlotsTable extends Migration
{
    public function up()
    {
        Schema::create('busy_slots', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->time('from')->nullable();
            $table->time('to')->nullable();
            $table->boolean('busy_all_day')->default(false);
            $table->string('consultant_role');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('busy_slots');
    }
}
