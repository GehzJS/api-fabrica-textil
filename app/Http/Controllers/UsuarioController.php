<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use DB;
use App\Models\Usuario;
use App\Models\Empleado;

class UsuarioController extends Controller
{
    public function inicio($fila, $rol)
    {
        if($rol == 'todos') {
            $usuarios = Usuario::with('empleado')->paginate($fila);
        } else {
            $usuarios = Usuario::with('empleado')
                                        ->where('rol', 'LIKE', "$rol")
                                        ->paginate($fila);
        }
        return response()->json($usuarios, 200);
    }

    public function mostrar($id)
    {
        $usuario = Usuario::find($id);
        return response()->json($usuario, 200);
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->search;
        $resultado = Usuario::with('empleado')->where('usuario', 'LIKE', "%$busqueda%")->paginate(10);
        return response()->json($resultado, 200);
    }

    public function buscarPorEmpleado($campo, Request $request)
    {
        $busqueda = $request->search;
        $empleado = Empleado::where("$campo", 'LIKE', "%$busqueda%")->get();
        if(count($empleado) > 0) {
            $resultado = Usuario::with(['empleado'])->where('empleado_id', 'LIKE', $empleado[0]['id'])->paginate(10);
            return response()->json($resultado, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $usuario = Usuario::create($this->filtrar($request));
        $empleado = Empleado::findOrFail($request->empleado_id);
        $empleado->es_usuario = 'Si';
        $nuevo = (array) $empleado;
        $empleado->update($nuevo);
        return response()->json($usuario, 201);
    }

    public function editar($id, Request $request)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($this->filtrar($request));
        return response()->json($usuario, 201);
    }

    public function borrar($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return response()->json([], 200);
    }

    public function validar($usuario)
    {
        return $this->validate($usuario, [
            'usuario' => 'bail|unique:usuarios|required|string|min:5|max:20',
            'contrasena' => 'required|alpha_dash|min:8|max:20',
            'rol' => 'required',
            'empleado_id' => 'required|integer|min:1'
        ]);
    }

    public function filtrar($usuario)
    {
        return [
            'usuario' => $usuario->input('usuario'),
            'contrasena' => $usuario->input('contrasena'),
            'rol' => $usuario->input('rol'),
            'empleado_id' => $usuario->input('empleado_id')
        ];
    }
}
