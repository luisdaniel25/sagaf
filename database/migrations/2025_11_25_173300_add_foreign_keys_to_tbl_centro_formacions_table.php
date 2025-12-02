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
        Schema::table('tbl_centro_formacions', function (Blueprint $table) {
            $table->foreign(['Codigo_regional'])->references(['Codigo'])->on('tbl_regionales')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_centro_formacions', function (Blueprint $table) {
            $table->dropForeign('tbl_centro_formacions_codigo_regional_foreign');
        });
    }
};
