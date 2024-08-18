<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Horarios</title>
    <link rel="stylesheet" href="{{ asset('css/estiloshome.css') }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .user-bar {
            background-color: #3258ab;
            padding: 20px;
            color: #fff;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .user-info h2 {
            margin: 0;
            font-size: 1.8em;
            color: #fff;
        }

        .btn-back {
            background-color: #dc3545;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-back img {
            width: 30px;
            height: 30px;
        }

        .btn-back:hover {
            background-color: #c82333;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="user-bar">
        <div class="user-info">
            <h2>{{ Auth::user()->name }}</h2>
        </div>
    </div>

    <div class="container">
        <h1>Mis Horarios</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Materia</th>
                    <th>Aula</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horarios as $horario)
                    <tr>
                        <td>{{ $horario->hora }}</td>
                        <td>{{ $horario->materia->nombre }}</td>
                        <td>{{ $horario->aula->nombre }}</td>
                        <td>{{ $horario->fecha }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
