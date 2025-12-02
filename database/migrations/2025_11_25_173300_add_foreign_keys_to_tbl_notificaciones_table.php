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
        Schema::table('tbl_notificaciones', function (Blueprint $table) {
            $table->foreign(['Codigo_asignacion'], 'fk_notif_asignacion')->references(['Codigo'])->on('tbl_asignaciones_instructores')->onUpdate('no action')->onDelete('set null');
            $table->foreign(['Codigo_solicitud'], 'fk_notif_solicitud')->references(['Codigo'])->on('tbl_solicitudes_programacion')->onUpdate('no action')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_notificaciones', function (Blueprint $table) {
            $table->dropForeign('fk_notif_asignacion');
            $table->dropForeign('fk_notif_solicitud');
        });
    }
};
