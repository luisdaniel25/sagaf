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
        Schema::create('tbl_asignaciones_instructores', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->unsignedBigInteger('Codigo_instructor')->index('codigo_instructor');
            $table->unsignedBigInteger('Codigo_ficha')->index('codigo_ficha');
            $table->unsignedBigInteger('Codigo_competencia')->index('codigo_competencia');
            $table->unsignedBigInteger('Codigo_ambiente')->nullable()->index('codigo_ambiente');
            $table->dateTime('FechaAsignacion')->useCurrent();
            $table->enum('Estado', ['Asignado', 'En curso', 'Finalizado', 'Cancelado'])->nullable()->default('Asignado');
            $table->text('Observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_asignaciones_instructores');
    }
};
