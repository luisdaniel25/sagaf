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
        Schema::create('tbl_aprendiz', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->string('apr_PrimerNombre', 75);
            $table->string('apr_SegundoNombre', 75)->nullable();
            $table->string('apr_Apellidos', 75);
            $table->string('apr_TipoDocumento', 15);
            $table->string('apr_NumeroDocumento', 20)->unique('tbl_aprendiz_numero_documento_unique');
            $table->date('apr_FechaNacimiento');
            $table->string('apr_Direccion', 100)->nullable();
            $table->string('apr_Telefono', 15)->nullable();
            $table->string('apr_TelefonoWhatsapp', 15)->nullable();
            $table->string('apr_CorreoPersonal', 100)->nullable();
            $table->string('apr_CorreoSena', 100)->nullable();
            $table->string('apr_SedeFormacion', 50);
            $table->string('apr_Jornada', 20);
            $table->string('apr_ModalidadFormacion', 30);
            $table->date('apr_FechaInicioFormacion');
            $table->date('apr_FechaFinalizacionFormacion')->nullable();
            $table->unsignedBigInteger('Codigo_programa')->index('tbl_aprendiz_codigo_programa_foreign');
            $table->unsignedBigInteger('Codigo_ficha')->index('tbl_aprendiz_codigo_ficha_foreign');
            $table->unsignedBigInteger('Codigo_centro')->index('tbl_aprendiz_codigo_centro_foreign');
            $table->unsignedBigInteger('Codigo_regional')->nullable()->index('tbl_aprendiz_codigo_regional_foreign');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_aprendiz');
    }
};
