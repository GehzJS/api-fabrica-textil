<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use DB;
use App\Models\ModeloLote;
use App\Models\Modelo;

class ModeloLoteController extends Controller
{
    public function inicio($fila)
    {
        $lotes = ModeloLote::with('modelo')->paginate($fila);
        return response()->json($lotes, 200);
    }

    public function mostrar($id)
    {
        $lote = ModeloLote::find($id);
        return response()->json($lote, 200);
    }

    public function buscar($campo, Request $request)
    {
        $busqueda = $request->search;
        $modelo = Modelo::where("$campo", 'LIKE', "%$busqueda%")->get();
        if(count($modelo) > 0) {
            $resultado = ModeloLote::with('modelo')->where('modelo_id', 'LIKE', $modelo[0]['id'])->paginate(10);
            return response()->json($resultado, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $lote = ModeloLote::create($this->filtrar($request));
        return response()->json($lote, 201);
    }

    public function editar($id, Request $request)
    {
        $lote = ModeloLote::findOrFail($id);
        $lote->update($this->filtrar($request));
        return response()->json($lote, 201);
    }

    public function borrar($id)
    {
        $lote = ModeloLote::findOrFail($id);
        $lote->delete();
        return response()->json([], 200);
    }

    public function validar($lote)
    {
        return $this->validate($lote, [
            'cantidad' => 'bail|required|integer|min:1',
            'descripcion' => 'required|string|min:10|max:256',
            'modelo_id' => 'required|integer|min:1'
        ]);
    }

    public function filtrar($lote)
    {
        return [
            'cantidad' => $lote->input('cantidad'),
            'descripcion' => $lote->input('descripcion'),
            'modelo_id' => $lote->input('modelo_id')
        ];
    }
}
