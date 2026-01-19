<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Perfil de Usuario</h1>
    <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
    <p><strong>Email:</strong> {{ $usuario->email }}</p>


    <h2>Películas Favoritas</h2>
    @if($favoritasPosEstatus->isEmpty())
        <p>Este usuario no tiene películas favoritas.</p>
    @else
    <ul>
        @foreach ($favoritasPosEstatus as $favorita)
          <li>{{$favorita->pelicula->nombre}} -> {{$favorita->estatus}}</li>  
        @endforeach
    </ul>
    @endif

    
</body>
</html>