<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use DB;
use App\Models\Nomina;
use App\Models\Empleado;

class NominaController extends Controller
{
    public function inicio($fila, $estado)
    {
        if($estado == 'todas') {
            $nominas = Nomina::with(['empleado', 'items'])->paginate($fila);
        } else {
            $nominas = Nomina::with(['empleado', 'items'])
                                        ->where('estado', 'LIKE', "$estado")
                                        ->paginate($fila);
        }
        return response()->json($nominas, 200);
    }

    public function mostrar($id)
    {
        $nomina = Nomina::find($id);
        return response()->json($nomina, 200);
    }

    public function buscar($campo, Request $request)
    {
        $busqueda = $request->search;
        $empleado = Empleado::where("$campo", 'LIKE', "%$busqueda%")->get();
        if(count($empleado) > 0) {
            $resultado = Nomina::with(['empleado', 'items'])->where('empleado_id', 'LIKE', $empleado[0]['id'])->paginate(10);
            return response()->json($resultado, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function empleados() {
        $empleados = Empleado::all();
        return response()->json($empleados, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $nomina = Nomina::create($this->filtrar($request));
        return response()->json($nomina, 201);
    }

    public function editar($id, Request $request)
    {
        $nomina = Nomina::findOrFail($id);
        $nomina->update($this->filtrar($request));
        return response()->json($nomina, 201);
    }

    public function borrar($id)
    {
        $nomina = Nomina::findOrFail($id);
        $nomina->delete();
        return response()->json([], 200);
    }

    public function validar($nomina)
    {
        return $this->validate($nomina, [
            'empleado_id' => 'bail|required|integer|min:1',
            'descripcion' => 'required|string|min:10|max:256',
            'total' => 'required|numeric',
            'estado' => 'required|string'
        ]);
    }

    public function filtrar($nomina)
    {
        return [
            'empleado_id' => $nomina->input('empleado_id'),
            'descripcion' => $nomina->input('descripcion'),
            'total' => $nomina->input('total'),
            'estado' => $nomina->input('estado')
        ];
    }
}
