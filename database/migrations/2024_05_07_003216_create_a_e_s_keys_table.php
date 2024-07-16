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
        Schema::create('aes_keys', function (Blueprint $table) {
            $table->id();
            $table->binary('key');
            $table->unsignedBigInteger("firmware_id");
            $table->foreign('firmware_id')->references('id')->on('firmwares')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aes_keys');
    }
};
