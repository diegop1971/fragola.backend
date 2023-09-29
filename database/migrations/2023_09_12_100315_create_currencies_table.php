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
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('symbol', 3);
            $table->string('name', 255);
            $table->timestamps();
        });

        // Crea algunas monedas de ejemplo
        $currencies = [
            ['symbol' => 'USD', 'name' => 'Dólar estadounidense'],
            ['symbol' => 'EUR', 'name' => 'Euro'],
            ['symbol' => 'GBP', 'name' => 'Libra esterlina'],
        ];

        foreach ($currencies as $currency) {
            DB::table('currencies')->insert($currency);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
