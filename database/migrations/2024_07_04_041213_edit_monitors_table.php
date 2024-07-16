<?php

use App\Enums\Units;
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
        Schema::table('monitors', function (Blueprint $table) {
            $table->dropColumn('pid');
            $table->dropColumn('description');
            $table->dropColumn('value');
            $table->dropColumn('unit');
            $table->dropColumn('min');
            $table->dropColumn('max');
            $table->dropColumn('samples');
            $table->json('data')->after('session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monitors', function (Blueprint $table) {
            $table->dropColumn('data');
            $table->string('pid', 3);
            $table->string('description', 64)->default('No available in trial');
            $table->float('value');
            $table->enum('unit', array_keys(Units::toArray()))->default(Units::Undefined);
            $table->float('min');
            $table->float('max');
            $table->integer('samples');
        });
    }
};
