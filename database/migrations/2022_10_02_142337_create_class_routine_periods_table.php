<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_routine_periods', function (Blueprint $table) {
            $table->id();
            $table->integer('routine_no');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('class_room_id');
            $table->unsignedBigInteger('teacher_id');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->timestamps();
            $table->foreign('subject_id')->references('id')->on('subjects')->nullable()->onDelete('cascade');
            $table->foreign('class_room_id')->references('id')->on('class_rooms')->nullable()->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_routine_periods');
    }
};
