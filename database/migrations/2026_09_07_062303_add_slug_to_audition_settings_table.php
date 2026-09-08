<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('audition_settings', function (Blueprint $table) {
            $table->string('slug')->after('id')->nullable()->unique();
        });

        // Backfill existing row
        DB::table('audition_settings')->whereNull('slug')->update(['slug' => 'chapter-02']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audition_settings', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
