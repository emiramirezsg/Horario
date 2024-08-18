<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTypeHrsdetrabajo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categorias', function (Blueprint $table) {
            // Cambiar el tipo de la columna 'hrs_trabajo' de 'time' a 'integer'
            $table->integer('hrs_trabajo')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('categorias', function (Blueprint $table) {
            // Revertir el cambio, si es necesario
            $table->time('hrs_trabajo')->change();
        });
    }
}
