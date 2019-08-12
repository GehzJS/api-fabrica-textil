<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Seccion;

class SeccionController extends Controller
{
    public function listar()
    {
        $secciones = Seccion::all();
        return response()->json($secciones, 200);
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->search;
        $resultado = Seccion::where('nombre', 'LIKE', "%$busqueda%")->get();
        return response()->json($resultado, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $seccion = Seccion::create($this->filtrar($request));
        return response()->json($seccion, 201);
    }

    public function editar($id, Request $request)
    {
        $seccion = Seccion::findOrFail($id);
        $seccion->update($this->filtrar($request));
        return response()->json($seccion, 201);
    }

    public function borrar($id)
    {
        $seccion = Seccion::findOrFail($id);
        $seccion->delete();
        return response()->json([], 200);
    }

    public function validar($seccion)
    {
        return $this->validate($seccion, [
            'nombre' => 'bail|required|string|min:3|max:20'
        ]);
    }

    public function filtrar($seccion)
    {
        return [
            'nombre' => $seccion->input('nombre')
        ];
    }
}
