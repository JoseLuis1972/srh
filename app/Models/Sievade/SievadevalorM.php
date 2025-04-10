<?php

namespace App\Models\Sievade;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SievadevalorM extends Model
{
    protected $table = 'sievade.cat_val_ind';
    protected $primaryKey = 'id_val_ind'; // Especifica la clave primaria
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
        $query = DB::table('sievade.cat_val_ind')
            ->where('id_val_ind', $id)
            ->first(); // Usamos first() para obtener un único registro

        // Retornamos el usuario o null si no se encuentra
        return $query ?? null;
    }



   public function list($iterator, $searchValue)
{
    // Preparar la consulta base
    $query = DB::table('sievade.cat_val_ind')
        ->select([
            'sievade.cat_val_ind.id_val_ind AS id',
            DB::raw('UPPER(sievade.cat_val_ind.descripcion) AS DescripcionValor'),
            DB::raw('CASE WHEN sievade.cat_val_ind.estatus = 1 THEN TRUE ELSE FALSE END AS estatus'),
        ]);

    // Si se proporciona un valor de búsqueda, agregar condiciones de búsqueda
    if (!empty($searchValue)) {
        $searchValue = strtoupper(trim($searchValue));  // Limpiar y convertir a mayúsculas

        // Condiciones de búsqueda centralizadas en una sola cláusula
        $query->where(function ($query) use ($searchValue) {
            $query->whereRaw("UPPER(TRIM(sievade.cat_val_ind.descripcion)) LIKE ?", ['%' . $searchValue . '%'])
                ->orWhereRaw("UPPER(TRIM(sievade.cat_val_ind.estatus)) LIKE ?", ['%' . $searchValue . '%']);
        });
    }
        // Aplicar la paginación (OFFSET y LIMIT)
        $query->orderBy('sievade.cat_val_ind.id_val_ind', 'ASC')
            ->offset($iterator) // OFFSET
            ->limit(5); // LIMIT

        // Ejecutar la consulta y retornar los resultados
        return $query->get();
    }



    public function listorganizacion()
    {
        $query = DB::table('sievade.cat_val_ind')
            ->select([
                'sievade.cat_val_ind.id_val_ind AS id',
                DB::raw('UPPER(sievade.cat_val_ind.descripcion) AS descripcion')
            ])
            ->where('estatus', '=', true)
            ->orderBy('sievade.cat_val_ind.descripcion', 'ASC');

        // Ejecutar la consulta y obtener los resultados
        $results = $query->get();

        // Retornar los resultados
        return $results;
    }
}
