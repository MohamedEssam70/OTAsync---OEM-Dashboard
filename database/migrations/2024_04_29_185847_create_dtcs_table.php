<?php

use App\Enums\DTCsTypes;
use App\Enums\Manufactors;
use App\Enums\SystemsTypes;
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
        Schema::create('dtcs', function (Blueprint $table) {
            $table->id();
            $table->enum('type', array_keys(DTCsTypes::toArray()))->default(DTCsTypes::U);
            $table->string('code', 4);
            $table->enum('system', array_keys(SystemsTypes::toArray()))->default(SystemsTypes::Undefine);
            $table->enum('manufactor', array_keys(Manufactors::toArray()))->default(Manufactors::Generic);
            $table->string('description', 64)->default('No available in trial');
            $table->timestamps();
            $table->unique(['type', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtcs');
    }
};
