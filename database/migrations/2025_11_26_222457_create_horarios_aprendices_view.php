<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Eliminar la vista si ya existe (evita errores en migrate)
        DB::statement('DROP VIEW IF EXISTS vw_horarios_aprendices');

        DB::statement("
            CREATE VIEW vw_horarios_aprendices AS
            SELECT
                apr.Codigo AS aprendiz_id,
                apr.apr_PrimerNombre,
                apr.apr_SegundoNombre,
                apr.apr_Apellidos,
                apr.apr_NumeroDocumento,
                apr.apr_CorreoSena,
                fc.Codigo AS ficha_codigo,
                p.prog_Denominacion AS programa,
                c.cent_Denominacion AS centro_formacion,
                e.id AS evento_id,
                e.title AS evento_titulo,
                e.descripcion AS evento_descripcion,
                e.start AS fecha_inicio,
                e.end AS fecha_fin,
                e.horaInicio,
                e.horaFinal,
                a.amb_Denominacion AS ambiente,
                comp.comp_Denominacion AS competencia,
                CONCAT(inst.inst_Nombres, ' ', inst.inst_Apellido) AS instructor,
                r.reg_Denominacion AS regional,
                e.created_at,
                e.updated_at
            FROM tbl_aprendiz apr
            INNER JOIN tbl_ficha_caracterizacions fc ON apr.Codigo_ficha = fc.Codigo
            INNER JOIN tbl_programas p ON fc.Codigo_programa = p.prog_codigoPrograma
            INNER JOIN tbl_centro_formacions c ON apr.Codigo_centro = c.Codigo
            INNER JOIN tbl_regionales r ON apr.Codigo_regional = r.Codigo
            LEFT JOIN tbl_eventos e ON fc.Codigo = e.Codigo_ficha
            LEFT JOIN tbl_ambientes a ON e.Codigo_ambiente = a.Codigo
            LEFT JOIN tbl_competencias comp ON e.Codigo_competencia = comp.comp_codigoCompetencia
            LEFT JOIN tbl_instructors inst ON e.Codigo_instructor = inst.Codigo
            WHERE e.start IS NOT NULL
        ");
    }

    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS vw_horarios_aprendices');
    }
};
