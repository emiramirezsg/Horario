
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorías</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        /* Copia los estilos desde la vista de materias */
        .materia-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .materia-card:hover {
            transform: translateY(-5px);
        }

        .materia-info h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .materia-info p {
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

        .btn-agregar-materia {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-agregar-materia:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Categorías</h2>
        <div class="materias">
            @foreach($categorias as $categoria)
            <div class="materia-card">
                <div class="materia-info">
                    <h3>{{ $categoria->nombre }}</h3>
                    <p><strong>Horas de Trabajo:</strong> {{ $categoria->hrs_trabajo }}</p>
                    <p><strong>Días Libres:</strong> {{ $categoria->dias_libres }}</p>
                </div>
                <div class="botones">
                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-editar">Editar</a>
                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de querer eliminar esta categoría?')">Eliminar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{ route('categorias.create') }}" class="btn btn-agregar-materia">Agregar Categoría</a>
    </div>
</body>
</html>
