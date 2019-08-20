<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Empleado;

class EmpleadoController extends Controller
{
    public function inicio($fila, $cargo)
    {
        if($cargo == 'todos') {
            $empleados = Empleado::with('usuario')->paginate($fila);
        } else {
            $empleados = Empleado::with('usuario')
                                        ->where('cargo', 'LIKE', "$cargo")
                                        ->paginate($fila);
        }
        return response()->json($empleados, 200);
    }

    public function listar()
    {
        $empleados = Empleado::all();
        return response()->json($empleados, 200);
    }

    public function contar()
    {
        $empleados = Empleado::count();
        return response()->json($empleados, 200);
    }
    
    public function esUsuario()
    {
        $empleados = Empleado::where('es_usuario', 'LIKE', 'no')->get();
        return response()->json($empleados, 200);
    }

    public function mostrar($id)
    {
        $empleado = Empleado::find($id);
        return response()->json($empleado, 200);
    }

    public function buscar($campo, Request $request)
    {
        $busqueda = $request->search;
        $resultado = Empleado::where("$campo", 'LIKE', "%$busqueda%")->paginate(10);
        return response()->json($resultado, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $empleado = Empleado::create($this->filtrar($request));
        return response()->json($empleado, 201);
    }

    public function editar($id, Request $request)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->update($this->filtrar($request));
        return response()->json($empleado, 201);
    }

    public function borrar($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();
        return response()->json([], 200);
    }

    public function validar($empleado)
    {
        return $this->validate($empleado, [
            'nombre' => 'bail|required|string|min:3|max:20',
            'apellido_p' => 'required|string|min:3|max:15',
            'apellido_m' => 'required|string|min:3|max:15',
            'correo' => 'unique:empleados|required|email|min:12|max:30',
            'telefono' => 'unique:empleados|required|alpha_dash|min:10|max:15',
            'cargo' => 'required'
        ]);
    }

    public function filtrar($empleado)
    {
        return [
            'nombre' => $empleado->input('nombre'),
            'apellido_p' => $empleado->input('apellido_p'),
            'apellido_m' => $empleado->input('apellido_m'),
            'correo' => $empleado->input('correo'),
            'telefono' => $empleado->input('telefono'),
            'cargo' => $empleado->input('cargo'),
            'es_usuario' => $empleado->input('es_usuario')
        ];
    }
}
