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
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_id')->nullable(false);
            $table->string('alias');
            $table->string('company')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('postcode');
            $table->string('city');
            $table->string('phone')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('other')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
