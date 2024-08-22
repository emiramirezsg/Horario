<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Horarios</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background: url('https://www.orientacionandujar.es/wp-content/uploads/2020/08/fondos-para-clases-virtuales-1.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .btn-agregar-horario {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin: 10px;
        }

        .btn-agregar-horario:hover {
            background-color: #0056b3;
        }

        /* Estilos para las tarjetas de horarios */
        .horarios {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .horario-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
        }

        .horario-card h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .horario-card p {
            margin: 0;
            font-size: 1em;
            color: #666;
        }

        @media (max-width: 768px) {
            .horario-card {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .horario-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}" class="btn-back">Inicio</a>

        <h2>Lista de Horarios</h2>
        <a href="#modalAgregarHorario" class="btn btn-agregar-horario">Agregar Horario</a>
        
        <div class="horarios">
            <!-- Aquí irán las tarjetas de horarios -->
            @foreach($horarios as $horario)
            <div class="horario-card">
                <h3>{{ $horario->nombre }}</h3>
                <p><strong>Curso:</strong> {{ $horario->curso->nombre }}</p>
                <p><strong>Día:</strong> {{ $horario->dia }}</p>
                <p><strong>Hora:</strong> {{ $horario->hora }}</p>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
