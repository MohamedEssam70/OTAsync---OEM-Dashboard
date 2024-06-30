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
        Schema::create('monitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('pid', 3)->unique();
            $table->string('description', 64)->default('No available in trial');
            $table->float('value');
            $table->enum('unit', array_keys(Units::toArray()))->default(Units::Undefined);
            $table->float('min');
            $table->float('max');
            $table->integer('samples');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitors');
    }
};
