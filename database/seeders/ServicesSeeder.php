<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'servicio' => 'Lavado del coche',
                'costo_x_hora' => 30,
                'descripcion' => 'Se lava el coche.'
            ],
            [
                'servicio' => 'Aparcamiento con techo',
                'costo_x_hora' => 5.00,
                'descripcion' => 'Proteja su vehículo de las inclemencias del tiempo con nuestro aparcamiento cubierto.'
            ],
            [
                'servicio' => 'Lavado a mano',
                'costo_x_hora' => 20.00,
                'descripcion' => 'Deje su vehículo reluciente con nuestro servicio de lavado a mano completo.'
            ],
            [
                'servicio' => 'Detallado interior',
                'costo_x_hora' => 35.00,
                'descripcion' => 'Limpieza profunda del interior de su vehículo, incluyendo alfombras, asientos y tablero.'
            ],
            [
                'servicio' => 'Pulido y encerado',
                'costo_x_hora' => 40.00,
                'descripcion' => 'Proteja la pintura de su vehículo y déjelo con un brillo radiante.'
            ],
            [
                'servicio' => 'Revisión de neumáticos',
                'costo_x_hora' => 15.00,
                'descripcion' => 'Revisión de la presión, desgaste y estado general de sus neumáticos.'
            ],
            [
                'servicio' => 'Cambio de aceite',
                'costo_x_hora' => 45.00,
                'descripcion' => 'Mantenga el motor de su vehículo en óptimas condiciones con un cambio de aceite regular.'
            ],
            [
                'servicio' => 'Rotación de neumáticos',
                'costo_x_hora' => 25.00,
                'descripcion' => 'Prolongue la vida útil de sus neumáticos con una rotación regular.'
            ],
            [
                'servicio' => 'Carga de batería',
                'costo_x_hora' => 10.00,
                'descripcion' => 'Arranque su vehículo sin problemas con nuestro servicio de carga de batería.'
            ],
            [
                'servicio' => 'Asistencia en carretera',
                'costo_x_hora' => 50.00,
                'descripcion' => 'Asistencia 24/7 en caso de avería o accidente.'
            ],
            [
                'servicio' => 'Alquiler de vehículos',
                'costo_x_hora' => 30.00, // Varía según el vehículo
                'descripcion' => 'Alquile un vehículo para sus necesidades específicas.'
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
