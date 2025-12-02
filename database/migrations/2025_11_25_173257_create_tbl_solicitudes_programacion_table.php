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
        Schema::create('tbl_solicitudes_programacion', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->dateTime('sol_FechaSolicitud');
            $table->enum('sol_Estado', ['Pendiente', 'Aprobada', 'Rechazada', 'En Revision'])->default('Pendiente');
            $table->text('sol_Justificacion')->nullable();
            $table->text('sol_Observaciones')->nullable();
            $table->unsignedBigInteger('Codigo_instructor')->index('tbl_solicitudes_instructor_foreign');
            $table->unsignedBigInteger('Codigo_competencia')->index('tbl_solicitudes_competencia_foreign');
            $table->unsignedBigInteger('Codigo_ficha')->index('tbl_solicitudes_ficha_foreign');
            $table->date('sol_FechaPropuesta');
            $table->integer('sol_HorasSolicitadas');
            $table->timestamps();
            $table->enum('sol_Prioridad', ['Baja', 'Media', 'Alta'])->nullable()->default('Media');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_solicitudes_programacion');
    }
};
