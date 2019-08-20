<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use DB;
use App\Models\Operacion;
use App\Models\Modelo;

class OperacionController extends Controller
{
    public function inicio($fila)
    {
        $operaciones = Operacion::with(['modelo', 'tela'])->paginate($fila);
        return response()->json($operaciones, 200);
    }

    public function listar()
    {
        $operaciones = Operacion::with('tela')->get();
        return response()->json($operaciones, 200);
    }

    public function mostrar($id)
    {
        $operacion = Operacion::find($id);
        return response()->json($operacion, 200);
    }

    public function buscarPorOperacion($campo, Request $request)
    {
        $busqueda = $request->search;
        $resultado = Operacion::with(['modelo'])->where("$campo", 'LIKE', "%$busqueda%")->paginate(10);
        return response()->json($resultado, 200);
    }

    public function buscarPorModelo($campo, Request $request)
    {
        $busqueda = $request->search;
        $modelo = Modelo::where("$campo", 'LIKE', "%$busqueda%")->get();
        if(count($modelo) > 0) {
            $resultado = Operacion::with(['modelo'])->where('modelo_id', 'LIKE', $modelo[0]['id'])->paginate(10);
            return response()->json($resultado, 200);
        } else {
            return response()->json([], 404);
        }
    }
    
    public function guardar(Request $request)
    {
        $this->validar($request);
        $operacion = Operacion::create($this->filtrar($request));
        return response()->json($operacion, 201);
    }

    public function editar($id, Request $request)
    {
        $operacion = Operacion::findOrFail($id);
        $operacion->update($this->filtrar($request));
        return response()->json($operacion, 201);
    }

    public function borrar($id)
    {
        $operacion = Operacion::findOrFail($id);
        $operacion->delete();
        return response()->json([], 200);
    }

    public function validar($operacion)
    {
        return $this->validate($operacion, [
            'nombre' => 'bail|unique:operaciones|required|string|min:5|max:20',
            'precio' => 'required|numeric',
            'maquina' => 'required|string|min:5|max:20',
            'necesario' => 'required|numeric',
            'color' => 'required|string|min:3|max:7',
            'descripcion' => 'required|string|min:10|max:256',
            'modelo_id' => 'required|integer|min:1',
            'tela_id' => 'required|integer|min:1'
        ]);
    }

    public function filtrar($operacion)
    {
        return [
            'nombre' => $operacion->input('nombre'),
            'precio' => $operacion->input('precio'),
            'maquina' => $operacion->input('maquina'),
            'necesario' => $operacion->input('necesario'),
            'color' => $operacion->input('color'),
            'descripcion' => $operacion->input('descripcion'),
            'modelo_id' => $operacion->input('modelo_id'),
            'tela_id' => $operacion->input('tela_id')
        ];
    }
}
