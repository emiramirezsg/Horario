<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/estiloshome.css') }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
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

        .btn-back {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px; /* Ajusta el tamaño según tu imagen */
            height: 40px; /* Ajusta el tamaño según tu imagen */
            background: url('{{ asset('images/back-icon.png') }}') no-repeat center center;
            background-size: contain;
            border: none;
            cursor: pointer;
            outline: none;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            padding: 15px;
            margin-bottom: 20px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 1em;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-submit {
            padding: 12px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1em;
            text-align: center;
        }

        .btn-submit:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="user-bar">
        <div class="user-info">
            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'path/to/default-profile-pic.png' }}" alt="Perfil">
            <h2>{{ $user->name }}</h2>
        </div>
        <img src="{{ asset('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkDar_h9O1yaYdgLYFY18ssocoNP948yK4Aw&s') }}" alt="Regresar" style="width: 60px; height: 60px; cursor: pointer;" onclick="location.href='{{ route('home') }}'">
    </div>

    <div class="container">
        <!-- Mensajes de éxito -->
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario para actualizar perfil -->
        <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="photo">Foto de Perfil</label>
                <input type="file" id="photo" name="photo">
            </div>

            <button type="submit" class="btn-submit">Actualizar Perfil</button>
        </form>
    </div>
</body>
</html>
