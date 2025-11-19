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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('asset_code')->unique(); // Auto generated: ALK-2025-0001
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('site_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('equipment_type_id')->constrained()->cascadeOnDelete();
            $table->string('serial_number')->nullable();
            $table->year('installation_year');
            $table->enum('condition', ['BB', 'RR', 'RB'])->default('BB'); // Baik, Rusak Ringan, Rusak Berat
            $table->integer('quantity')->default(1);
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->date('last_maintenance')->nullable();
            $table->date('next_maintenance')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['condition', 'is_active']);
            $table->index(['installation_year', 'condition']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
