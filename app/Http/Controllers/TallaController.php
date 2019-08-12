<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Talla;

class TallaController extends Controller
{
    public function listar()
    {
        $tallas = Talla::all();
        return response()->json($tallas, 200);
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->search;
        $resultado = Talla::where('nombre', 'LIKE', "%$busqueda%")->get();
        return response()->json($resultado, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $talla = Talla::create($this->filtrar($request));
        return response()->json($talla, 201);
    }

    public function editar($id, Request $request)
    {
        $talla = Talla::findOrFail($id);
        $talla->update($this->filtrar($request));
        return response()->json($talla, 201);
    }

    public function borrar($id)
    {
        $talla = Talla::findOrFail($id);
        $talla->delete();
        return response()->json([], 200);
    }

    public function validar($talla)
    {
        return $this->validate($talla, [
            'nombre' => 'bail|required|string|min:3|max:20'
        ]);
    }

    public function filtrar($talla)
    {
        return [
            'nombre' => $talla->input('nombre')
        ];
    }
}
