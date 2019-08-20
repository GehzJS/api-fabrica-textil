<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use DB;
use App\Models\Venta;
use App\Models\Cliente;

class VentaController extends Controller
{
    public function inicio($fila, $estado)
    {
        if($estado == 'todas') {
            $ventas = Venta::with(['cliente', 'items'])->paginate($fila);
        } else {
            $ventas = Venta::with(['cliente', 'items'])
                                        ->where('estado', 'LIKE', "$estado")
                                        ->paginate($fila);
        }
        return response()->json($ventas, 200);
    }

    public function mostrar($id)
    {
        $venta = Venta::find($id);
        return response()->json($venta, 200);
    }

    public function buscar($campo, Request $request)
    {
        $busqueda = $request->search;
        $cliente = Cliente::where("$campo", 'LIKE', "%$busqueda%")->get();
        if(count($cliente) > 0) {
            $resultado = Venta::with(['cliente', 'items'])->where('cliente_id', 'LIKE', $cliente[0]['id'])->paginate(10);
            return response()->json($resultado, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $venta = Venta::create($this->filtrar($request));
        return response()->json($venta, 201);
    }

    public function editar($id, Request $request)
    {
        $venta = Venta::findOrFail($id);
        $venta->update($this->filtrar($request));
        return response()->json($venta, 201);
    }

    public function borrar($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();
        return response()->json([], 200);
    }

    public function validar($venta)
    {
        return $this->validate($venta, [
            'cliente_id' => 'bail|required|integer|min:1',
            'descripcion' => 'required|string|min:10|max:256',
            'total' => 'required|numeric',
            'estado' => 'required|string'
        ]);
    }

    public function filtrar($venta)
    {
        return [
            'cliente_id' => $venta->input('cliente_id'),
            'descripcion' => $venta->input('descripcion'),
            'total' => $venta->input('total'),
            'estado' => $venta->input('estado')
        ];
    }
}
