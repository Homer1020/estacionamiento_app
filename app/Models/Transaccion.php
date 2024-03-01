<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaccion extends Model
{
    public $table = 'transacciones';
    protected $guarded = [];
    public $timestamps = false;

    use SoftDeletes;

    public function vehiculo() {
        return $this->belongsTo(Vehiculo::class);
    }

    public function ubicacion() {
        return $this->belongsTo(Ubicacion::class);
    }

    public function factura() {
        return $this->hasOne(Factura::class);
    }

    public function calcular_costo_aparcamiento(): int {
        $startDate = Carbon::parse($this->fecha_entrada);
        $endDate = Carbon::parse($this->fecha_salida);
        $costo_x_hora = $this->ubicacion->costo_x_hora;
        $horas_estacionado = $endDate->diff($startDate)->h;
        return $horas_estacionado * $costo_x_hora;
    }
}
