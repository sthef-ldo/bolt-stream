<form action="{{ route('peliculas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="name" class="form-control" value="{{ old('nombre') }}" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion') }}" required>
    </div>

    <div class="mb-3">
        <label for="anio" class="form-label">Año</label>
        <input type="number" name="anio" id="anio" class="form-control" value="{{ old('anio') }}" required>
    </div>

    <div class="mb-3">
        <label for="link_trailer" class="form-label">Link del Trailer</label>
        <input type="url" name="link_trailer" id="link_trailer" class="form-control" value="{{ old('link_trailer') }}" required>
    </div>

    <div class="mb-3">
        <label for="link_pelicula" class="form-label">Link de la Película</label>
        <input type="url" name="link_pelicula" id="link_pelicula" class="form-control" value="{{ old('link_pelicula') }}" required>
    </div>

    <div class="mb-3">
        <label for="portada" class="form-label">Portada</label>
        <input type="file" name="portada" id="portada" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('peliculas.index') }}" class="btn btn-secondary">Volver</a>
</form>