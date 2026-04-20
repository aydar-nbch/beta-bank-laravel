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
        Schema::create('credit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_calculator_id')->constrained()->cascadeOnDelete();
            $table->decimal('property_value', 12, 2);
            $table->decimal('down_payment', 12, 2);
            $table->integer('term_months');
            $table->decimal('monthly_payment', 12, 2);
            $table->decimal('required_income', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_logs');
    }
};
