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
        Schema::create('deposit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deposit_calculator_id')->constrained()->cascadeOnDelete();
            $table->decimal('deposit_value', 12, 2)->default(0);
            $table->decimal('interest_rate', 5, 2)->default(0);
            $table->integer('term_months');
            $table->decimal('final_balance', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_logs');
    }
};
