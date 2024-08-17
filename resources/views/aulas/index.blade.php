
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Aulas</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        /* Estilos para las tarjetas de aulas */
        .aula-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .aula-card:hover {
            transform: translateY(-5px);
        }

        .aula-info h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .aula-info p {
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

        .btn-agregar-aula {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-agregar-aula:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Aulas</h2>
        <div class="aulas">
            @foreach($aulas as $aula)
            <div class="aula-card">
                <div class="aula-info">
                    <h3>{{ $aula->nombre }}</h3>
                    <p><strong>Cantidad:</strong> {{ $aula->cantidad_aulas }}</p>
                </div>
                <div class="botones">
                    <a href="{{ route('aulas.edit', $aula->id) }}" class="btn btn-editar">Editar</a>
                    <form action="{{ route('aulas.destroy', $aula->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de querer eliminar esta aula?')">Eliminar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{ route('aulas.create') }}" class="btn btn-agregar-aula">Agregar Aula</a>
    </div>
</body>
</html>
