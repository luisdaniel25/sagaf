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
        Schema::create('tbl_procesos', function (Blueprint $table) {
            $table->bigIncrements('Codigo');
            $table->text('pro_Denominacion');
            $table->text('pro_Observacion');
            $table->unsignedBigInteger('Codigo_ra')->index('tbl_procesos_codigo_ra_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_procesos');
    }
};
