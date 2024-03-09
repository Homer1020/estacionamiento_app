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
        Schema::create('servicios_transaccion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->nullable()->references('id')->on('servicios');
            $table->foreignId('transaccion_id')->nullable()->references('id')->on('transacciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios_transaccion', function(Blueprint $table) {
            $table->dropForeign('servicios_transaccion_servicio_id_foreign');
            $table->dropForeign('servicios_transaccion_transaccion_id_foreign');
        });
        Schema::dropIfExists('servicios_factura');
    }
};
