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

    public function servicios() {
        return $this->belongsToMany(Service::class, 'servicios_transaccion', 'transaccion_id', 'servicio_id');
    }

    public function calcular_costo_aparcamiento(): int {
        if(!$this->fecha_salida) {
            $this->fecha_salida = Carbon::now()->setTimezone('America/Caracas')->toDateTimeString();
            $this->save();
        }
        $startDate = Carbon::parse($this->fecha_entrada)->setTimezone('America/Caracas');
        $endDate = Carbon::parse($this->fecha_salida)->setTimezone('America/Caracas');
        $costo_x_hora = $this->ubicacion->costo_x_hora;
        $horas_estacionado = $endDate->diff($startDate)->h;

        return $horas_estacionado * $costo_x_hora;
    }
}
