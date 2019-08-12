<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Modelo;
use App\Models\Seccion;
use App\Models\Talla;
use App\Models\Tipo;

class ModeloController extends Controller
{
    public function inicio($fila)
    {
        $modelos = Modelo::with(['operaciones'])->paginate($fila);
        return response()->json($modelos, 200);
    }

    public function listar() 
    {
        $modelos = Modelo::all();
        return response()->json($modelos, 200);
    }

    public function secciones() 
    {
        $secciones = Seccion::all();
        return response()->json($secciones, 200);
    }

    public function tallas() 
    {
        $tallas = Talla::all();
        return response()->json($tallas, 200);
    }

    public function tipos() 
    {
        $tipos = Tipo::all();
        return response()->json($tipos, 200);
    }

    public function mostrar($id)
    {
        $modelo = Modelo::find($id);
        return response()->json($modelo, 200);
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->search;
        $resultado = Modelo::where('nombre', 'LIKE', "%$busqueda%")->paginate(10);
        return response()->json($resultado, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $modelo = Modelo::create($this->filtrar($request));
        return response()->json($modelo, 201);
    }

    public function editar($id, Request $request)
    {
        $modelo = Modelo::findOrFail($id);
        $modelo->update($this->filtrar($request));
        return response()->json($modelo, 201);
    }

    public function borrar($id)
    {
        $modelo = Modelo::findOrFail($id);
        $modelo->delete();
        return response()->json([], 200);
    }

    public function validar($modelo)
    {
        return $this->validate($modelo, [
            'nombre' => 'bail|unique:modelos|required|string|min:5|max:20',
            'tipo' => 'required|string|min:5|max:20',
            'material' => 'required|string|min:5|max:20',
            'para' => 'required|string|min:4|max:20',
            'talla' => 'required|string|min:5|max:15',
            'stock' => 'required|integer',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string|min:10|max:256'
        ]);
    }

    public function filtrar($modelo)
    {
        return [
            'nombre' => $modelo->input('nombre'),
            'tipo' => $modelo->input('tipo'),
            'material' => $modelo->input('material'),
            'para' => $modelo->input('para'),
            'talla' => $modelo->input('talla'),
            'stock' => $modelo->input('stock'),
            'precio' => $modelo->input('precio'),
            'descripcion' => $modelo->input('descripcion')
        ];
    }
}
