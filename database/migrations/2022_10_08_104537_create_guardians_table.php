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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('fathers_name')->nullable();
            $table->string('fathers_phone')->nullable();
            $table->string('fathers_email')->nullable();
            $table->string('fathers_photo')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('mothers_phone')->nullable();
            $table->string('mothers_email')->nullable();
            $table->string('mothers_photo')->nullable();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students')->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardians');
    }
};
