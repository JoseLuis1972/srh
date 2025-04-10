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
        return view('Sievade.Tablemetasdinamicas.list');
      }



    public function create()
      {
        $item = new TablemetasdinamicasM();
        // $item->alineacion_pnd = '';

       $item->desc_um_medicina = '';
	   $item->obj_contribucion = '';
	   $item->satisfactorio = '';
	   $item->no_satisfactorio  = '';
	   $item->no_aprobatorio = '';
	   $item->peso_ind = '';
	   $item->dependencia = '';
	   $item->ur = '';
	   $item->estatus = '';
	   $item->area_responsable = '';
       $item->ponderacion = '';
       $item->unidad_medica = '';
       $item->calificacion = '';

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


   //public function edit(Request $request, $id)
   public function edit($id)
    {
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
                'dependencia' => 'required|string|max:200',
                'ur' => 'required|string|max:200',
                'estatus' => 'required|string|max:200',
                'area_responsable' => 'required|string|max:200',
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
           $sievade->dependencia = $request->input('dependencia');
           $sievade->ur = $request->input('ur');
           $sievade->estaus = $request->input('estatus');
           $sievade->area_responsable = $request->input('area_responsable');
           $sievade->ponderacion = $request->input('ponderacion');
           $sievade->unidad_medica = $request->input('unidad_medica');
           $sievade->calificacion = $request->input('calificacion');



          // Declaración de catalogos
           $selectMetaI = $SievademetaM->listorganizacion();
           $selectMetaIEdit = isset($item->id_meta_individual) ? $SievademetaM->edit($item->id_meta_individual) : [];

           $selectinstrumento = $SievadeinstrumentoM->listorganizacion();
           $selectinstrumentoEdit = isset($item->id_int_gest_rend) ? $SSievadeinstrumentoM->edit($item->id_int_gest_rend) : [];

           $selectverbo = $SievadeverboM->listorganizacion();
           $selectverboEdit = isset($item->id_verbo) ? $SievadeverboM->edit($item->id_verbo) : [];

           $selecunidad = $SievadeunidadM->listorganizacion();
           $selecunidadEdit = isset($item->id_tipo_unidad) ? $SievadeunidadM->edit($item->id_tipo_unidad) : [];

           $selecparametro = $SievadeparametroM->listorganizacion();
           $selecparametroEdit = isset($item->id_val_parametro) ? $SievadeparametroM->edit($item->id_val_parametro) : [];

           $selecalineacion = $SievadealineacionM->listorganizacion();
           $selecalineacionEdit = isset($item->id_alineacion_pnd) ? $SievadealineacionM->edit($item->id_alineacion_pnd) : [];
        }

        return view('Sievade.Tablemetasdinamicas.edit', compact('item','selectMetaI','selectMetaIEdit', 'selectinstrumento','selectinstrumentoEdit',
                    'selectverbo','selectverboEdit','selecunidad', 'selecunidadEdit','selecparametro', 'selecparametroEdit','selecalineacion', 'selecalineacionEdit'));
    }



