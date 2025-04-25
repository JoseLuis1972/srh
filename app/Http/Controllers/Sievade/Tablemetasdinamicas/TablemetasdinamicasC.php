<?php

namespace App\Http\Controllers\Sievade\Tablemetasdinamicas;

use App\Models\Sievade\SievadeverboM;
use App\Models\Sievade\SievadeinstrumentoM;
use App\Models\Sievade\SievadetipoM;
use App\Models\Sievade\SievadeumM;
use App\Models\Sievade\SievadecriterioM;
use App\Models\Sievade\SievademnM;
use App\Models\Sievade\SievadevalorM;
use App\Models\Sievade\SievadeindicadorM;
use App\Models\Sievade\SievademetaM;
use App\Models\Sievade\SievadeunidadM;
use App\Models\Sievade\SievadeparametroM;
use App\Models\Sievade\SievadeaccionM;
use App\Models\Sievade\SievadeasociadoM;
use App\Models\Sievade\SievadealineacionM;
use App\Models\Sievade\TablemetasdinamicasM;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MessagesC;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TablemetasdinamicasC extends Controller
{


    // Retorna la vista para correspondencia
    public function list()
      {
       Log::info('TablemetasdinamicasC  - Funcion list');     // JHR COMENTARIO

        return view('Sievade.Tablemetasdinamicas.list');
      }



    public function create()
      {
        Log::info('TablemetasdinamicasC  - Funcion create');     // JHR COMENTARIO

         // ------    Valor por Catalogos    ----------
        $item = new TablemetasdinamicasM();
        $TablemetasdinamicasM = new TablemetasdinamicasM();                             //id_metas_ind             TablemetasdinamicasM
        $SievademetaM = new SievademetaM();                                             //id_meta_individual       SievademetaM
        $SievadeinstrumentoM = new SievadeinstrumentoM();                               //id_int_gest_rend         SievadeinstrumentoM
        $SievadeverboM  = new SievadeverboM ();                                         //id_verbo                 SievadeverboM
        $SievadeunidadM = new SievadeunidadM();                                         //id_tipo_unidad           SievadeunidadM
        $SievadeparametroM = new SievadeparametroM();                                   //id_val_parametro         SievadeparametroM
        $SievadealineacionM = new SievadealineacionM();                                //id_alineacion_pnd        SievadealineacionMM


     // Declaración de catalogos


        $selectMetaI =  $SievademetaM->listorganizacion();
        $selectMetaIEdit = [];

        $selectinstrumento = $SievadeinstrumentoM->listorganizacion();
        $selectinstrumentoEdit = [];

        $selectverbo  = $SievadeverboM->listorganizacion();
        $selectverboEdit = [];

        $selecunidad =  $SievadeunidadM->listorganizacion();
        $selecunidadEdit = [];

        $selecparametro =  $SievadeparametroM->listorganizacion();
        $selecparametroEdit = [];

        $selecalineacion =  $SievadealineacionM->listorganizacion();
        $selecalineacionEdit = [];


     //   return view('Sievade.Tablemetasdinamicas.form', compact('item'));
        return view('Sievade.Tablemetasdinamicas.form', compact('item','selectMetaI','selectMetaIEdit', 'selectinstrumento','selectinstrumentoEdit',
                    'selectverbo','selectverboEdit','selecunidad', 'selecunidadEdit','selecparametro', 'selecparametroEdit','selecalineacion', 'selecalineacionEdit'));
    }


 //  public function edit(string $id)                      ********* JHR

   public function edit(Request $request, $id)

    {
         Log::info('TablemetasdinamicasC  - Funcion edit');     // JHR COMENTARIO

        $sievade = TablemetasdinamicasM ::find($id);
        $messagesC = new MessagesC();
        if ($request->isMethod('post')) {
            // Validar los datos del formulario
            $request->validate([
                'desc_um_medicina' => 'required|string|max:200',
                'obj_contribucion' => 'required|string|max:200',
                'satisfactorio' => 'required|string|max:200',
                'no_satisfactorio' => 'required|string|max:200',
                'no_aprobatorio' => 'required|string|max:200',
                'peso_ind' => 'required|string|max:200',
                'estatus' => 'required|string|max:200',
                'ponderacion' => 'required|string|max:200',
                'unidad_medica' => 'required|string|max:200',
                'calificacion ' => 'required|string|max:200',

            ]);

           // ------     Class
           $item = new TablemetasdinamicasM();
           $TablemetasdinamicasM = new TablemetasdinamicasM();                             //id_metas_ind             TablemetasdinamicasM
           $SievademetaM = new SievademetaM();                                             //id_meta_individual       SievademetaM
           $SievadeinstrumentoM = new SievadeinstrumentoM();                               //id_int_gest_rend         SievadeinstrumentoM
           $SievadeverboM  = new SievadeverboM ();                                         //id_verbo                 SievadeverboM
           $SievadeunidadM = new SievadeunidadM();                                         //id_tipo_unidad           SievadeunidadM
           $SievadeparametroM = new SievadeparametroM();                                   //id_val_parametro         SievadeparametroM
           $SievadealineacionM = new SievadealineacionM();                                //id_alineacion_pnd        SievadealineacionMM


           $sievade->desc_um_medicina = $request->input('desc_um_medicina');
           $sievade->obj_contribucion = $request->input('obj_contribucion');
           $sievade->satisfactorio = $request->input('satisfactorio');
           $sievade->no_satisfactorio = $request->input('no_satisfactorio');
           $sievade->no_aprobatorio = $request->input('no_aprobatorio');
           $sievade->peso_ind = $request->input('peso_ind');
           $sievade->estatus = $request->input('estatus') ? true : false;
           $sievade->ponderacion = $request->input('ponderacion');
           $sievade->unidad_medica = $request->input('unidad_medica');
           $sievade->calificacion = $request->input('calificacion');



          // Declaración de catalogos
           $selectMetaI = $SievademetaM->listorganizacion();
           $selectMetaIEdit = isset($item->id_meta_individual) ? $SievademetaM->edit($item->id_meta_individual) : [];

           $selectinstrumento = $SievadeinstrumentoM->listorganizacion();
           $selectinstrumentoEdit = isset($item->id_int_gest_rend) ? $SievadeinstrumentoM->edit($item->id_int_gest_rend) : [];

           $selectverbo = $SievadeverboM->listorganizacion();
           $selectverboEdit = isset($item->id_verbo) ? $SievadeverboM->edit($item->id_verbo) : [];

           $selecunidad = $SievadeunidadM->listorganizacion();
           $selecunidadEdit = isset($item->id_tipo_unidad) ? $SievadeunidadM->edit($item->id_tipo_unidad) : [];

           $selecparametro = $SievadeparametroM->listorganizacion();
           $selecparametroEdit = isset($item->id_val_parametro) ? $SievadeparametroM->edit($item->id_val_parametro) : [];

           $selecalineacion = $SievadealineacionM->listorganizacion();
           $selecalineacionEdit = isset($item->id_alineacion_pnd) ? $SievadealineacionM->edit($item->id_alineacion_pnd) : [];
        }

         return view('Sievade.Tablemetasdinamicas.form', compact('item','selectMetaI','selectMetaIEdit', 'selectinstrumento','selectinstrumentoEdit',
                    'selectverbo','selectverboEdit','selecunidad', 'selecunidadEdit','selecparametro', 'selecparametroEdit','selecalineacion', 'selecalineacionEdit'));
    }



public function save(Request $request)
    {
       Log::info('TablemetasdinamicasC  - Funcion Save');     // JHR COMENTARIO

       $TablemetasdinamicasM = new TablemetasdinamicasM();
       $messagesC = new MessagesC();
       $now = Carbon::now(); // Usando Carbon para la fecha actual

       if (!$request->id_metas_ind) {
            //  nuevo curso
            $nuevoCurso = $TablemetasdinamicasM::create([

                 'id_usuarios' => Auth::user()->id,    // DATA_SYSTEM
                 'id_alineacion_pnd' => strtoupper($request->id_alineacion_pnd),
                 'id_meta_individual' => strtoupper($request->id_meta_individual),
	             'id_int_gest_rend' => strtoupper($request->id_int_gest_rend),
	             'id_verbo' => strtoupper($request->id_verbo),
	             'desc_um_medicina' => strtoupper($request->desc_um_medicina),
	             'obj_contribucion' => strtoupper($request->obj_contribucion),
	             'satisfactorio' => strtoupper($request->satisfactorio),
                 'no_satisfactorio' => strtoupper($request->no_satisfactorio),
	             'no_aprobatorio' => strtoupper($request->no_aprobatorio),
	             'id_tipo_unidad' => strtoupper($request->id_tipo_unidad),
	             'peso_ind' => strtoupper($request->peso_ind),
             //    'estatus' => strtoupper($request->estatus) ?? false,
                 'estatus' => $request->has('estatus') ? true : false,
                 'id_val_parametro' => strtoupper($request->id_val_parametro),
                 'ponderacion' => strtoupper($request->ponderacion),
                 'unidad_medica' => strtoupper($request->unidad_medica),
                 'calificacion' => strtoupper($request->calificacion),
                 'id_usuario_sistema' => Auth::user()->id,
                 'fecha_usuario' => $now,

            ]);
        } else {
            // Modificar curso existente
            $data = [

                //'id_metas_ind' => $request->id_metas_ind,
                 'id_usuarios' => Auth::user()->id,    // DATA_SYSTEM
                 'id_alineacion_pnd' => strtoupper($request->id_alineacion_pnd),
                 'id_meta_individual' => strtoupper($request->id_meta_individual),
	             'id_int_gest_rend' => strtoupper($request->id_int_gest_rend),
	             'id_verbo' => strtoupper($request->id_verbo),
	             'desc_um_medicina' => strtoupper($request->desc_um_medicina),
	             'obj_contribucion' => strtoupper($request->obj_contribucion),
	             'satisfactorio' => strtoupper($request->satisfactorio),
                 'no_satisfactorio' => strtoupper($request->no_satisfactorio),
	             'no_aprobatorio' => strtoupper($request->no_aprobatorio),
	             'id_tipo_unidad' => strtoupper($request->id_tipo_unidad),
	             'peso_ind' => strtoupper($request->peso_ind),
	          //   'estatus' => strtoupper($request->estatus) ?? false,
                 'estatus' => $request->has('estatus') ? true : false,
	             'id_val_parametro' => strtoupper($request->id_val_parametro),
                 'ponderacion' => strtoupper($request->ponderacion),
                 'unidad_medica' => strtoupper($request->unidad_medica),
                 'calificacion' => strtoupper($request->calificacion),
                 'id_usuario_sistema' => Auth::user()->id,
                 'fecha_usuario' => $now,
            ];

            $TablemetasdinamicasM::where('id_metas_ind', $request->id_metas_ind)->update($data);
        }

        // Redirigir con mensaje de éxito
        return $messagesC->messageSuccessRedirect('Tablemetasdinamicas.list', 'Guardado exitosamente.');
    }


 public function searchTable(Request $request)
    {
        Log::info('TablemetasdinamicasM - Función searchTable ');
        try {
            $iterator = $request->input('iterator', 1); // Página actual con valor por defecto
            $searchValue = $request->input('searchValue', ''); // Valor de búsqueda con valor por defecto

            Log::info('TablemetasdinamicasC - Función searchTable 1:');
            Log::info('TVALOR DE LA VARIABLE $iterator:');
            Log::info($iterator);
            Log::info('TVALOR DE LA VARIABLE $searchValue:');
            Log::info($searchValue);
            Log::info('TVALOR DE LA VARIABLE $metasDin:');
            Log::info($metasDin);

            // Obtener resultados
            $TablemetasdinamicasM = new TablemetasdinamicasM();

            Log::info('TablemetasdinamicasC - Función searchTable 2');
            Log::info('TVALOR DE LA VARIABLE $iterator:');
            Log::info($iterator);
            Log::info('TVALOR DE LA VARIABLE $searchValue:');
            Log::info($searchValue);
            Log::info('TVALOR DE LA VARIABLE $metasDin:');
            Log::info($metasDin);

            $metasDin = $TablemetasdinamicasM->list($iterator, $searchValue);


            Log::info('TablemetasdinamicasC - Función searchTable 3:');
            Log::info('TVALOR DE LA VARIABLE $iterator:');
            Log::info($iterator);
            Log::info('TVALOR DE LA VARIABLE $searchValue:');
            Log::info($searchValue);
            Log::info('TVALOR DE LA VARIABLE $metasDin:');
            Log::info($metasDin);

            // Obtener resultados
            return response()->json([
                'status' => true,
                'message' => 'Resultados obtenidos correctamente',
                'data' => $metasDin->items(), // Obtiene los elementos de la paginación
                'pagination' => [
                    'current_page' => $metasDin->currentPage(),
                    'last_page' => $metasDin->lastPage(),
                    'per_page' => $metasDin->perPage(),
                    'total' => $metasDin->total(),
                ],
            ], 200);

            Log::info('TablemetasdinamicasC - Función searchTable 4:');
            Log::info('TVALOR DE LA VARIABLE $iterator:');
            Log::info($iterator);
            Log::info('TVALOR DE LA VARIABLE $searchValue:');
            Log::info($searchValue);
            Log::info('TVALOR DE LA VARIABLE $metasDin:');
            Log::info($metasDin);


        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al procesar la solicitud',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy($id)
    {
        Log::info('TablemetasdinamicasC  - Funcion destroy');     // JHR COMENTARIO

           try {
            $sievade = TablemetasdinamicasM::findOrFail($id);
                $sievade->delete();
                return response()->json(['success' => true, 'message' => 'Eliminado exitosamente.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al eliminar'], 500);

            }

    }

}


