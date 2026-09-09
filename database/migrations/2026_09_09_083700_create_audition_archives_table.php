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
        Schema::create('audition_archives', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->dateTime('audition_start');
            $table->dateTime('audition_end');
            $table->timestamps();
        });

        $permissions = [
            'ViewAny:AuditionArchive',
            'View:AuditionArchive',
            'Create:AuditionArchive',
            'Update:AuditionArchive',
            'Delete:AuditionArchive',
            'DeleteAny:AuditionArchive',
            'Restore:AuditionArchive',
            'RestoreAny:AuditionArchive',
            'ForceDelete:AuditionArchive',
            'ForceDeleteAny:AuditionArchive',
            'Replicate:AuditionArchive',
            'Reorder:AuditionArchive',
        ];

        foreach ($permissions as $perm) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        $role = \Spatie\Permission\Models\Role::where('name', 'super_admin')->first();
        if ($role) {
            $role->syncPermissions(\Spatie\Permission\Models\Permission::all());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audition_archives');
    }
};
