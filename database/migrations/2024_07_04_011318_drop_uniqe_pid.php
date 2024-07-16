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
        Schema::table('freeze_frames', function (Blueprint $table) {
            $table->dropUnique('freeze_frames_pid_unique');
        });
        Schema::table('monitors', function (Blueprint $table) {
            $table->dropUnique('monitors_pid_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freeze_frames', function (Blueprint $table) {
            $table->unique('pid');
        });
        Schema::table('monitors', function (Blueprint $table) {
            $table->unique('pid');
        });
    }
};
