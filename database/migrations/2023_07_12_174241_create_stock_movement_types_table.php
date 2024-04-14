<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('is_positive_system')->default(0);
            $table->integer('is_positive_physical')->default(0);
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE stock_movement_types ADD CONSTRAINT check_is_positive_system CHECK (is_positive_system IN (-1, 0, 1))");
        DB::statement("ALTER TABLE stock_movement_types ADD CONSTRAINT check_is_positive_physical CHECK (is_positive_physical IN (-1, 0, 1))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movement_types');
    }
};
