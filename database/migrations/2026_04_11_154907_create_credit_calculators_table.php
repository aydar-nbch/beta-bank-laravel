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
        Schema::create('credit_calculators', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название (Ипотека, Автокредит)
            $table->decimal('interest_rate', 5, 2); // Годовая ставка (например, 9.60)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_calculator');
    }
};
