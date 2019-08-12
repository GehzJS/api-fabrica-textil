<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Maquina;

class MaquinaController extends Controller
{
    public function listar()
    {
        $maquinas = Maquina::all();
        return response()->json($maquinas, 200);
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->search;
        $resultado = Maquina::where('nombre', 'LIKE', "%$busqueda%")->get();
        return response()->json($resultado, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $maquina = Maquina::create($this->filtrar($request));
        return response()->json($maquina, 201);
    }

    public function editar($id, Request $request)
    {
        $maquina = Maquina::findOrFail($id);
        $maquina->update($this->filtrar($request));
        return response()->json($maquina, 201);
    }

    public function borrar($id)
    {
        $maquina = Maquina::findOrFail($id);
        $maquina->delete();
        return response()->json([], 200);
    }

    public function validar($maquina)
    {
        return $this->validate($maquina, [
            'nombre' => 'bail|required|string|min:3|max:20'
        ]);
    }

    public function filtrar($maquina)
    {
        return [
            'nombre' => $maquina->input('nombre')
        ];
    }
}
