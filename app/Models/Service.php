<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $table = 'servicios';
    protected $guarded = [];
    public $timestamps = false;

    public function facturas() {
        return $this->belongsToMany(Factura::class, 'servicios_factura');
    }
}
