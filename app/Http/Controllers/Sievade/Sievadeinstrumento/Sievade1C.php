<?php

namespace App\Http\Controllers\Sievade\Sievadeinstrumento;

use App\Http\Controllers\Controller;
use App\Models\Sievade\SievadeinstrumentoM;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\MessagesC;

class Sievade1C extends Controller
{
    public function  list()
    {
        // Obtener todos registros
        $Sievadeinstrumento = SievadeinstrumentoM::all();

        // Pasar los registros a la vista
        return view('Sievade.Sievadeinstrumento.list', compact('Sievadeinstrumento'));
    }

 public function save(Request $request)
    {
        $SievadeinstrumentoM = new SievadeinstrumentoM();
        $messagesC = new MessagesC();
        $now = Carbon::now(); // Usando Carbon para la fecha actual

        if (!$request->id_int_gest_rend) {
            //  nuevo curso
            $nuevoCurso = $SievadeinstrumentoM::create([
                'descripcion' => $request->descripcion,
                'estatus' => $request->estatus ?? false,
                'id_usuario_sistema' => Auth::user()->id,
                'fecha_usuario' => $now,
            ]);
        } else {
            // Modificar curso existente
            $data = [
                'descripcion' => $request->descripcion,
                'estatus' => $request->estatus ?? false,
                'id_usuario_sistema' => Auth::user()->id,
                'fecha_usuario' => $now,
            ];

            $SievadeinstrumentoM::where('id_int_gest_rend', $request->id_int_gest_rend)->update($data);
        }

        // Redirigir con mensaje de éxito
        return $messagesC->messageSuccessRedirect('Sievadeinstrumento.list', 'Guardado exitosamente.');
    }

    public function create()
    {
        $item = new SievadeinstrumentoM();
        $item->id_int_gest_rend = '';  // Valor por defecto
        $item->descripcion = '';    // Valor por defecto
        $item->estatus = '';

        return view('Sievade.Sievadeinstrumento.form', compact('item'));
    }

    public function searchTable(Request $request)
    {
        $searchValue = $request->get('searchValue');  // Término de búsqueda
        $iterator = $request->get('iterator', 0);  // Si no se pasa iterador, por defecto será 0 (primera página)

        // Filtrar los cursos que coincidan con la búsqueda
        $sievades = SievadeinstrumentoM::where('descripcion', 'like', '%' . $searchValue . '%')
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
            $sievade = SievadeinstrumentoM::findOrFail($id);
                $sievade->delete();
                return response()->json(['success' => true, 'message' => 'Eliminado exitosamente.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al eliminar '], 500);

            }

    }
    public function edit(Request $request, $id)
    {
        $sievade = SievadeinstrumentoM ::find($id);
        $messagesC = new MessagesC();
        if ($request->isMethod('post')) {
            // Validar los datos del formulario
            $request->validate([
                'descripcion' => 'required|string|max:255',
            ]);

            // Actualizar los datos del curso
            $sievade->descripcion = $request->input('descripcion');
            $sievade->estatus = $request->input('estatus') ? true : false;
            $sievade->save();
            return $messagesC->messageSuccessRedirect('Sievadeinstrumento.list', 'Actualizado exitosamente.');
            // Redirigir a la lista de cursos con un mensaje de éxito
            //return redirect()->route('Sievadeinstrumento.list')->with('success', 'Curso actualizado exitosamente.');
        }

        return view('Sievade.Sievadeinstrumento.edit', compact('sievade'));
    }

}



