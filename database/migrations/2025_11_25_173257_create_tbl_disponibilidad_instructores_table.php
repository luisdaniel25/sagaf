<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_disponibilidad_instructores', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->unsignedBigInteger('Codigo_instructor')->index('codigo_instructor');
            $table->enum('dia_semana', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']);
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->enum('dis_Estado', ['Disponible', 'Ocupado'])->nullable()->default('Disponible');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_disponibilidad_instructores');
    }
};
