<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paralelo</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        /* Estilos para el formulario de creación */
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
        }

        .form-container h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 1em;
            color: #333;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-submit, .btn-back {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-right: 10px;
        }

        .btn-submit {
            background-color: #007bff;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .btn-back {
            background-color: #6c757d;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Agregar Nuevo Paralelo</h2>
        <form action="{{ route('paralelos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="cantidad_est">Cantidad de Estudiantes:</label>
                <input type="number" id="cantidad_est" name="cantidad_est" required>
            </div>
            <div class="form-group">
                <label for="curso_id">Curso:</label>
                <select id="curso_id" name="curso_id" required>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-submit">Agregar Paralelo</button>
            <a href="{{ route('paralelos.index') }}" class="btn-back">Cancelar</a>
        </form>
    </div>
</body>
</html>
