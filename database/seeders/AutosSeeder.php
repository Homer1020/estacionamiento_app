<?php

namespace Database\Seeders;

use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class AutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matriculas = array(
            'AB1234CD',
            'M5678EF',
            '9999XYZ',
            'BC0001AA',
            'ZZ9999XYZ',
            'ABC1234',
            'XYZS9999',
            'BM0000AA',
            'SZ9999XYZ',
            'H1234FG',
        );
        foreach ($matriculas as $matricula) {
            Vehiculo::create([
                'matricula' => $matricula
            ]);
        }
    }
}
