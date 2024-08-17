<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Paralelos</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            margin: 0;
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

        /* Estilos para el botón de regresar */
        .btn-back {
            padding: 10px 20px;
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-bottom: 20px;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .btn-back-container {
            text-align: right;
        }

        /* Estilos para las tarjetas de paralelos */
        .paralelo-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .paralelo-card:hover {
            transform: translateY(-5px);
        }

        .paralelo-info h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .paralelo-info p {
            margin: 0;
            font-size: 1em;
            color: #666;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin-right: 10px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-editar {
            background-color: #28a745;
            color: #fff;
        }

        .btn-eliminar {
            background-color: #dc3545;
            color: #fff;
        }

        .btn:hover {
            background-color: #6c757d;
        }

        .btn-agregar-paralelo {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .btn-agregar-paralelo:hover {
            background-color: #0056b3;
        }

        /* Estilos para alinear los paralelos por curso */
        .paralelos {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .paralelo-card {
            flex: 1 1 calc(33.333% - 20px);
            box-sizing: border-box;
        }

        /* Ajustes para tamaños de pantalla más pequeñas */
        @media (max-width: 768px) {
            .paralelo-card {
                flex: 1 1 calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .paralelo-card {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="btn-back-container">
            <a href="{{ route('cursos.index') }}" class="btn btn-back">Regresar</a>
        </div>
        <h2>Lista de Paralelos</h2>
        <div class="paralelos">
            @foreach($paralelos as $paralelo)
            <div class="paralelo-card">
                <div class="paralelo-info">
                    <h3>{{ $paralelo->nombre }}</h3>
                    <p><strong>Cantidad de Estudiantes:</strong> {{ $paralelo->cantidad_est }}</p>
                    <p><strong>Curso:</strong> {{ $paralelo->curso->nombre }}</p>
                </div>
                <div class="botones">
                    <a href="{{ route('paralelos.edit', $paralelo->id) }}" class="btn btn-editar">Editar</a>
                    <form action="{{ route('paralelos.destroy', $paralelo->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de querer eliminar este paralelo?')">Eliminar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{ route('paralelos.create') }}" class="btn btn-agregar-paralelo">Agregar Paralelo</a>
    </div>
</body>
</html>
