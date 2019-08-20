<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use DB;
use App\Models\Adquisicion;
use App\Models\Proveedor;

class AdquisicionController extends Controller
{
    public function inicio($fila, $estado)
    {
        if($estado == 'todas') {
            $adquisiciones = Adquisicion::with(['proveedor', 'items'])->paginate($fila);
        } else {
            $adquisiciones = Adquisicion::with(['proveedor', 'items'])
                                        ->where('estado', 'LIKE', "$estado")
                                        ->paginate($fila);
        }
        return response()->json($adquisiciones, 200);
    }

    public function mostrar($id)
    {
        $adquisicion = Adquisicion::find($id);
        return response()->json($adquisicion, 200);
    }

    public function buscar($campo, Request $request)
    {
        $busqueda = $request->search;
        $proveedor = Proveedor::where("$campo", 'LIKE', "%$busqueda%")->get();
        if(count($proveedor) > 0) {
            $resultado = Adquisicion::with(['proveedor', 'items'])->where('proveedor_id', 'LIKE', $proveedor[0]['id'])->paginate(10);
            return response()->json($resultado, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function proveedores() {
        $proveedores = Proveedor::all();
        return response()->json($proveedores, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $adquisicion = Adquisicion::create($this->filtrar($request));
        return response()->json($adquisicion, 201);
    }

    public function editar($id, Request $request)
    {
        $adquisicion = Adquisicion::findOrFail($id);
        $adquisicion->update($this->filtrar($request));
        return response()->json($adquisicion, 201);
    }

    public function borrar($id)
    {
        $adquisicion = Adquisicion::findOrFail($id);
        $adquisicion->delete();
        return response()->json([], 200);
    }

    public function validar($adquisicion)
    {
        return $this->validate($adquisicion, [
            'proveedor_id' => 'bail|required|integer|min:1',
            'descripcion' => 'required|string|min:10|max:256',
            'total' => 'required|numeric',
            'estado' => 'required|string'
        ]);
    }

    public function filtrar($adquisicion)
    {
        return [
            'proveedor_id' => $adquisicion->input('proveedor_id'),
            'descripcion' => $adquisicion->input('descripcion'),
            'total' => $adquisicion->input('total'),
            'estado' => $adquisicion->input('estado')
        ];
    }
}
