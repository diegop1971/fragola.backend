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
        Schema::create('product_price_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_product_price')->index();
            $table->uuid('id_product')->index();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->decimal('special_price', 10, 2);
            $table->date('discount_start_date');
            $table->date('discount_end_date');
            $table->integer('maximum_quantity')->unsigned()->default(1)->nullable(false);
            $table->integer('tax_rules_group')->unsigned()->default(1)->nullable(false);
            $table->integer('currency')->unsigned()->default(1)->nullable(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
            
            $table->foreign('id_product_price')->references('id')->on('product_prices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_price_history');
    }
};
