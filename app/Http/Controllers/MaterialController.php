<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Material;

class MaterialController extends Controller
{
    public function listar()
    {
        $materiales = Material::all();
        return response()->json($materiales, 200);
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->search;
        $resultado = Material::where('nombre', 'LIKE', "%$busqueda%")->get();
        return response()->json($resultado, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $material = Material::create($this->filtrar($request));
        return response()->json($material, 201);
    }

    public function editar($id, Request $request)
    {
        $material = Material::findOrFail($id);
        $material->update($this->filtrar($request));
        return response()->json($material, 201);
    }

    public function borrar($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return response()->json([], 200);
    }

    public function validar($material)
    {
        return $this->validate($material, [
            'nombre' => 'bail|required|string|min:3|max:20'
        ]);
    }

    public function filtrar($material)
    {
        return [
            'nombre' => $material->input('nombre')
        ];
    }
}
