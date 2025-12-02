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
        Schema::table('tbl_ambientes', function (Blueprint $table) {
            $table->foreign(['Codigo_estado'])->references(['Codigo'])->on('tbl_estado_ambientes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Codigo_tipo'])->references(['Codigo'])->on('tbl_tipo_ambientes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_ambientes', function (Blueprint $table) {
            $table->dropForeign('tbl_ambientes_codigo_estado_foreign');
            $table->dropForeign('tbl_ambientes_codigo_tipo_foreign');
        });
    }
};
