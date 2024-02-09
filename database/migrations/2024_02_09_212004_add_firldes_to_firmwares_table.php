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
            $table->string('firmwareFile')->after('version');
            $table->boolean('priority')->default(false)->after('firmwareFile');
            $table->boolean('schedule')->default(false)->after('priority');
            $table->dateTime('upgradeDate')->nullable()->after('schedule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('firmwares', function (Blueprint $table) {
            $table->dropColumn('firmwareFile');
            $table->dropColumn('priority');
            $table->dropColumn('schedule');
            $table->dropColumn('upgradeDate');
        });
    }
};
