@csrf
<x-adminlte-input
  name="servicio"
  label="Servicio"
  value="{{ $servicio->servicio }}"
/>

<x-adminlte-input
  name="costo_x_hora"
  label="Costo por hora"
  type="number"
  value="{{ $servicio->costo_x_hora }}"
/>

<x-adminlte-textarea
  name="descripcion"
  placeholder="Inserte la descripción"
  label="Descripción"
  rows="5"
>{{ $servicio->descripcion }}</x-adminlte-textarea>