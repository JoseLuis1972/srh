<?php

namespace App\Http\Controllers\Sievade\Sievadeparametro;

use App\Http\Controllers\Controller;
use App\Models\Sievade\SievadeparametroM;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\MessagesC;

class Sievade11C extends Controller
{
    public function  list()
    {
        // Obtener todos los cursos de coordinación
        $Sievadeparametro = SievadeparametroM::all();

        // Pasar los cursos a la vista
        return view('Sievade.Sievadeparametro.list', compact('Sievadeparametro'));
    }

  public function save(Request $request)
    {
        $SievadeparametroM = new SievadeparametroM();
        $messagesC = new MessagesC();
        $now = Carbon::now(); // Usando Carbon para la fecha actual

        if (!$request->id_val_parametro) {
            //  nuevo curso
            $nuevoCurso = $SievadeparametroM::create([
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

            $SievadeparametroM::where('id_val_parametro', $request->id_val_parametro)->update($data);
        }

        // Redirigir con mensaje de éxito
        return $messagesC->messageSuccessRedirect('Sievadeparametro.list', 'Guardado exitosamente.');
    }

    public function create()
    {
        $item = new SievadeparametroM();
        $item->id_val_parametro = '';  // Valor por defecto
        $item->descripcion = '';    // Valor por defecto
        $item->estatus = '';

        return view('Sievade.Sievadeparametro.form', compact('item'));
    }
    public function searchTable(Request $request)
    {
        $searchValue = $request->get('searchValue');  // Término de búsqueda
        $iterator = $request->get('iterator', 0);  // Si no se pasa iterador, por defecto será 0 (primera página)

        // Filtrar los cursos que coincidan con la búsqueda
        $sievades = SievadeparametroM::where('descripcion', 'like', '%' . $searchValue . '%')
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
            $sievade = SievadeparametroM::findOrFail($id);
                $sievade->delete();
                return response()->json(['success' => true, 'message' => 'Eliminado exitosamente.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al eliminar el curso'], 500);

            }

    }

    public function edit(Request $request, $id)
    {
        $sievade = SievadeparametroM ::find($id);
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
            return $messagesC->messageSuccessRedirect('Sievadeparametro.list', 'Actualizado exitosamente.');
            // Redirigir a la lista de cursos con un mensaje de éxito
            //return redirect()->route('Sievadeparametro.list')->with('success', 'Curso actualizado exitosamente.');
        }

        return view('Sievade.Sievadeparametro.edit', compact('sievade'));
    }

}


