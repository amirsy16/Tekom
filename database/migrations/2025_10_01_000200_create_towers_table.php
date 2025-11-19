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
        Schema::create('towers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->string('repeater_type')->nullable();
            $table->string('system')->nullable();
            $table->string('frequency_rx', 32)->nullable();
            $table->string('frequency_tx', 32)->nullable();
            $table->string('site_status')->nullable();
            $table->string('tower_structure')->nullable();
            $table->string('tower_height')->nullable();
            $table->unsignedTinyInteger('condition_bb')->nullable();
            $table->unsignedTinyInteger('condition_rr')->nullable();
            $table->unsignedTinyInteger('condition_rb')->nullable();
            $table->string('documentation')->nullable();
            $table->string('user')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['site_id', 'system']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('towers');
    }
};
