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
        Schema::create('tbl_programas', function (Blueprint $table) {
            $table->bigIncrements('prog_codigoPrograma');
            $table->string('prog_Denominacion', 300);
            $table->integer('prog_version');
            $table->enum('prog_Estado', ['Activo', 'Inactivo'])->nullable();
            $table->string('prog_HorasEstimadas', 45);
            $table->string('prog_Creditos', 45);
            $table->string('prog_Descripcion', 1000);
            $table->string('prog_DuracionMeses', 45);
            $table->enum('prog_NivelFormacion', ['Técnico', 'Tecnólogo'])->nullable();
            $table->integer('prog_etapaLectiva');
            $table->integer('prog_etapaProductiva');
            $table->integer('prog_totalHoras');
            $table->string('prog_justificacion');
            $table->string('prog_metodologia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_programas');
    }
};
