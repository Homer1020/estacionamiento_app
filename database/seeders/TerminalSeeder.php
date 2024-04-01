<?php

namespace Database\Seeders;

use App\Models\Ubicacion;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TerminalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehiculos = Vehiculo::inRandomOrder()->limit(10)->get();

        foreach($vehiculos as $vehiculo) {
            $ubicacion = Ubicacion::where('ocupado', '=', false)->inRandomOrder()->first();
            $vehiculo->transacciones()->create([
                'ubicacion_id' => $ubicacion->id,
                'fecha_entrada' => Carbon::now()->setTimezone('America/Caracas')->subHours(2)->toDateTimeString()
            ]);
            $ubicacion->ocupado = true;
            $ubicacion->save();
            $vehiculo->en_transaccion = true;
        }
    }
}
