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
        Schema::create('tbl_notificaciones', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->string('not_Titulo');
            $table->text('not_Mensaje');
            $table->enum('not_Estado', ['No Leida', 'Leida', 'Archivada'])->default('No Leida');
            $table->enum('not_Tipo', ['Solicitud', 'Asignacion', 'Recordatorio', 'Sistema']);
            $table->unsignedBigInteger('Codigo_usuario');
            $table->unsignedBigInteger('Codigo_solicitud')->nullable()->index('fk_notif_solicitud');
            $table->unsignedBigInteger('Codigo_asignacion')->nullable()->index('fk_notif_asignacion');
            $table->unsignedBigInteger('Codigo_referencia')->nullable();
            $table->string('tipo_referencia', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_notificaciones');
    }
};
