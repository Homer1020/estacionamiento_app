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
        Schema::create('servicios_factura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->nullable()->references('id')->on('servicios');
            $table->foreignId('factura_id')->nullable()->references('id')->on('facturas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios_factura', function(Blueprint $table) {
            $table->dropForeign('servicios_factura_factura_id_foreign');
            $table->dropForeign('servicios_factura_servicio_id_foreign');
        });
        Schema::dropIfExists('servicios_factura');
    }
};
