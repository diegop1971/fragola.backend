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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id')->nullable(false);
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('description_short')->nullable();
            $table->double('price', 10, 2);
            $table->integer('minimum_quantity')->unsigned()->default(1)->nullable(false);
            $table->integer('low_stock_threshold')->unsigned()->nullable()->default(null);
            $table->boolean('low_stock_alert')->default(false)->nullable(false);
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
