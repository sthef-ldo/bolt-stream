@extends('layouts.pagina-base')

@section('content')

    <h1>{{ $pelicula->nombre }}</h1>

    <p><strong>Año:</strong> {{ $pelicula->anio ?? 'Desconocido' }}</p>

    <p><strong>Descripción:</strong></p>
    <p>{{ $pelicula->descripcion }}</p>

    @if ($pelicula->portada)
        <p><strong>Portada:</strong></p>
        <img src="{{ $pelicula->portada }}" alt="Portada" width="200">
    @endif

    @if ($pelicula->link_trailer)
        <p><strong>Trailer:</strong></p>
        <a href="{{ $pelicula->link_trailer }}" target="_blank">Ver trailer</a>
    @endif

    @if ($pelicula->link_pelicula)
        <p><strong>Ver película:</strong></p>
        <a href="{{ $pelicula->link_pelicula }}" target="_blank">Reproducir</a>
    @endif

    {{-- SOLO USUARIOS LOGUEADOS PUEDEN CAMBIAR ESTATUS --}}
    @auth
        <hr>
        <h3>Mi estatus</h3>

        <form action="{{ route('peliculas.estatus.store', $pelicula) }}" method="POST">
            @csrf

            <label for="estatus"><strong>Estatus:</strong></label>
            <select name="estatus" id="estatus">
                <option value="sin_estatus" {{ optional($estatusActual)->estatus === 'sin_estatus' ? 'selected' : '' }}>
                    Sin estatus
                </option>
                <option value="por_ver" {{ optional($estatusActual)->estatus === 'por_ver' ? 'selected' : '' }}>
                    Por ver
                </option>
                <option value="vista" {{ optional($estatusActual)->estatus === 'vista' ? 'selected' : '' }}>
                    Vista
                </option>
                <option value="abandonada" {{ optional($estatusActual)->estatus === 'abandonada' ? 'selected' : '' }}>
                    Abandonada
                </option>
            </select>

            <label style="margin-left: 10px;">
                <input type="checkbox" name="favorita" value="1"
                    {{ optional($estatusActual)->favorita ? 'checked' : '' }}>
                Marcar como favorita
            </label>

            <button type="submit" class="btn btn-sm btn-primary" style="margin-left: 10px;">
                Guardar estatus
            </button>
        </form>
    @else
        <p><em>Inicia sesión para guardar tu estatus de esta película.</em></p>
    @endauth

    <hr>
    
    @auth
        <h4>Mi calificacion</h4>

        <form action="{{ route('peliculas.calificacion.store', $pelicula) }}" method="POST">
            @csrf
            <label for="calificacion"><strong>Calificacion:</strong></label>
            <input type="number" name='calificacion' min="0" max="10" step="1">

        <button type="submit" class="btn btn-sm btn-primary" style="margin-left: 10px;">guardar calificacion</button">
           </form>
    @else
     <p><em>Inicia sesión para guardar tu estatus de esta película.</em></p>
    @endauth

    <hr>
    <div name="calificacion_general">
        <h4>Calificacion general</h4>
        {{ $pelicula->promedioCalificacion() }}
    </div>

    <form action="{{ route('peliculas.destroy', $pelicula) }}" method="POST" style="display:inline-block;"
        onsubmit="return confirm('¿Seguro que quieres eliminar este producto?');">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" type="submit">
            Borrar
        </button>
    </form>

    <p>
        <a href="{{ route('peliculas.index') }}">Volver al listado</a>
    </p>

@endsection
