<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->references('id')->on('vehiculos');
            $table->foreignId('ubicacion_id')->references('id')->on('ubicaciones');
            $table->dateTime('fecha_entrada')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->dateTime('fecha_salida')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transacciones', function(Blueprint $table) {
            $table->dropForeign('transacciones_ubicacion_id_foreign');
            $table->dropForeign('transacciones_vehiculo_id_foreign');
        });
        Schema::dropIfExists('transacciones');
    }
};
