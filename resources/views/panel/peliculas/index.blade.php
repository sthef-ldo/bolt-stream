<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolt Stream - Películas y Series en Streaming</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            --secondary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --accent: #ff6b6b;
        }

        .hero-carousel .carousel-item img {
            height: 70vh;
            object-fit: cover;
        }

        .movie-card {
            transition: all 0.3s;
            border: none;
        }

        .movie-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .category-chip {
            border-radius: 25px;
            margin: 3px;
            font-size: 0.85rem;
        }

        .hero-section {
            background: var(--primary-gradient);
        }

        .section-title {
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent);
        }

        .empty-state {
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body class="bg-dark text-white">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent sticky-top"
        style="backdrop-filter: blur(10px); background: rgba(0,0,0,0.9);">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">
                <i class="fas fa-bolt text-warning me-2"></i>Bolt Stream
            </a>
            <!-- Tu navbar igual que antes -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#trending">Tendencia</a></li>
                </ul>
                <form class="d-flex me-3">
                    <input class="form-control me-2 bg-dark border-light" type="search"
                        placeholder="Buscar películas...">
                    <button class="btn btn-warning" type="submit"><i class="fas fa-search"></i></button>
                </form>
                {{-- <a href="{{ route('login') }}" class="btn btn-outline-light">Iniciar Sesión</a> --}}
            </div>

      

        </div>
    </nav>

    <!-- ========================================
    ZONA 1: CARRUSEL PRINCIPAL - PELÍCULAS DESTACADAS
    ======================================== -->
    <section id="home">
        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                {{-- ZONA CARRUSEL: PELÍCULAS DESTACADAS --}}
                @if ($peliculasDestacadas->isEmpty())
                    <div class="carousel-item active">
                        <div class="d-block w-100 bg-secondary" style="height: 70vh;">
                            <div class="empty-state">
                                <div class="text-center">
                                    <i class="fas fa-film fa-5x text-muted mb-4"></i>
                                    <h3 class="text-muted">No hay películas destacadas</h3>
                                    <p class="text-muted">Registra tus primeras películas para verlas aquí</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($peliculasDestacadas as $index => $pelicula)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ $pelicula->portada ?? asset('images/default-poster.jpg') }}"
                                class="d-block w-100" alt="{{ $pelicula->nombre }}">
                            <div class="carousel-caption d-none d-md-block start-0 end-0">
                                <h2 class="display-4 fw-bold mb-3">{{ $pelicula->nombre }}</h2>
                                <p class="lead mb-4">{{ $pelicula->anio }} • Acción</p>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('peliculas.show', $pelicula->id) }}"
                                        class="btn btn-warning btn-lg">
                                        <i class="fas fa-play me-2"></i>Reproducir
                                    </a>
                                    <a href="#" class="btn btn-outline-light btn-lg">
                                        <i class="fas fa-plus me-2"></i>Mi lista
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- PELÍCULAS DE PRUEBA PARA DESARROLLO -->
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/1920x1080/1a1a2e/ffffff?text=🎬+PELÍCULA+DESTACADA"
                        class="d-block w-100">
                    <div class="carousel-caption d-none d-md-block start-0 end-0">
                        <h2 class="display-4 fw-bold mb-3">PELÍCULA DESTACADA</h2>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-warning btn-lg"><i
                                    class="fas fa-play me-2"></i>Reproducir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="pb-5">
        <!-- ========================================
        ZONA 2: PELÍCULAS EN TENDENCIA
        ======================================== -->
        <section id="trending" class="py-5">
            <div class="container">
                <h2 class="section-title h3 mb-4">🔥 Tendencia ahora</h2>
                {{-- ZONA TENDENCIA: PELÍCULAS --}}
                 @if ($peliculasTendencia->isEmpty())
                    <div class="empty-state">
                        <div class="text-center text-muted">
                            <i class="fas fa-fire fa-3x mb-3 opacity-50"></i>
                            <h4>No hay películas en tendencia</h4>
                            <p>Las películas más vistas aparecerán aquí automáticamente</p>
                        </div>
                    </div>
                @else
                    <div class="row g-3">
                        @foreach ($peliculasTendencia as $pelicula)
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                <div class="movie-card h-100">
                                    <a href="{{ route('peliculas.show', $pelicula->id) }}">
                                        <img src="{{ $pelicula->portada ?? asset('images/default-poster.jpg') }}" 
                                             class="card-img-top" alt="{{ $pelicula->nombre }}">
                                    </a>
                                    <div class="card-body p-3">
                                        <h6 class="mb-2">{{ $pelicula->nombre }}</h6>
                                        <div class="d-flex justify-content-between small text-muted mb-2">
                                            <span>{{ $pelicula->anio }}</span>
                                            <div class="text-warning">
                                                ★★★★☆ <!-- Rating dinámico -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <!-- PELÍCULAS DE PRUEBA -->
                <div class="row g-3">
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                        <a href="#">
                            <div class="movie-card h-100">
                                <img src="https://via.placeholder.com/200x300/ff6b6b/fff?text=Película+1"
                                    class="card-img-top">
                                <div class="card-body p-3">
                                    <h6>Película 1</h6>
                                    <div class="d-flex justify-content-between small text-muted">
                                        <span>2025</span>
                                        <div class="text-warning">★★★★☆</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================
        ZONA 3: PELÍCULAS ESTRENOS
        ======================================== -->
        <section class="py-5 bg-dark">
            <div class="container">
                <h2 class="section-title h3 mb-4">🎬 Estrenos</h2>
                {{-- ZONA ESTRENOS: PELÍCULAS --}}
                 @if ($peliculasEstrenos->isEmpty())
                    <div class="empty-state">
                        <div class="text-center text-muted">
                            <i class="fas fa-star fa-3x mb-3 opacity-50"></i>
                            <h4>No hay estrenos disponibles</h4>
                            <p>Los nuevos lanzamientos aparecerán aquí</p>
                        </div>
                    </div>
                @else
                    <div class="row g-3">
                        @foreach ($peliculasEstrenos as $pelicula)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="movie-card h-100 shadow">
                                    <img src="{{ $pelicula->portada ?? asset('images/default-poster.jpg') }}" 
                                         class="card-img-top" alt="{{ $pelicula->nombre }}">
                                    <div class="card-body p-3">
                                        <h6 class="mb-2">{{ Str::limit($pelicula->nombre, 25) }}</h6>
                                        <p class="small text-muted mb-2">{{ $pelicula->anio }}</p>
                                        <a href="{{ route('peliculas.show', $pelicula->id) }}" 
                                           class="btn btn-outline-warning w-100 btn-sm">
                                            Ver detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <!-- PELÍCULAS DE PRUEBA -->
                <div class="row g-3">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="movie-card h-100 shadow">
                            <img src="https://via.placeholder.com/300x450/667eea/fff?text=Estreno"
                                class="card-img-top">
                            <div class="card-body p-3">
                                <h6>Nuevo Estreno</h6>
                                <p class="small text-muted">2026</p>
                                <a href="#" class="btn btn-outline-warning w-100 btn-sm">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================
        ZONA 4: TABLA COMPLETA PELÍCULAS (TU CÓDIGO)
        ======================================== -->
        <section class="py-5">
            <div class="container">
                <h2 class="section-title h3 mb-4">📋 Todas las películas</h2>
                {{-- TU CÓDIGO EXACTO CONVERTIDO A BOOTSTRAP --}}
                @if ($peliculas->isEmpty())
                    <div class="alert alert-info text-center empty-state">
                        <i class="fas fa-film fa-3x mb-3"></i>
                        <h4>No hay películas registradas.</h4>
                        <p>¡Registra tu primera película para comenzar!</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-dark table-hover table-striped">
                            <thead class="table-warning">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Año</th>
                                    <th>Portada</th>
                                    <th>Ver detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peliculas as $pelicula)
                                    <tr>
                                        <td>{{ $pelicula->nombre }}</td>
                                        <td>{{ $pelicula->anio }}</td>
                                        <td>
                                            @if ($pelicula->portada)
                                                <img src="{{ $pelicula->portada }}" alt="Portada" width="80"
                                                    class="rounded">
                                            @else
                                                <span class="badge bg-secondary">Sin portada</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('peliculas.show', $pelicula->id) }}"
                                                class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-eye me-1"></i>Ver detalles
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <!-- Footer igual que antes -->
    <footer class="bg-black py-5 mt-5 border-top border-secondary">
        <!-- Tu footer aquí -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>




{{-- pagina de inicio de las peliculas 

    <h1>Listado de Películas</h1>

    @if ($peliculas->isEmpty())
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
                @foreach ($peliculas as $pelicula)
                    <tr>
                        <td>{{ $pelicula->nombre }}</td>
                        <td>{{ $pelicula->anio }}</td>
                        <td>
                            @if ($pelicula->portada)
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
@endsection

public function index()
{
    return view('welcome', [
        'peliculas' => Pelicula::all(),
        'peliculasDestacadas' => Pelicula::latest()->take(5)->get(),
        'peliculasTendencia' => Pelicula::orderBy('visitas', 'desc')->take(10)->get(),
        'peliculasEstrenos' => Pelicula::whereYear('anio', now()->year)->take(8)->get()
    ]);
}




--}}
