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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->foreignId('transaccion_id')->references('id')->on('transacciones');
            $table->float('monto_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facturas', function(Blueprint $table) {
            $table->dropForeign('facturas_transaccion_id_foreign');
        });
        Schema::dropIfExists('facturas');
    }
};
