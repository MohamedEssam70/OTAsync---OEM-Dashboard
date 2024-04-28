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
            $table->dropColumn('critical');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('firmwares', function (Blueprint $table) {
            $table->boolean('critical')->default(false)->after('valid_untill');
        });
    }
};
