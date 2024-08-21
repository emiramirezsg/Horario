<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->time('hrs_trabajo');
            $table->string('dias_libres');
            $table->timestamps();
        });
    
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
            $table->string('dia');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
        });
    
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
    
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
    
        Schema::create('docente_materia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('docente_id')->constrained('docentes');
            $table->foreignId('materia_id')->constrained('materias');
            $table->timestamps();
        });
    
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->time('horas');
            $table->foreignId('periodo_id')->constrained('periodos');
            $table->foreignId('docente_materia_id')->constrained('docente_materia');
            $table->timestamps();
        });
    
        Schema::create('paralelos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('cantidad_est')->default(0);
            $table->foreignId('curso_id')->constrained('cursos');
            $table->timestamps();
        });
        Schema::create('docente_paralelo', function (Blueprint $table){
            $table->id();
            $table->foreignId('docente_id')->constrained('docentes');
            $table->foreignId('paralelo_id')->constrained('paralelos');
            $table->timestamps();
        });
        Schema::create('materia_curso', function (Blueprint $table){
            $table->id();
            $table->integer('cantidad_horas_semanales');
            $table->foreignId('materia_id')->constrained('materias');
            $table->foreignId('curso_id')->constrained('cursos');
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
        Schema::dropIfExists('materia_curso');
        Schema::dropIfExists('docente_paralelo');
        Schema::dropIfExists('paralelos');
        Schema::dropIfExists('horarios');
        Schema::dropIfExists('docente_materia');
        Schema::dropIfExists('docentes');
        Schema::dropIfExists('materias');
        Schema::dropIfExists('cursos');
        Schema::dropIfExists('periodos');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('aulas');
        Schema::dropIfExists('users');
    }
}
