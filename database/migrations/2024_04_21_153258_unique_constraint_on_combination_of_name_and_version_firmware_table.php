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
        Schema::table('firmwares', function (Blueprint $table) {
            // Add a unique constraint on combination of name and version columns
            $table->unique(['name', 'version'], 'name_version_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('firmwares', function (Blueprint $table) {
            // Remove the unique constraint
            $table->dropUnique('name_version_unique');
        });
    }
};
