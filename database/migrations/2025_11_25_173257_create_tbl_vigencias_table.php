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
        Schema::create('tbl_vigencias', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->integer('vig_Contrato')->unique();
            $table->string('vig_anio');
            $table->date('vig_Inicio');
            $table->date('vig_Fin');
            $table->text('vig_Objetos');
            $table->unsignedBigInteger('Codigo_red')->index('tbl_vigencias_codigo_red_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_vigencias');
    }
};
