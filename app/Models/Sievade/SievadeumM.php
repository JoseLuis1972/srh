<?php

namespace App\Models\Sievade;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SievadeumM extends Model
{
    protected $table = 'sievade.cat_unid_medicion';
    protected $primaryKey = 'id_unid_medicion'; // Especifica la clave primaria
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
        $query = DB::table('sievade.cat_unid_medicion')
            ->where('id_unid_medicion', $id)
            ->first(); // Usamos first() para obtener un único registro

        // Retornamos el usuario o null si no se encuentra
        return $query ?? null;
    }



   public function list($iterator, $searchValue)
{
    // Preparar la consulta base
    $query = DB::table('sievade.cat_unid_medicion')
        ->select([
            'sievade.cat_unid_medicion.id_unid_medicion AS id',
            DB::raw('UPPER(sievade.cat_unid_medicion.descripcion) AS DescripcionUm'),
            DB::raw('CASE WHEN sievade.cat_unid_medicion.estatus = 1 THEN TRUE ELSE FALSE END AS estatus'),
        ]);

    // Si se proporciona un valor de búsqueda, agregar condiciones de búsqueda
    if (!empty($searchValue)) {
        $searchValue = strtoupper(trim($searchValue));  // Limpiar y convertir a mayúsculas

        // Condiciones de búsqueda centralizadas en una sola cláusula
        $query->where(function ($query) use ($searchValue) {
            $query->whereRaw("UPPER(TRIM(sievade.cat_unid_medicion.descripcion)) LIKE ?", ['%' . $searchValue . '%'])
                ->orWhereRaw("UPPER(TRIM(sievade.cat_unid_medicion.estatus)) LIKE ?", ['%' . $searchValue . '%']);
        });
    }
        // Aplicar la paginación (OFFSET y LIMIT)
        $query->orderBy('sievade.cat_unid_medicion.id_unid_medicion', 'ASC')
            ->offset($iterator) // OFFSET
            ->limit(5); // LIMIT

        // Ejecutar la consulta y retornar los resultados
        return $query->get();
    }



    public function listorganizacion()
    {
        $query = DB::table('sievade.cat_unid_medicion')
            ->select([
                'sievade.cat_unid_medicion.id_unid_medicion AS id',
                DB::raw('UPPER(sievade.cat_unid_medicion.descripcion) AS descripcion')
            ])
            ->where('estatus', '=', true)
            ->orderBy('sievade.cat_unid_medicion.descripcion', 'ASC');

        // Ejecutar la consulta y obtener los resultados
        $results = $query->get();

        // Retornar los resultados
        return $results;
    }
}
