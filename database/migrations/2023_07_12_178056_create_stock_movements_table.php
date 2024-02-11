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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id')->index();
            $table->uuid('movement_type_id')->nullable(false)->constrained('stock_movement_types');
            $table->integer('quantity');
            $table->datetime('date');
            $table->text('notes')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            $table->foreign('movement_type_id')->references('id')->on('stock_movement_types')->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
