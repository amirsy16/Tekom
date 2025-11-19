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
        Schema::create('equipment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // GTR8000, MX800, QUANTAR
            $table->string('category')->default('REPEATER'); // REPEATER, RADIO_LINK, TRUNKING
            $table->string('brand')->nullable(); // Motorola, Kenwood, dll
            $table->text('specifications')->nullable();
            $table->integer('warranty_months')->default(12);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['category', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_types');
    }
};
