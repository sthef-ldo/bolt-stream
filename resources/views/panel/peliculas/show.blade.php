@extends('layouts.pagina-base')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- HEADER PRINCIPAL --}}
            <div class="d-flex align-items-start mb-4 p-4 bg-dark border border-secondary rounded-3">
                <div class="me-4">
                    @if ($pelicula->portada)
                        <img src="{{ $pelicula->portada }}" alt="Portada" 
                             class="rounded shadow-lg" style="width: 200px; height: 300px; object-fit: cover;">
                    @else
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center shadow-lg" 
                             style="width: 200px; height: 300px;">
                            <i class="fas fa-film fa-3x text-muted"></i>
                        </div>
                    @endif
                </div>
                
                <div class="flex-grow-1">
                    <h1 class="display-5 fw-bold text-white mb-2">{{ $pelicula->nombre }}</h1>
                    <p class="text-white-50 mb-1 fs-5">
                        <strong>Año:</strong> {{ $pelicula->anio ?? 'Desconocido' }}
                    </p>
                    <p class="text-white mb-0 fs-6">{{ $pelicula->descripcion }}</p>
                </div>
            </div>

            {{-- TRAILER Y PELÍCULA --}}
            @if ($pelicula->link_trailer || $pelicula->link_pelicula)
            <div class="bg-dark border border-secondary rounded-3 p-4 mb-4">
                <h3 class="h4 text-white mb-4">Acceso rápido</h3>
                <div class="row g-3">
                    @if ($pelicula->link_trailer)
                        <div class="col-md-6">
                            <a href="{{ $pelicula->link_trailer }}" target="_blank" 
                               class="btn btn-outline-warning w-100 p-3 fs-5">
                                <i class="fas fa-play-circle me-2"></i>Ver trailer
                            </a>
                        </div>
                    @endif
                    @if ($pelicula->link_pelicula)
                        <div class="col-md-6">
                            <a href="{{ $pelicula->link_pelicula }}" target="_blank" 
                               class="btn btn-warning w-100 p-3 fs-5">
                                <i class="fas fa-film me-2"></i>Reproducir película
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- MI ESTATUS - TU LÓGICA ORIGINAL --}}
            @auth
                <div class="bg-dark border border-secondary rounded-3 p-4 mb-4">
                    <h3 class="h4 text-white mb-4">Mi estatus</h3>
                    <form action="{{ route('peliculas.estatus.store', $pelicula) }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-4">
                            <label for="estatus" class="form-label text-white fs-6"><strong>Estatus:</strong></label>
                            <select name="estatus" id="estatus" class="form-select bg-secondary border-secondary text-white">
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
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <label class="text-white fs-6 me-3">
                                <input type="checkbox" name="favorita" value="1" class="form-check-input me-2"
                                       {{ optional($estatusActual)->favorita ? 'checked' : '' }}>
                                <strong>Marcar como favorita</strong>
                            </label>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="fas fa-save me-2"></i>Guardar estatus
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="alert alert-dark border-secondary text-center py-4 mb-4">
                    <p class="mb-0 text-white-50 fs-6"><em>Inicia sesión para guardar tu estatus de esta película.</em></p>
                </div>
            @endauth

            {{-- MI CALIFICACIÓN - TU LÓGICA ORIGINAL --}}
            @auth
                <div class="bg-dark border border-secondary rounded-3 p-4 mb-4">
                    <h4 class="h5 text-white mb-4">Mi calificacion</h4>
                    <form action="{{ route('peliculas.calificacion.store', $pelicula) }}" method="POST" class="row g-3 align-items-end">
                        @csrf
                        <div class="col-md-8">
                            <label for="calificacion" class="form-label text-white fs-6"><strong>Calificacion:</strong></label>
                            <input type="number" name="calificacion" min="0" max="10" step="1"
                                   class="form-control bg-secondary border-secondary text-white fs-5" 
                                   placeholder="0 - 10">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-outline-primary w-100 h-100">
                                <i class="fas fa-star me-2"></i>Guardar calificacion
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="alert alert-dark border-secondary text-center py-4 mb-4">
                    <p class="mb-0 text-white-50 fs-6"><em>Inicia sesión para guardar tu estatus de esta película.</em></p>
                </div>
            @endauth

            {{-- CALIFICACIÓN GENERAL - TU LÓGICA ORIGINAL --}}
            <div class="bg-dark border border-secondary rounded-3 p-4 mb-4">
                <div name="calificacion_general">
                    <h4 class="h5 text-white mb-3">Calificacion general</h4>
                    <div class="display-6 fw-bold text-warning">{{ $pelicula->promedioCalificacion() }}</div>
                </div>
            </div>

            {{-- BOTONES ADMIN - TU LÓGICA ORIGINAL --}}
            <form action="{{ route('peliculas.destroy', $pelicula) }}" method="POST" style="display:inline-block;"
                  onsubmit="return confirm('¿Seguro que quieres eliminar este producto?');" class="mb-4">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-lg px-4">
                    <i class="fas fa-trash me-2"></i>Borrar
                </button>
            </form>

            {{-- VOLVER - TU LÓGICA ORIGINAL --}}
            <p class="mb-0">
                <a href="{{ route('peliculas.index') }}" class="btn btn-outline-light btn-lg px-4">
                    <i class="fas fa-arrow-left me-2"></i>Volver al listado
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
