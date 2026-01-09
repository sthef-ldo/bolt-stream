<x-pagina-base>


//pagina de inicio de las peliculas
 <h1>Listado de Películas</h1>

    @if($peliculas->isEmpty())
        <p>No hay películas registradas.</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Año</th>
                    <th>Portada</th>
                    <th>Ver detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peliculas as $pelicula)
                    <tr>
                        <td>{{ $pelicula->nombre }}</td>
                        <td>{{ $pelicula->anio }}</td>
                        <td>
                            @if($pelicula->portada)
                                <img src="{{ $pelicula->portada }}" alt="Portada" width="80">
                            @else
                                Sin portada
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('peliculas.show', $pelicula->id) }}">
                                Ver detalles
                            </a>
                        </td>
                   
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-pagina-base>