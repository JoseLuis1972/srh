<?php

namespace App\Models\Sievade;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SievademnM extends Model
{
    protected $table = 'sievade.cat_id_act_mn';
    protected $primaryKey = 'id_act_mn'; // Especifica la clave primaria
    public $timestamps = false;
    protected $fillable = [
        'descripcion',
        'estatus',
        'id_usuario_sistema',
        'fecha_usuario',
    ];

    public function edit(string $id)
    {
        // Realizamos la consulta utilizando el Query Builder de Laravel
        $query = DB::table('sievade.cat_id_act_mn')
            ->where('id_act_mn', $id)
            ->first(); // Usamos first() para obtener un único registro

        // Retornamos el usuario o null si no se encuentra
        return $query ?? null;
    }



   public function list($iterator, $searchValue)
{
    // Preparar la consulta base
    $query = DB::table('sievade.cat_id_act_mn')
        ->select([
            'sievade.cat_id_act_mn.id_act_mn AS id',
            DB::raw('UPPER(sievade.cat_id_act_mn.descripcion) AS DescripcionMn'),
            DB::raw('CASE WHEN sievade.cat_id_act_mn.estatus = 1 THEN TRUE ELSE FALSE END AS estatus'),
        ]);

    // Si se proporciona un valor de búsqueda, agregar condiciones de búsqueda
    if (!empty($searchValue)) {
        $searchValue = strtoupper(trim($searchValue));  // Limpiar y convertir a mayúsculas

        // Condiciones de búsqueda centralizadas en una sola cláusula
        $query->where(function ($query) use ($searchValue) {
            $query->whereRaw("UPPER(TRIM(sievade.cat_id_act_mn.descripcion)) LIKE ?", ['%' . $searchValue . '%'])
                ->orWhereRaw("UPPER(TRIM(sievade.cat_id_act_mn.estatus)) LIKE ?", ['%' . $searchValue . '%']);
        });
    }
        // Aplicar la paginación (OFFSET y LIMIT)
        $query->orderBy('sievade.cat_id_act_mn.id_act_mn', 'ASC')
            ->offset($iterator) // OFFSET
            ->limit(5); // LIMIT

        // Ejecutar la consulta y retornar los resultados
        return $query->get();
    }



    public function listorganizacion()
    {
        $query = DB::table('sievade.ccat_id_act_mn')
            ->select([
                'sievade.ccat_id_act_mn.id_act_mn AS id',
                DB::raw('UPPER(sievade.cat_id_act_mn.descripcion) AS descripcion')
            ])
            ->where('estatus', '=', true)
            ->orderBy('sievade.cat_id_act_mn.descripcion', 'ASC');

        // Ejecutar la consulta y obtener los resultados
        $results = $query->get();

        // Retornar los resultados
        return $results;
    }
}

