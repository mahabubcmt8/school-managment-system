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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('username');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id');
            $table->string('roll_no');
            $table->string('registration_no')->nullable();
            $table->date('dob');
            $table->string('gender');
            $table->longText('address')->nullable()->default('text');
            $table->string('picture')->nullable();
            $table->timestamps();
            $table->foreign('class_id')->references('id')->on('classes')->nullable()->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
