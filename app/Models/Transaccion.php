<?php

namespace App\Models;

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
}
