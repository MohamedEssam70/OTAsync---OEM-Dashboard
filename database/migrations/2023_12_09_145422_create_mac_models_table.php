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
        Schema::create('mac_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mac_id')->default(1)->constrained(
                table: 'mac_types', indexName: 'models_type_id'
            );
            $table->string('name')->unique()->nullable();
            $table->string('serial')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mac_models');
    }
};
