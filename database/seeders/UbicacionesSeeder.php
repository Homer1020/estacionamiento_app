<?php

namespace Database\Seeders;

use App\Models\Ubicacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UbicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ubications = [
            [
                'ubicacion'     => 'A-01',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'A-02',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'A-03',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'A-04',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'A-05',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'B-01',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'B-02',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'B-03',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'B-04',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'B-05',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'B-06',
                'costo_x_hora'  => 20
            ],
            [
                'ubicacion'     => 'B-07',
                'costo_x_hora'  => 20
            ],
        ];
        foreach ($ubications as $ubication) {
            Ubicacion::create($ubication);
        }
    }
}
