<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    public $table = 'ubicaciones';
    protected $guarded = [];
    public $timestamps = false;

    public function transacciones() {
        return $this->hasMany(Transaccion::class);
    }
}
