<?php

namespace App\Http\Controllers\Sievade\Sievadeindicador;

use App\Http\Controllers\Controller;
use App\Models\Sievade\SievadeindicadorM;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\MessagesC;

class Sievade8C extends Controller
{
    public function  list()
    {
        // Obtener todos los cursos de coordinación
        $Sievadeindicador = SievadeindicadorM::all();

        // Pasar los cursos a la vista
        return view('Sievade.Sievadeindicador.list', compact('Sievadeindicador'));
    }

 public function save(Request $request)
    {
        $SievadeindicadorM = new SievadeindicadorM();
        $messagesC = new MessagesC();
        $now = Carbon::now(); // Usando Carbon para la fecha actual

        if (!$request->id_int_gest_rend) {
            //  nuevo curso
            $nuevoCurso = $SievadeindicadorM::create([
                'descripcion' => strtoupper($request->descripcion),
                'estatus' => strtoupper($request->estatus) ?? false,
                'id_usuario_sistema' => Auth::user()->id,
                'fecha_usuario' => $now,
            ]);
        } else {
            // Modificar curso existente
            $data = [
                'descripcion' => strtoupper($request->descripcion),
                'estatus' => strtoupper($request->estatus) ?? false,
                'id_usuario_sistema' => Auth::user()->id,
                'fecha_usuario' => $now,
            ];

            $SievadeindicadorM::where('id_int_gest_rend', $request->id_int_gest_rend)->update($data);
        }

        // Redirigir con mensaje de éxito
        return $messagesC->messageSuccessRedirect('Sievadeindicador.list', 'Guardado exitosamente.');
    }
    public function create()
    {
        $item = new SievadeindicadorM();
        $item->id_indicador = '';  // Valor por defecto
        $item->descripcion = '';    // Valor por defecto
        $item->estatus = '';

        return view('Sievade.Sievadeindicador.form', compact('item'));
    }
    public function searchTable(Request $request)
    {
        $searchValue = $request->get('searchValue');  // Término de búsqueda
        $iterator = $request->get('iterator', 0);  // Si no se pasa iterador, por defecto será 0 (primera página)

        // Filtrar los cursos que coincidan con la búsqueda
        $sievades = SievadeindicadorM::where('descripcion', 'like', '%' . $searchValue . '%')
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
            $sievade = SievadeindicadorM::findOrFail($id);
                $sievade->delete();
                return response()->json(['success' => true, 'message' => 'Eliminado exitosamente.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al eliminar el curso'], 500);

            }

    }
    public function edit(Request $request, $id)
    {
        $sievade = SievadeindicadorM ::find($id);
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
            return $messagesC->messageSuccessRedirect('Sievadeindicador.list', 'Actualizado exitosamente.');
            // Redirigir a la lista de cursos con un mensaje de éxito
            //return redirect()->route('Sievadeindicador.list')->with('success', 'Curso actualizado exitosamente.');
        }

        return view('Sievade.Sievadeindicador.edit', compact('sievade'));
    }

}
