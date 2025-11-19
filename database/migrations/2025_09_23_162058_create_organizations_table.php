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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // POLDA, POLRES_JAMBI, dll
            $table->string('name'); // Polda Jambi, Polres Muaro Jambi
            $table->enum('type', ['POLDA', 'POLRESTA', 'POLRES', 'POLSEK', 'SATUAN', 'BIDANG']);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('organizations');
            $table->index(['type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
