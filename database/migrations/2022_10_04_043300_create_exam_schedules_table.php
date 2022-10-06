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
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('class_room_id');
            $table->unsignedBigInteger('subject_id');
            $table->date('exam_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->foreign('exam_id')->references('id')->on('exams')->nullable()->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->nullable()->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->nullable()->onDelete('cascade');
            $table->foreign('class_room_id')->references('id')->on('class_rooms')->nullable()->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->nullable()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_schedules');
    }
};
