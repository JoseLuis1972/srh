<?php

namespace App\Models\Sievade;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CollectionAccionesCorrM extends Model
{
    protected $table = 'Sievade.cat_int_gest_rend';
    protected $primaryKey = 'id_int_gest_rend'; // Especifica la clave primaria
    public $timestamps = false;
    protected $fillable = [
        'descripcion',
        'estatus',
        'id_usuario_sistema',
        'fecha_usuario',
    ];


    public function list($iterator, $searchValue, $idArea, $idEnlace)
    {
        // Preparar la consulta base
        $query = DB::table('Sievade.cat_int_gest_rend')
        ->select([
            'Sievade.cat_int_gest_rend.id_int_gest_rend AS id',
            DB::raw('UPPER(Sievade.cat_int_gest_rend.descripcion) AS descripcion'),
            DB::raw('CASE WHEN Sievade.cat_int_gest_rend.estatus = 1 THEN TRUE ELSE FALSE END AS estatus')
        ]);


        // Si se proporciona un valor de búsqueda, agregar condiciones de búsqueda
        if (!empty($searchValue)) {
            $searchValue = strtoupper(trim($searchValue));  // Limpiar y convertir a mayúsculas

            // Condiciones de búsqueda centralizadas en una sola cláusula
            $query->where(function ($query) use ($searchValue) {
                $query->whereRaw("UPPER(TRIM(Sievade.cat_int_gest_rend.descripcion)) LIKE ?", ['%' . $searchValue . '%'])
                    ->orWhereRaw("UPPER(TRIM(Sievade.cat_int_gest_rend.estatus)) LIKE ?", ['%' . $searchValue . '%']);
            });
        }

        // Aplicar la paginación (OFFSET y LIMIT)
        $query->orderBy('Sievade.cat_int_gest_rend.id_int_gest_rend', 'ASC')
            ->offset($iterator) // OFFSET
            ->limit(5); // LIMIT

        // Ejecutar la consulta y retornar los resultados
        return $query->get();
    }


    public function edit(string $id)
    {
        // Realizamos la consulta utilizando el Query Builder de Laravel
        $query = DB::table('Sievade.cat_int_gest_rend')
            ->where('id_int_gest_rend', $id)
            ->first(); // Usamos first() para obtener un único registro

        // Retornamos el usuario o null si no se encuentra
        return $query ?? null;
    }
    public function listbeneficio()
    {
        $query = DB::table('Sievade.cat_int_gest_rend')
            ->select([
                'Sievade.cat_int_gest_rend.id_int_gest_rend AS id',
                DB::raw('UPPER(Sievade.cat_int_gest_rend.descripcion) AS descripcion')
            ])
            ->where('estatus', '=', true)
            ->orderBy('Sievade.cat_int_gest_rend.descripcion', 'ASC');

        // Ejecutar la consulta y obtener los resultados
        $results = $query->get();

        // Retornar los resultados
        return $results;
    }
}
