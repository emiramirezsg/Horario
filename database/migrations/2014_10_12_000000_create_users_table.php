<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user');
            $table->rememberToken();
            $table->boolean('is_docente')->default(false);
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password'), // Cambia 'password' por la contraseña que prefieras
            'role' => 'user',
            'is_docente' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Crear 17 usuarios con rol 'docente'
        $docentes = [
            ['name' => 'Alice.Smith', 'email' => 'alicesmith@example.com'],
            ['name' => 'Bob.Johnson', 'email' => 'bobjohnson@example.com'],
            ['name' => 'Charlie.Brown', 'email' => 'charliebrown@example.com'],
            ['name' => 'David.Wilson', 'email' => 'davidwilson@example.com'],
            ['name' => 'Eva.Davis', 'email' => 'evadavis@example.com'],
            ['name' => 'Frank.Miller', 'email' => 'frankmiller@example.com'],
            ['name' => 'Grace.Lee', 'email' => 'gracelee@example.com'],
            ['name' => 'Hannah.Walker', 'email' => 'hannahwalker@example.com'],
            ['name' => 'Ian.Hall', 'email' => 'ianhall@example.com'],
            ['name' => 'Jane.Allen', 'email' => 'janeallen@example.com'],
            ['name' => 'Kyle.Young', 'email' => 'kyleyoung@example.com'],
            ['name' => 'Laura.King', 'email' => 'lauraking@example.com'],
            ['name' => 'Mike.Scott', 'email' => 'mikescott@example.com'],
            ['name' => 'Nina.Wright', 'email' => 'ninawright@example.com'],
            ['name' => 'Oscar.Harris', 'email' => 'oscarharris@example.com'],
            ['name' => 'Paul.Green', 'email' => 'paulgreen@example.com'],
            ['name' => 'Quinn.Turner', 'email' => 'quinnturner@example.com'],
        ];

        foreach ($docentes as $docente) {
            DB::table('users')->insert([
                'name' => $docente['name'],
                'email' => $docente['email'],
                'password' => Hash::make('password'), // Cambia 'password' por la contraseña que prefieras
                'role' => 'docente',
                'is_docente' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('cantidad_sillas');
            $table->string('cantidad_mesas');
            $table->timestamps();
        });
    
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('hrs_trabajo');
            $table->string('dias_libres');
            $table->timestamps();
        });

        DB::table('categorias')->insert([
            ['nombre' => 'merito', 'hrs_trabajo' => '120'],
            ['nombre' => 'primera', 'hrs_trabajo' => '116'],
            ['nombre' => 'segunda', 'hrs_trabajo' => '112'],
            ['nombre' => 'tercera', 'hrs_trabajo' => '108'],
            ['nombre' => 'cuarta', 'hrs_trabajo' => '104'],
            ['nombre' => 'quinta', 'hrs_trabajo' => '100'],
        ]);

        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        DB::table('materias')->insert([
            ['nombre' => 'Ciencias Sociales'],
            ['nombre' => 'Biologia Geografia'],
            ['nombre' => 'Matematicas'],
            ['nombre' => 'Lengua Castellana y Originaria'],
            ['nombre' => 'Educacion Musical'],
            ['nombre' => 'Educacion fisica'],
            ['nombre' => 'Fisica'],
            ['nombre' => 'Quimica'],
            ['nombre' => 'Cosmos Visiones, Filosofia y Psicologia'],
            ['nombre' => 'Tecnica tecnologica general'],
            ['nombre' => 'Tecnica tecnologica especializada'],
            ['nombre' => 'Artes Plasticas y Visuales'],
            ['nombre' => 'Valores Espirituales y Religiones'],
            ['nombre' => 'Lengua Extranjera'],
        ]);
    
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');
            $table->timestamps();
        });

        $docenteUserIds = [
            2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18
        ];

        // Materias
        $materias = [
            'Lengua Castellana y Originaria',
            'Ciencias Sociales',
            'Matemáticas',
            'Ciencias Naturales',
            'Educación Física',
            'Ingles',
            'Arte y Cultura',
            'Tecnología',
            'Educación para la Vida',
        ];

        // Asignar 2 docentes a las primeras 3 materias
        $asignaciones = [
            ['materia' => 'Lengua Castellana y Originaria', 'docentes' => [2, 3]],
            ['materia' => 'Ciencias Sociales', 'docentes' => [4, 5]],
            ['materia' => 'Matemáticas', 'docentes' => [6, 7]],
        ];

        // Asignar 1 docente a las demás materias
        $remainingDocentes = array_slice($docenteUserIds, 6);
        foreach (array_slice($materias, 3) as $index => $materia) {
            $asignaciones[] = ['materia' => $materia, 'docentes' => [$remainingDocentes[$index]]];
        }

        // Insertar los registros de docentes
        foreach ($asignaciones as $asignacion) {
            foreach ($asignacion['docentes'] as $docenteUserId) {
                DB::table('docentes')->insert([
                    'user_id' => $docenteUserId,
                    'categoria' => 'merito',
                    'materia' => $asignacion['materia'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        DB::table('cursos')->insert([
            ['nombre' => '1ro'],
            ['nombre' => '2do'],
            ['nombre' => '3ro'],
            ['nombre' => '4to'],
            ['nombre' => '5to'],
            ['nombre' => '6to'],
        ]);

        Schema::create('materia_curso', function (Blueprint $table){
            $table->id();
            $table->integer('cantidad_horas_semanales');
            $table->foreignId('materia_id')->constrained('materias');
            $table->foreignId('curso_id')->constrained('cursos');
            $table->timestamps();
        });
        DB::table('materia_curso')->insert([
            ['cantidad_horas_semanales' => '12','materia_id' => '1','curso_id' => '1'],
            ['cantidad_horas_semanales' => '12','materia_id' => '1','curso_id' => '2'],
            ['cantidad_horas_semanales' => '20','materia_id' => '1','curso_id' => '3'],
            ['cantidad_horas_semanales' => '20','materia_id' => '1','curso_id' => '4'],
            ['cantidad_horas_semanales' => '32','materia_id' => '1','curso_id' => '5'],
            ['cantidad_horas_semanales' => '32','materia_id' => '1','curso_id' => '6'],
            ['cantidad_horas_semanales' => '16','materia_id' => '2','curso_id' => '1'],
            ['cantidad_horas_semanales' => '16','materia_id' => '2','curso_id' => '2'],
            ['cantidad_horas_semanales' => '16','materia_id' => '2','curso_id' => '3'],
            ['cantidad_horas_semanales' => '16','materia_id' => '2','curso_id' => '4'],
            ['cantidad_horas_semanales' => '16','materia_id' => '2','curso_id' => '5'],
            ['cantidad_horas_semanales' => '16','materia_id' => '2','curso_id' => '6'],
            ['cantidad_horas_semanales' => '20','materia_id' => '3','curso_id' => '1'],
            ['cantidad_horas_semanales' => '20','materia_id' => '3','curso_id' => '2'],
            ['cantidad_horas_semanales' => '20','materia_id' => '3','curso_id' => '3'],
            ['cantidad_horas_semanales' => '20','materia_id' => '3','curso_id' => '4'],
            ['cantidad_horas_semanales' => '20','materia_id' => '3','curso_id' => '5'],
            ['cantidad_horas_semanales' => '20','materia_id' => '3','curso_id' => '6'],
            ['cantidad_horas_semanales' => '24','materia_id' => '4','curso_id' => '1'],
            ['cantidad_horas_semanales' => '24','materia_id' => '4','curso_id' => '2'],
            ['cantidad_horas_semanales' => '24','materia_id' => '4','curso_id' => '3'],
            ['cantidad_horas_semanales' => '16','materia_id' => '4','curso_id' => '4'],
            ['cantidad_horas_semanales' => '12','materia_id' => '4','curso_id' => '5'],
            ['cantidad_horas_semanales' => '12','materia_id' => '4','curso_id' => '6'],
            ['cantidad_horas_semanales' => '8','materia_id' => '5','curso_id' => '1'],
            ['cantidad_horas_semanales' => '8','materia_id' => '5','curso_id' => '2'],
            ['cantidad_horas_semanales' => '8','materia_id' => '5','curso_id' => '3'],
            ['cantidad_horas_semanales' => '8','materia_id' => '5','curso_id' => '4'],
            ['cantidad_horas_semanales' => '8','materia_id' => '5','curso_id' => '5'],
            ['cantidad_horas_semanales' => '8','materia_id' => '5','curso_id' => '6'],
            ['cantidad_horas_semanales' => '8','materia_id' => '6','curso_id' => '1'],
            ['cantidad_horas_semanales' => '8','materia_id' => '6','curso_id' => '2'],
            ['cantidad_horas_semanales' => '8','materia_id' => '6','curso_id' => '3'],
            ['cantidad_horas_semanales' => '8','materia_id' => '6','curso_id' => '4'],
            ['cantidad_horas_semanales' => '8','materia_id' => '6','curso_id' => '5'],
            ['cantidad_horas_semanales' => '8','materia_id' => '6','curso_id' => '6'],
            ['cantidad_horas_semanales' => '8','materia_id' => '7','curso_id' => '3'],
            ['cantidad_horas_semanales' => '8','materia_id' => '7','curso_id' => '4'],
            ['cantidad_horas_semanales' => '8','materia_id' => '7','curso_id' => '5'],
            ['cantidad_horas_semanales' => '8','materia_id' => '7','curso_id' => '6'],
            ['cantidad_horas_semanales' => '8','materia_id' => '8','curso_id' => '3'],
            ['cantidad_horas_semanales' => '8','materia_id' => '8','curso_id' => '4'],
            ['cantidad_horas_semanales' => '8','materia_id' => '8','curso_id' => '5'],
            ['cantidad_horas_semanales' => '8','materia_id' => '8','curso_id' => '6'],
            ['cantidad_horas_semanales' => '8','materia_id' => '9','curso_id' => '1'],
            ['cantidad_horas_semanales' => '8','materia_id' => '9','curso_id' => '2'],
            ['cantidad_horas_semanales' => '8','materia_id' => '9','curso_id' => '3'],
            ['cantidad_horas_semanales' => '8','materia_id' => '9','curso_id' => '4'],
            ['cantidad_horas_semanales' => '8','materia_id' => '9','curso_id' => '5'],
            ['cantidad_horas_semanales' => '8','materia_id' => '9','curso_id' => '6'],
            ['cantidad_horas_semanales' => '16','materia_id' => '10','curso_id' => '1'],
            ['cantidad_horas_semanales' => '16','materia_id' => '10','curso_id' => '2'],
            ['cantidad_horas_semanales' => '32','materia_id' => '10','curso_id' => '3'],
            ['cantidad_horas_semanales' => '32','materia_id' => '10','curso_id' => '4'],
            ['cantidad_horas_semanales' => '48','materia_id' => '11','curso_id' => '5'],
            ['cantidad_horas_semanales' => '48','materia_id' => '11','curso_id' => '6'],
            ['cantidad_horas_semanales' => '8','materia_id' => '12','curso_id' => '1'],
            ['cantidad_horas_semanales' => '8','materia_id' => '12','curso_id' => '2'],
            ['cantidad_horas_semanales' => '8','materia_id' => '12','curso_id' => '3'],
            ['cantidad_horas_semanales' => '8','materia_id' => '12','curso_id' => '4'],
            ['cantidad_horas_semanales' => '8','materia_id' => '12','curso_id' => '5'],
            ['cantidad_horas_semanales' => '8','materia_id' => '12','curso_id' => '6'],
            ['cantidad_horas_semanales' => '8','materia_id' => '13','curso_id' => '1'],
            ['cantidad_horas_semanales' => '8','materia_id' => '13','curso_id' => '2'],
            ['cantidad_horas_semanales' => '8','materia_id' => '13','curso_id' => '3'],
            ['cantidad_horas_semanales' => '8','materia_id' => '13','curso_id' => '4'],
            ['cantidad_horas_semanales' => '8','materia_id' => '13','curso_id' => '5'],
            ['cantidad_horas_semanales' => '8','materia_id' => '13','curso_id' => '6'],
            ['cantidad_horas_semanales' => '8','materia_id' => '14','curso_id' => '1'],
            ['cantidad_horas_semanales' => '8','materia_id' => '14','curso_id' => '2'],
            ['cantidad_horas_semanales' => '8','materia_id' => '14','curso_id' => '3'],
            ['cantidad_horas_semanales' => '8','materia_id' => '14','curso_id' => '4'],
            ['cantidad_horas_semanales' => '8','materia_id' => '14','curso_id' => '5'],
            ['cantidad_horas_semanales' => '8','materia_id' => '14','curso_id' => '6'],
        ]);
    
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
        });

        DB::table('horarios')->insert([
            ['dia' => 'lunes', 'hora_inicio' => '07:30', 'hora_fin' => '08:10'],
            ['dia' => 'lunes', 'hora_inicio' => '08:10', 'hora_fin' => '08:50'],
            ['dia' => 'lunes', 'hora_inicio' => '09:05', 'hora_fin' => '09:45'],
            ['dia' => 'lunes', 'hora_inicio' => '09:45', 'hora_fin' => '10:25'],
            ['dia' => 'lunes', 'hora_inicio' => '11:00', 'hora_fin' => '11:40'],
            ['dia' => 'lunes', 'hora_inicio' => '11:40', 'hora_fin' => '12:20'],
            ['dia' => 'lunes', 'hora_inicio' => '12:20', 'hora_fin' => '13:00'],
        ]);
    
        Schema::create('paralelos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('cantidad_est')->default(0);
            $table->foreignId('curso_id')->constrained('cursos');
            $table->timestamps();
        });
        DB::table('paralelos')->insert([
            ['nombre' => 'A','cantidad_est' => 24, 'curso_id' => 1],
            ['nombre' => 'B','cantidad_est' => 24, 'curso_id' => 1],
            ['nombre' => 'A','cantidad_est' => 24, 'curso_id' => 2],
            ['nombre' => 'B','cantidad_est' => 24, 'curso_id' => 2],
            ['nombre' => 'A','cantidad_est' => 24, 'curso_id' => 3],
            ['nombre' => 'B','cantidad_est' => 24, 'curso_id' => 3],
            ['nombre' => 'A','cantidad_est' => 24, 'curso_id' => 4],
            ['nombre' => 'B','cantidad_est' => 24, 'curso_id' => 4],
            ['nombre' => 'A','cantidad_est' => 24, 'curso_id' => 5],
            ['nombre' => 'B','cantidad_est' => 24, 'curso_id' => 5],
            ['nombre' => 'A','cantidad_est' => 24, 'curso_id' => 6],
            ['nombre' => 'B','cantidad_est' => 24, 'curso_id' => 6],
        ]);

        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
            $table->string('dia');
            $table->foreignId('horario_id')->constrained('horarios')->onDelete('cascade');
            $table->foreignId('docente_id')->constrained('docentes')->onDelete('cascade');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->foreignId('aula_id')->constrained('aulas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodos');
        Schema::dropIfExists('paralelos');
        Schema::dropIfExists('horarios');
        Schema::dropIfExists('materia_curso');
        Schema::dropIfExists('cursos');
        Schema::dropIfExists('docentes');
        Schema::dropIfExists('materias');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('aulas');
        Schema::dropIfExists('users');
    }
}
