<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estiloshome.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('https://www.orientacionandujar.es/wp-content/uploads/2020/08/fondos-para-clases-virtuales-1.jpg') no-repeat center center fixed;
            margin: 0;
            padding: 0;
        }

        .user-bar {
            background-color: #0000FF;
            padding: 20px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 15px;
            cursor: pointer;
            border: 2px solid #fff;
        }

        .user-info h2 {
            margin: 0;
            font-size: 1.8em;
            color: #fff;
        }

        .logout-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #fff;
            font-size: 1.5em;
            padding: 0;
            margin: 0;
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .logout-btn img {
            width: 60px;
            height: 60px;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative;
            flex: 1 1 calc(33.333% - 40px);
            box-sizing: border-box;
            max-width: calc(33.333% - 40px);
            margin: 10px;
            overflow: hidden; /* Esconde el contenido que se sale del contenedor */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .card img {
            width: 100%;
            height: 200px; /* Ajusta el tamaño según sea necesario */
            object-fit: cover;
            border-bottom: 2px solid #ddd; /* Agrega una línea debajo de la imagen */
        }

        .card-content {
            padding: 15px;
            position: relative;
            top: -20px; /* Ajusta el espacio según sea necesario */
            background: #fff;
            width: 100%;
            box-sizing: border-box;
        }

        .card h2 {
            margin: 15px 0;
            color: #333;
        }

        .card .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 10px 5px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-view {
            background-color: #007bff;
        }

        .btn-view:hover {
            background-color: #0056b3;
        }

        .btn-manage {
            background-color: #28a745;
        }

        .btn-manage:hover {
            background-color: #218838;
        }

        .btn-edit {
            background-color: #ffc107;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="user-bar">
        <div class="user-info">
            <img src="{{ asset('https://definicion.de/wp-content/uploads/2019/07/perfil-de-usuario.png') }}" alt="Perfil" onclick="location.href='{{ route('user.profile') }}'">
            <h2>{{ Auth::user()->name }}</h2>
        </div>
        <button class="logout-btn" onclick="confirmLogout()">
            <img src="https://w7.pngwing.com/pngs/655/512/png-transparent-computer-icons-log-out-miscellaneous-rectangle-sign-thumbnail.png" alt="Cerrar sesión">
        </button>
    </div>

    <div class="container">
        <!-- Tarjeta de Materias -->
        <div class="card">
            <img src="https://img.freepik.com/vector-gratis/asignaturas-colegio_23-2147511892.jpg" alt="Materias">
            <div class="card-content">
                <h2>Materias</h2>
                <div class="card-actions">
                    <a href="{{ route('materias.index') }}" class="btn btn-view">Ver Todas</a>
                    <a href="{{ route('materias.create') }}" class="btn btn-manage">Agregar Materia</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Cursos -->
        <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSprcEU7okCTLN3-O_tUcakSyOYVb_ro4KCWw&s" alt="Cursos">
            <div class="card-content">
                <h2>Cursos</h2>
                <div class="card-actions">
                    <a href="{{ route('cursos.index') }}" class="btn btn-view">Ver Todos</a>
                    <a href="{{ route('cursos.create') }}" class="btn btn-manage">Agregar Curso</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Docentes -->
        <div class="card">
            <img src="https://i.pinimg.com/originals/ca/60/f9/ca60f95392f03dced81fc7326fc8f5bb.jpg" alt="Docentes">
            <div class="card-content">
                <h2>Docentes</h2>
                <div class="card-actions">
                    <a href="{{ route('docentes.index') }}" class="btn btn-view">Ver Todos</a>
                    <a href="{{ route('docentes.create') }}" class="btn btn-manage">Agregar Docente</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Aulas -->
        <div class="card">
            <img src="https://www.compartirpalabramaestra.org/sites/default/files/styles/articulos/public/field/image/el-aula-vacia.jpg?itok=BoQ5B1_c" alt="Aulas">
            <div class="card-content">
                <h2>Aulas</h2>
                <div class="card-actions">
                    <a href="{{ route('aulas.index') }}" class="btn btn-view">Ver Todas</a>
                    <a href="{{ route('aulas.create') }}" class="btn btn-manage">Agregar Aula</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Paralelos -->
        <div class="card">
            <img src="https://www.bizneo.com/blog/wp-content/uploads/2022/03/programa-de-control-horario.jpg" alt="Paralelos">
            <div class="card-content">
                <h2>Horarios</h2>
                <div class="card-actions">
                    <a href="{{ route('paralelos.index') }}" class="btn btn-view">Ver Todos</a>
                    <a href="{{ route('paralelos.create') }}" class="btn btn-manage">Agregar Paralelo</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Categorías -->
        <div class="card">
            <img src="path/to/categorias-icon.png" alt="Categorías">
            <div class="card-content">
                <h2>Categorías</h2>
                <div class="card-actions">
                    <a href="{{ route('categorias.index') }}" class="btn btn-view">Ver Todas</a>
                    <a href="{{ route('categorias.create') }}" class="btn btn-manage">Agregar Categoría</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmLogout() {
            if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                // Asume que la ruta de logout es la estándar de Laravel
                window.location.href = '{{ route('logout') }}';
            }
        }
    </script>
</body>
</html>
