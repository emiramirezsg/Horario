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

        .btn-regresar, .btn-paralelos {
            background-color: #6c757d;
            color: #fff;
            position: absolute;
            top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-regresar {
            right: 120px; /* Ajusta para el espacio entre botones */
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

        .btn-editar-paralelo:hover {
            background-color: #0056b3;
        }

        .btn-eliminar-paralelo:hover {
            background-color: #c82333;
        }

        /* Estilos para los modales */
        .modal {
            display: none; /* Ocultar el modal por defecto */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4); /* Fondo semi-transparente */
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
                    <a href="#modalEditarCurso" class="btn btn-editar open-modal" data-curso-id="{{ $curso->id }}" data-curso-nombre="{{ $curso->nombre }}">Editar</a>
                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de querer eliminar este curso?')">Eliminar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Crear Curso -->
    <div id="modalCrearCurso" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-close" onclick="closeModal('modalCrearCurso')">&times;</span>
                <h2>Crear Curso</h2>
            </div>
            <div class="modal-body">
                <form id="formCrearCurso" method="POST" action="{{ route('cursos.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <button type="submit" class="btn btn-submit">Crear Curso</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancelar" onclick="closeModal('modalCrearCurso')">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Modal Editar Curso -->
    <div id="modalEditarCurso" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-close" onclick="closeModal('modalEditarCurso')">&times;</span>
                <h2>Editar Curso</h2>
            </div>
            <div class="modal-body">
                <form id="formEditarCurso" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre-edit">Nombre</label>
                        <input type="text" id="nombre-edit" name="nombre" required>
                    </div>
                    <button type="submit" class="btn btn-submit">Guardar Cambios</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancelar" onclick="closeModal('modalEditarCurso')">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Paralelo -->
    <div id="modalAgregarParalelo" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-close" onclick="closeModal('modalAgregarParalelo')">&times;</span>
                <h2>Agregar Paralelo</h2>
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
                <button class="btn btn-cancelar" onclick="closeModal('modalAgregarParalelo')">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Modal Editar Paralelo -->
    <div id="modalEditarParalelo" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-close" onclick="closeModal('modalEditarParalelo')">&times;</span>
                <h2>Editar Paralelo</h2>
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
                <button class="btn btn-cancelar" onclick="closeModal('modalEditarParalelo')">Cancelar</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('href').substring(1);
                const paraleloId = this.getAttribute('data-paralelo-id');
                const paraleloNombre = this.getAttribute('data-paralelo-nombre');
                const paraleloCantidad = this.getAttribute('data-paralelo-cantidad');
                const cursoId = this.getAttribute('data-curso-id');
                
                if (modalId === 'modalEditarCurso') {
                    document.getElementById('formEditarCurso').action = `/cursos/${cursoId}`;
                    document.getElementById('nombre-edit').value = this.getAttribute('data-curso-nombre');
                } else if (modalId === 'modalAgregarParalelo') {
                    document.getElementById('formAgregarParalelo').action = `/paralelos`;
                    document.getElementById('curso-id').value = cursoId;
                } else if (modalId === 'modalEditarParalelo') {
                    document.getElementById('formEditarParalelo').action = `/paralelos/${paraleloId}`;
                    document.getElementById('nombre-paralelo-edit').value = paraleloNombre;
                    document.getElementById('cantidad-estudiantes-edit').value = paraleloCantidad;
                }
                openModal(modalId);
            });
        });

        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                closeModal(event.target.id);
            }
        });
    </script>
</body>
</html>
