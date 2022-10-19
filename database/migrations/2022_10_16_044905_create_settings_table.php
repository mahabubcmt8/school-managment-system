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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            // Basic
            $table->string('system_name')->nullable();
            $table->string('system_title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('address')->nullable()->default('text');
            $table->longText('system_description')->nullable()->default('text');
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            // Social
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            // Theme
            $table->string('side_bg_color')->nullable();
            $table->string('side_text_color')->nullable();
            $table->string('nav_bg_color')->nullable();
            $table->string('nav_text_color')->nullable();
            // System
            $table->string('timezone')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('app_url')->nullable();
            $table->string('db_host')->nullable();
            $table->string('db_port')->nullable();
            $table->string('db_name')->nullable();
            $table->string('db_username')->nullable();
            $table->string('db_password')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
