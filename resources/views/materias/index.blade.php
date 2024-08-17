<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Materias</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
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

        .materias {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .materia-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
            position: relative;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
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

        .botones {
            display: flex;
            gap: 10px;
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

        .btn-regresar:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="btn btn-regresar">Regresar a Inicio</a>
    
    <div class="container">
        <h2>Lista de Materias</h2>
        <div class="materias">
            @foreach($materias as $materia)
            <div class="materia-card">
                <div class="materia-info">
                    <h3>{{ $materia->nombre }}</h3>
                    <p><strong>Curso:</strong> {{ $materia->curso->nombre }}</p>
                    <p><strong>Docente:</strong> {{ $materia->docente->nombre }}</p>
                </div>
                <div class="botones">
                    <button class="btn btn-editar" data-bs-toggle="modal" data-bs-target="#editModal-{{ $materia->id }}">Editar</button>
                    <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de querer eliminar esta materia?')">Eliminar</button>
                    </form>
                </div>
            </div>

            <!-- Modal para Editar Materia -->
            <div class="modal fade" id="editModal-{{ $materia->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $materia->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-{{ $materia->id }}">Editar Materia</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('materias.update', $materia->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nombre-{{ $materia->id }}">Nombre</label>
                                    <input type="text" id="nombre-{{ $materia->id }}" name="nombre" value="{{ $materia->nombre }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="curso_id-{{ $materia->id }}">Curso</label>
                                    <select id="curso_id-{{ $materia->id }}" name="curso_id" class="form-control" required>
                                        @foreach($cursos as $curso)
                                        <option value="{{ $curso->id }}" {{ $curso->id == $materia->curso_id ? 'selected' : '' }}>
                                            {{ $curso->nombre }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="docente_id-{{ $materia->id }}">Docente</label>
                                    <select id="docente_id-{{ $materia->id }}" name="docente_id" class="form-control" required>
                                        @foreach($docentes as $docente)
                                        <option value="{{ $docente->id }}" {{ $docente->id == $materia->docente_id ? 'selected' : '' }}>
                                            {{ $docente->nombre }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button class="btn btn-agregar-materia mt-4" data-bs-toggle="modal" data-bs-target="#createModal">Agregar Materia</button>

        <!-- Modal para Crear Materia -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Crear Materia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('materias.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="curso_id">Curso</label>
                                <select id="curso_id" name="curso_id" class="form-control" required>
                                    @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="docente_id">Docente</label>
                                <select id="docente_id" name="docente_id" class="form-control" required>
                                    @foreach($docentes as $docente)
                                    <option value="{{ $docente->id }}">{{ $docente->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Crear Materia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
