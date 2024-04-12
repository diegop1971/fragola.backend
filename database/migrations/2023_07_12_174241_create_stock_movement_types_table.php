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
        Schema::create('stock_movement_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('movement_type', 50);
            $table->string('short_name', 30);
            $table->text('description')->nullable();
            $table->text('stock_impact')->nullable();
            $table->boolean('is_positive')->default(false);
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movement_types');
    }
};
