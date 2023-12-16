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
        Schema::create('ecuses', function (Blueprint $table) {
            $table->id();
            // $table->foreign('model')->references('id')->on('mac_models');
            $table->foreignId('mac_models_id')->default(1)->constrained(
                table: 'mac_models', indexName: 'ecus_model_id'
            )->onDelete('cascade');
            $table->string('name');
            $table->string('app');
            $table->string('controller');
            $table->string('software_version');
            $table->string('manufactor_hw_number');
            $table->string('serial')->unique();
            $table->string('vin')->unique()->nullable();
            $table->bigInteger('flash_size');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecuses');
    }
};
