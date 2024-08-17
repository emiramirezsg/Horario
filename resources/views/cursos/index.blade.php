<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background: url('https://www.orientacionandujar.es/wp-content/uploads/2020/08/fondos-para-clases-virtuales-1.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        /* Estilos para las tarjetas de cursos */
        .cursos {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .curso-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
            position: relative;
            width: calc(33.333% - 20px); /* Ajustar el ancho y espacio entre tarjetas */
            box-sizing: border-box; /* Asegura que el padding no afecte al ancho total */
        }

        .curso-card:hover {
            transform: translateY(-5px);
        }

        .curso-info h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .curso-info p {
            margin: 0;
            font-size: 1em;
            color: #666;
        }

        .botones {
            display: flex; /* Para alinear los botones en una fila */
            gap: 10px; /* Espacio entre los botones */
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-editar {
            background-color: #28a745;
            color: #fff;
        }

        .btn-editar:hover {
            background-color: #218838;
        }

        .btn-eliminar {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-eliminar:hover {
            background-color: #c82333;
        }

        .btn-agregar-paralelo {
            background-color: #ffc107;
            color: #fff;
        }

        .btn-agregar-paralelo:hover {
            background-color: #e0a800;
        }

        .btn-agregar-curso {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-agregar-curso:hover {
            background-color: #0056b3;
        }

        .btn-regresar {
            background-color: #6c757d;
            color: #fff;
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-regresar:hover {q
            background-color: #5a6268;
        }

        .paralelos-list {
            margin-top: 10px;
        }

        .paralelo-item {
            background-color: #f8f9fa;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="btn btn-regresar">Inicio</a>
    
    <div class="container">
        <h2>Lista de Cursos</h2>
        <div class="cursos">
            @foreach($cursos as $curso)
            <div class="curso-card">
                <div class="curso-info">
                    <h3>{{ $curso->nombre }}</h3>
                    <p><strong>Paralelos:</strong></p>
                    <div class="paralelos-list">
                        @forelse($curso->paralelos as $paralelo)
                        <div class="paralelo-item">
                            {{ $paralelo->nombre }} - Cantidad de Estudiantes: {{ $paralelo->cantidad_est }}
                        </div>
                        @empty
                        <p>No hay paralelos asignados a este curso.</p>
                        @endforelse
                    </div>
                </div>
                <div class="botones">
                    <a href="{{ route('paralelos.create', ['curso_id' => $curso->id]) }}" class="btn btn-agregar-paralelo">Agregar Paralelo</a>
                    <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-editar">Editar</a>
                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de querer eliminar este curso?')">Eliminar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{ route('cursos.create') }}" class="btn btn-agregar-curso">Agregar Curso</a>
    </div>
</body>
</html>
