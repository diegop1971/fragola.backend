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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_id')->index();
            $table->integer('status_type_id')->unsigned()->default(1)->nullable(false);
            $table->float('total_paid', 10, 2);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('status_type_id')->references('id')->on('order_status_types')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
