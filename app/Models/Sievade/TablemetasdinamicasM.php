<?php

namespace App\Models\Sievade;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TablemetasdinamicasM extends Model
{
    protected $table = 'sievade.tbl_metas_ind';
    protected $primaryKey = 'id_metas_ind'; // Especifica la clave primaria
    public $timestamps = false;
    protected $fillable = [
        'id_metas_ind',
        'id_usuarios',
	    'id_alineacion_pnd',
	    'id_meta_individual',
	    'id_int_gest_rend',
	    'id_verbo',
	    'desc_um_medicina',
	    'obj_contribucion',
	    'satisfactorio',
	    'no_satisfactorio',
	    'no_aprobatorio',
	    'id_tipo_unidad',
	    'peso_ind',
	    'estatus',
        'id_val_parametro',
        'ponderacion',
        'unidad_medica',
        'calificacion',
	    'id_usuario_sistema',
	    'fecha_usuario',
    ];



    public function edit(string $id)
    {
        // Realizamos la consulta utilizando el Query Builder de Laravel
        $query = DB::table('sievade.tbl_metas_ind')
            ->where('id_metas_ind', $id)
            ->first(); // Usamos first() para obtener un único registro

        // Retornamos el usuario o null si no se encuentra
        return $query ?? null;
    }



 public function list($iterator, $searchValue)
{
    // Preparar la consulta base
    $query = DB::table('sievade.tbl_metas_ind')
        ->select([
            'sievade.tbl_metas_ind.id_metas_ind AS id',
            DB::raw('UPPER(sievade.tbl_metas_ind.id_usuarios) AS id_usuarios'),
            DB::raw('UPPER(sievade.tbl_metas_ind.id_alineacion_pnd) AS id_alineacion_pnd'),
            DB::raw('UPPER(sievade.tbl_metas_ind.id_meta_individual) AS id_meta_individual'),
            DB::raw('UPPER(sievade.tbl_metas_ind.id_int_gest_rend) AS id_int_gest_rend'),
            DB::raw('UPPER(sievade.tbl_metas_ind.id_verbo) AS id_verbo'),
            DB::raw('UPPER(sievade.tbl_metas_ind.desc_um_medicina) AS desc_um_medicina'),
            DB::raw('UPPER(sievade.tbl_metas_ind.obj_contribucion) AS obj_contribucion'),
            DB::raw('UPPER(sievade.tbl_metas_ind.satisfactorio) AS satisfactorio'),
            DB::raw('UPPER(sievade.tbl_metas_ind.no_satisfactorio) AS no_satisfactorio'),
            DB::raw('UPPER(sievade.tbl_metas_ind.no_aprobatorio) AS no_aprobatorio'),
            DB::raw('UPPER(sievade.tbl_metas_ind.id_tipo_unidad) AS id_tipo_unidad'),
            DB::raw('UPPER(sievade.tbl_metas_ind.peso_ind) AS peso_ind'),
            DB::raw('CASE WHEN sievade.cat_verbo.estatus = 1 THEN TRUE ELSE FALSE END AS estatus'),
            DB::raw('UPPER(sievade.tbl_metas_ind.id_val_parametro) AS id_val_parametro'),
            DB::raw('UPPER(sievade.tbl_metas_ind.ponderacion) AS ponderacion'),
            DB::raw('UPPER(sievade.tbl_metas_ind.unidad_medica) AS unidad_medica'),
            DB::raw('UPPER(sievade.tbl_metas_ind.calificacion) AS calificacion'),
        ]);

    // Agregar condiciones de búsqueda si se proporciona un valor
    if (!empty($searchValue)) {
        $searchValue = strtoupper(trim($searchValue)); // Limpiar y convertir a mayúsculas

        $query->where(function ($query) use ($searchValue) {
            $query->orWhereRaw("UPPER(sievade.tbl_metas_ind.id_usuarios) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.id_alineacion_pnd) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.id_meta_individual) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.id_int_gest_rend) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.id_verbo) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.desc_um_medicina) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.obj_contribucion) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.satisfactorio) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.no_satisfactorio) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.no_aprobatorio) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.id_tipo_unidad) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.peso_ind) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.estatus) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.id_val_parametro) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.ponderacion) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.unidad_medica) LIKE ?", ["%$searchValue%"])
                ->orWhereRaw("UPPER(sievade.tbl_metas_ind.calificacion) LIKE ?", ["%$searchValue%"]);
        });
    }

    // Paginación y orden
    $query->orderBy('sievade.tbl_metas_ind.id_metas_ind', 'ASC')
        ->offset($iterator)
        ->limit(5);

    // Ejecutar la consulta y retornar resultados
    return $query->get();
  }
 }
