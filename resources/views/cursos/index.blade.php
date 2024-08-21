<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>
    <link rel="stylesheet" href="css/estilos.css">
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
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

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
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .curso-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .curso-info h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.5em;
            color: #333;
        }

        .curso-info p {
            margin: 0;
            font-size: 1em;
            color: #666;
        }

        .botones {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-agregar-curso {
            padding: 10px 20px;
            background-color: #007bff;
            margin-top: 20px;
            display: inline-block;
        }

        .btn-agregar-curso:hover {
            background-color: #0056b3;
        }

        .btn-agregar-paralelo {
            background-color: #ffc107;
        }

        .btn-agregar-paralelo:hover {
            background-color: #e0a800;
        }

        .btn-editar {
            background-color: #28a745;
        }

        .btn-editar:hover {
            background-color: #218838;
        }

        .btn-eliminar {
            background-color: #dc3545;
        }

        .btn-eliminar:hover {
            background-color: #c82333;
        }

        .btn-asignar {
            background-color: #007bff;
        }

        .btn-asignar:hover {
            background-color: #0056b3;
        }

        .btn-regresar, .btn-paralelos {
            background-color: #6c757d;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            position: absolute;
            top: 20px;
        }

        .btn-regresar {
            right: 160px;
        }

        .btn-paralelos {
            right: 20px;
        }

        .btn-regresar:hover, .btn-paralelos:hover {
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
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-editar-paralelo, .btn-eliminar-paralelo {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-block;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .btn-editar-paralelo {
            background-image: url('https://img.icons8.com/material-outlined/24/000000/edit--v1.png');
        }

        .btn-eliminar-paralelo {
            background-image: url('https://img.icons8.com/material-outlined/24/000000/delete-forever.png');
        }

        .btn-editar-paralelo:hover, .btn-eliminar-paralelo:hover {
            background-color: #f1f1f1;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .modal-header, .modal-footer {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .modal-header h2 {
            margin: 0;
        }

        .modal-footer {
            border-top: 1px solid #ddd;
            text-align: right;
        }

        .modal-close {
            float: right;
            font-size: 1.5em;
            cursor: pointer;
            color: #000;
        }

        .modal-close:hover {
            color: #dc3545;
        }

        .modal-body {
            margin: 15px 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <a href="{{ route('paralelos.index') }}" class="btn btn-paralelos">Paralelos</a>
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
                            <div class="botones">
                                <a href="#modalEditarParalelo" class="btn-editar-paralelo open-modal" data-paralelo-id="{{ $paralelo->id }}" data-paralelo-nombre="{{ $paralelo->nombre }}" data-paralelo-cantidad="{{ $paralelo->cantidad_est }}" title="Editar Paralelo"></a>
                                <form action="{{ route('paralelos.destroy', $paralelo->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-eliminar-paralelo" onclick="return confirm('¿Estás seguro de querer eliminar este paralelo?')" title="Eliminar Paralelo"></button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <p>No hay paralelos asignados a este curso.</p>
                        @endforelse
                    </div>
                </div>
                <div class="botones">
                    <a href="#modalAgregarParalelo" class="btn btn-agregar-paralelo open-modal" data-curso-id="{{ $curso->id }}">Agregar Paralelo</a>
                    <a href="#modalAsignarMateria" class="btn btn-asignar open-modal" data-curso-id="{{ $curso->id }}">Asignar Materias</a>
                    <a href="#modalEditarCurso" class="btn btn-editar open-modal" data-curso-id="{{ $curso->id }}">Editar</a>
                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de querer eliminar este curso?')">Eliminar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <a href="#modalAgregarCurso" class="btn btn-agregar-curso open-modal">Agregar Curso</a>
    </div>

    <!-- Modal Crear Curso -->
    <div id="modalAgregarCurso" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Agregar Curso</h2>
                <span class="modal-close" data-dismiss="modal">&times;</span>
            </div>
            <div class="modal-body">
                <form action="{{ route('cursos.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="cursoNombre">Nombre del Curso:</label>
                        <input type="text" id="cursoNombre" name="nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Curso</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal Editar Curso -->
    <div id="modalEditarCurso" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Editar Curso</h2>
                <span class="modal-close" data-dismiss="modal">&times;</span>
            </div>
            <div class="modal-body">
            <form action="{{ route('cursos.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="cursoNombre">Nombre del Curso:</label>
                        <input type="text" id="cursoNombre" name="nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Curso</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Paralelo -->
    <div id="modalAgregarParalelo" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Agregar Paralelo</h2>
                <span class="modal-close" data-dismiss="modal">&times;</span>
            </div>
            <div class="modal-body">
            <form id="formAgregarParalelo" method="POST">
                    @csrf
                    <input type="hidden" id="curso-id" name="curso_id">
                    <div class="form-group">
                        <label for="nombre-paralelo">Nombre del Paralelo</label>
                        <input type="text" id="nombre-paralelo" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="cantidad-estudiantes">Cantidad de Estudiantes</label>
                        <input type="number" id="cantidad-estudiantes" name="cantidad_est" required>
                    </div>
                    <button type="submit" class="btn btn-submit">Agregar</button>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal Editar Paralelo -->
    <div id="modalEditarParalelo" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Editar Paralelo</h2>
                <span class="modal-close" data-dismiss="modal">&times;</span>
            </div>
            <div class="modal-body">
            <form id="formEditarParalelo" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre-paralelo-edit">Nombre del Paralelo</label>
                        <input type="text" id="nombre-paralelo-edit" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="cantidad-estudiantes-edit">Cantidad de Estudiantes</label>
                        <input type="number" id="cantidad-estudiantes-edit" name="cantidad_est" required>
                    </div>
                    <button type="submit" class="btn btn-submit">Guardar Cambios</button>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal Asignar Materias -->
    <div id="modalAsignarMateria" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Asignar Materias</h2>
                <span class="modal-close" data-dismiss="modal">&times;</span>
            </div>
            <div class="modal-body">
                <!-- Aquí se insertará el formulario para asignar materias -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modals = document.querySelectorAll('.modal');
            var openModalButtons = document.querySelectorAll('.open-modal');
            var closeModalButtons = document.querySelectorAll('.modal-close, [data-dismiss="modal"]');

            openModalButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var modalId = this.getAttribute('href');
                    var modal = document.querySelector(modalId);
                    modal.style.display = 'block';
                });
            });

            closeModalButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    modals.forEach(function (modal) {
                        modal.style.display = 'none';
                    });
                });
            });

            window.addEventListener('click', function (event) {
                modals.forEach(function (modal) {
                    if (event.target == modal) {
                        modal.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
