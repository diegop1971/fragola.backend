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
        Schema::create('product_prices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_product')->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->decimal('special_price', 10, 2);
            $table->date('discount_start_date');
            $table->date('discount_end_date');
            $table->integer('maximum_quantity')->unsigned()->default(1)->nullable(false);
            $table->integer('tax_rules_group')->unsigned()->default(1)->nullable(false);
            $table->integer('id_currency')->unsigned()->default(1)->nullable(false);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_currency')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
