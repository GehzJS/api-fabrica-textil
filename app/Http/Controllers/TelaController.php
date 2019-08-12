<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Tela;

class TelaController extends Controller
{
    public function inicio($fila)
    {
        $telas = Tela::paginate($fila);
        return response()->json($telas, 200);
    }

    public function listar()
    {
        $telas = Tela::all();
        return response()->json($telas, 200);
    }
    
    public function mostrar($id)
    {
        $tela = Tela::find($id);
        return response()->json($tela, 200);
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->search;
        $resultado = Tela::where('nombre', 'LIKE', "%$busqueda%")->paginate(10);
        return response()->json($resultado, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $tela = Tela::create($this->filtrar($request));
        return response()->json($tela, 201);
    }

    public function editar($id, Request $request)
    {
        $tela = Tela::findOrFail($id);
        $tela->update($this->filtrar($request));
        return response()->json($tela, 201);
    }

    public function borrar($id)
    {
        $tela = Tela::findOrFail($id);
        $tela->delete();
        return response()->json([], 200);
    }

    public function validar($tela)
    {
        return $this->validate($tela, [
            'nombre' => 'bail|required|string|min:5|max:20',
            'color' => 'required|string|min:3|max:7',
            'caracteristicas' => 'required|string|min:10|max:256',
            'seccion' => 'required|string|min:5|max:20',
            'stock' => 'required|numeric',
            'precio' => 'required|numeric'
        ]);
    }
    
    public function filtrar($tela)
    {
        return [
            'nombre' => $tela->input('nombre'),
            'color' => $tela->input('color'),
            'caracteristicas' => $tela->input('caracteristicas'),
            'seccion' => $tela->input('seccion'),
            'stock' => $tela->input('stock'),
            'precio' => $tela->input('precio')
        ];
    }
}
