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
        Schema::create('audition_contents', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['timeline', 'requirement', 'benefit', 'about_card', 'contact_link']);
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('label')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audition_contents');
    }
};
