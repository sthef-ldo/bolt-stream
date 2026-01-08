<x-pagina-base>
//muestra la infromacion general de las peliculas busqueda
//permite ver el trailer y visualizar la pelicula completa



   <h1>{{ $pelicula->nombre }}</h1>

    <p><strong>Año:</strong> {{ $pelicula->anio ?? 'Desconocido' }}</p>

    <p><strong>Descripción:</strong></p>
    <p>{{ $pelicula->descripcion }}</p>

    @if($pelicula->portada)
        <p><strong>Portada:</strong></p>
        <img src="{{ $pelicula->portada }}" alt="Portada" width="200">
    @endif

    @if($pelicula->link_trailer)
        <p><strong>Trailer:</strong></p>
        <a href="{{ $pelicula->link_trailer }}" target="_blank">Ver trailer</a>
    @endif

    @if($pelicula->link_pelicula)
        <p><strong>Ver película:</strong></p>
        <a href="{{ $pelicula->link_pelicula }}" target="_blank">Reproducir</a>
    @endif

    <p>
        <a href="{{ route('peliculas.index') }}">Volver al listado</a>
    </p>


</x-pagina-base>