<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use DB;
use App\Models\Defecto;
use App\Models\Modelo;
use App\Models\Empleado;

class DefectoController extends Controller
{
    public function inicio($fila)
    {
        $defectos = Defecto::with(['empleado', 'modelo'])->paginate($fila);
        return response()->json($defectos, 200);
    }

    public function mostrar($id)
    {
        $defecto = Defecto::find($id);
        return response()->json($defecto, 200);
    }

    public function buscarPorModelo($campo, Request $request)
    {
        $busqueda = $request->search;
        $modelo = Modelo::where("$campo", 'LIKE', "%$busqueda%")->get();
        if(count($modelo) > 0) {
            $resultado = Defecto::with(['empleado', 'modelo'])->where('modelo_id', 'LIKE', $modelo[0]['id'])->paginate(10);
            return response()->json($resultado, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function buscarPorEmpleado($campo, Request $request)
    {
        $busqueda = $request->search;
        $empleado = Empleado::where("$campo", 'LIKE', "%$busqueda%")->get();
        if(count($empleado) > 0) {
            $resultado = Defecto::with(['empleado', 'modelo'])->where('empleado_id', 'LIKE', $empleado[0]['id'])->paginate(10);
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
        $defecto = Defecto::create($this->filtrar($request));
        return response()->json($defecto, 201);
    }

    public function editar($id, Request $request)
    {
        $defecto = Defecto::findOrFail($id);
        $defecto->update($this->filtrar($request));
        return response()->json($defecto, 201);
    }

    public function borrar($id)
    {
        $defecto = Defecto::findOrFail($id);
        $defecto->delete();
        return response()->json([], 200);
    }

    public function validar($defecto)
    {
        return $this->validate($defecto, [
            'cantidad' => 'bail|required|integer|min:1',
            'descripcion' => 'required|string|min:10|max:256',
            'empleado_id' => 'required|integer|min:1',
            'modelo_id' => 'required|integer|min:1',
        ]);
    }

    public function filtrar($defecto)
    {
        return [
            'cantidad' => $defecto->input('cantidad'),
            'descripcion' => $defecto->input('descripcion'),
            'empleado_id' => $defecto->input('empleado_id'),
            'modelo_id' => $defecto->input('modelo_id')
        ];
    }
}
