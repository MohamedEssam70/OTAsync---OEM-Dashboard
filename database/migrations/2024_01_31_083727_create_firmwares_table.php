<?php

use App\Enums\FirmwareStatus;
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
        Schema::create('firmwares', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();
            $table->string('version')->nullable();
            $table->enum('status', array_keys(FirmwareStatus::toArray()))->default(FirmwareStatus::Valid);
            $table->string('valid_untill')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firmwares');
    }
};
