<?php

use App\Enums\TroubleTypes;
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
        Schema::create('troubles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('dtc');
            $table->foreign('dtc')->references('id')->on('dtcs')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('type', array_keys(TroubleTypes::toArray()))->default(TroubleTypes::Confirmed);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('troubles');
    }
};
