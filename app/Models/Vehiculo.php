<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $guarded = [];

    public function transacciones() {
        return $this->hasMany(Transaccion::class);
    }

    public function propietario() {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
