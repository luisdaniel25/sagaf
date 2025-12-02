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
        Schema::create('tbl_ficha_caracterizacions', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->date('fich_Inicio');
            $table->date('fich_Fin');
            $table->string('fich_Etapa', 45);
            $table->unsignedBigInteger('Codigo_modalidad')->index('tbl_ficha_caracterizacions_codigo_modalidad_foreign');
            $table->unsignedBigInteger('Codigo_programa')->index('tbl_ficha_caracterizacions_codigo_programa_foreign');
            $table->unsignedBigInteger('Codigo_centro')->index('tbl_ficha_caracterizacions_codigo_centro_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ficha_caracterizacions');
    }
};
