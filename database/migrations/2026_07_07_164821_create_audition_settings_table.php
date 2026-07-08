<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('audition_settings', function (Blueprint $table) {
            $table->id();
            $table->string('form_url')->nullable();
            $table->dateTime('audition_start');
            $table->dateTime('audition_end');
            $table->string('tagline')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audition_settings');
    }
};
