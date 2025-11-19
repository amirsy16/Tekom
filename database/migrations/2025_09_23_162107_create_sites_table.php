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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Site Polda Jambi
            $table->string('location'); // SST 42 M, GWT 52 M
            $table->enum('ownership', ['POLRI', 'TELKOM', 'TVRI', 'INDOSAT', 'SWASTA', 'LAINNYA']);
            $table->string('tower_height')->nullable(); // 42 M, 72 M, dll
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['ownership', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