public function save(Request $request)
    {
       $TablemetasdinamicasM = new TablemetasdinamicasM();
       $messagesC = new MessagesC();
       $now = Carbon::now(); // Usando Carbon para la fecha actual

       if (!$request->id_metas_ind) {
            //  nuevo curso
            $nuevoCurso = $TablemetasdinamicasM::create([

                 'id_usuarios' => Auth::user()->id,    // DATA_SYSTEM

                 'id_meta_individual' => $request->id_meta_individual,
	             'id_int_gest_rend' => $request->id_int_gest_rend,
	             'id_verbo' => $request->id_verbo,
	             'desc_um_medicina' => strtoupper($request->desc_um_medicina),
	             'obj_contribucion' => strtoupper($request->obj_contribucion),
	             'satisfactorio' => strtoupper($request->satisfactorio),
                 'no_satisfactorio' => strtoupper($request->satisfactorio),
	             'no_aprobatorio' => strtoupper($request->no_aprobatorio),
	             'id_tipo_unidad' => $request->id_tipo_unidad,
	             'peso_ind' => strtoupper($request->peso_ind),
	             'dependencia' => strtoupper($request->dependencia),
	             'ur' => strtoupper($request->ur),
	             'estatus' => strtoupper($request->estaus),
	             'area_responsable' => strtoupper($request->area_responsable),
                 'id_alineacion_pnd ' => strtoupper($request->id_alineacion_pnd ),
                 'ponderacion' => strtoupper($request->ponderacion),
                 'unidad_medica' => strtoupper($request->unidad_medica),
                 'calificacion ' => strtoupper($request->calificacion ),
                 'id_usuario_sistema' => Auth::user()->id,
                 'fecha_usuario' => $now,

            ]);
        } else {
            // Modificar curso existente
            $data = [

                //'id_metas_ind' => $request->id_metas_ind,
                 'id_usuarios' => Auth::user()->id,    // DATA_SYSTEM
                 'id_meta_individual' => $request->id_meta_individual,
	             'id_int_gest_rend' => $request->id_int_gest_rend,
	             'id_verbo' => $request->id_verbo,
	             'desc_um_medicina' => strtoupper($request->desc_um_medicina),
	             'obj_contribucion' => strtoupper($request->obj_contribucion),
	             'satisfactorio' => strtoupper($request->satisfactorio),
                 'no_satisfactorio' => strtoupper($request->satisfactorio),
	             'no_aprobatorio' => strtoupper($request->no_aprobatorio),
	             'id_tipo_unidad' => $request->id_tipo_unidad,
	             'peso_ind' => strtoupper($request->peso_ind),
	             'dependencia' => strtoupper($request->dependencia),
	             'ur' => strtoupper($request->ur),
	             'estatus' => strtoupper($request->estaus),
	             'area_responsable' => strtoupper($request->area_responsable),
                 'id_alineacion_pnd ' => strtoupper($request->id_alineacion_pnd ),
                 'ponderacion' => strtoupper($request->ponderacion),
                 'unidad_medica' => strtoupper($request->unidad_medica),
                 'calificacion ' => strtoupper($request->calificacion ),
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
        $searchValue = $request->get('searchValue');  // Término de búsqueda
        $iterator = $request->get('iterator', 0);  // Si no se pasa iterador, por defecto será 0 (primera página)

        // Filtrar los cursos que coincidan con la búsqueda

        //$sievades = SievadeverboM::where('id_usuarios', 'like', '%' . $searchValue . '%');
        //$sievades = TablemetasdinamicasM::where('id_metas_ind', 'like', '%' . $searchValue . '%');           //id_metas_ind           TablemetasdinamicasM

        $sievades = SievademetaM::where('descripcion', 'like', '%' . $searchValue . '%')                       //id_meta_individual     SievademetaM
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();
        $sievades = SievadeinstrumentoM::where('descripcion', 'like', '%' . $searchValue . '%')                //id_int_gest_rend       SievadeinstrumentoM
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = SievadeverboM::where('descripcion', 'like', '%' . $searchValue . '%')                      //id_verbo               SievadeverboM
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = SievadeunidadM::where('descripcion', 'like', '%' . $searchValue . '%')                      //id_tipo_unidad        SievadeunidadM
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = SievadeparametroM::where('descripcion', 'like', '%' . $searchValue . '%')                    //id_val_parametro     SievadeparametroM
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = SievadealineacionM::where('descripcion', 'like', '%' . $searchValue . '%')                  //id_alineacion_pnd      SievadealineacionM
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

//    CAMPOS  ****************************************

        $sievades = TablemetasdinamicasM::where('desc_um_medicina', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = TablemetasdinamicasM::where('obj_contribucion', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = TablemetasdinamicasM::where('satisfactorio', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = TablemetasdinamicasM::where('no_satisfactorio', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = TablemetasdinamicasM::where('no_aprobatorio', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = TablemetasdinamicasM::where('peso_ind', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = TablemetasdinamicasM::where('dependencia', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = TablemetasdinamicasM::where('ur', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = TablemetasdinamicasM::where('estatus', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

        $sievades = TablemetasdinamicasM::where('area_responsable', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

       $sievades = TablemetasdinamicasM::where('ponderacion', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

       $sievades = TablemetasdinamicasM::where('unidad_medica', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();

       $sievades = TablemetasdinamicasM::where('calificacion', 'like', '%' . $searchValue . '%')
                           ->offset($iterator)
                           ->limit(5)  // Límite de resultados por página
                           ->get();


        return response()->json([
            'value' => $sievades
        ]);
    }

    public function destroy($id)
    {
           try {
            $sievade = TablemetasdinamicasM::findOrFail($id);
                $sievade->delete();
                return response()->json(['success' => true, 'message' => 'Eliminado exitosamente.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al eliminar'], 500);

            }

    }


}


