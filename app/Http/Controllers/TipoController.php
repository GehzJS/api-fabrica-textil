<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Tipo;

class TipoController extends Controller
{
    public function listar()
    {
        $tipos = Tipo::all();
        return response()->json($tipos, 200);
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->search;
        $resultado = Tipo::where('nombre', 'LIKE', "%$busqueda%")->get();
        return response()->json($resultado, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $tipo = Tipo::create($this->filtrar($request));
        return response()->json($tipo, 201);
    }

    public function editar($id, Request $request)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo->update($this->filtrar($request));
        return response()->json($tipo, 201);
    }

    public function borrar($id)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo->delete();
        return response()->json([], 200);
    }

    public function validar($tipo)
    {
        return $this->validate($tipo, [
            'nombre' => 'bail|required|string|min:3|max:20'
        ]);
    }

    public function filtrar($tipo)
    {
        return [
            'nombre' => $tipo->input('nombre')
        ];
    }
}
