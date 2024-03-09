<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transaccion() {
        return $this->belongsTo(Transaccion::class);
    }

    public function servicios() {
        return $this->belongsToMany(Service::class, 'servicios_factura', 'factura_id', 'servicio_id');
    }
}
