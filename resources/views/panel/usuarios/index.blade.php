//muestra el perfil general del usuario 
//muestra las estadisiticas de su cosumo de peliculas 
//muestra las peliculas que ha valorado


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>usuarios</title>
</head>
<body>
    @foreach ( $usuarios as $usuario)
    <p>{{$usuario->name}} -> {{$usuario->email}}</p>
    
    @endforeach
</body>
</html>