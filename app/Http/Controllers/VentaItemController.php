<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use DB;
use App\Models\VentaItem;
use App\Models\Modelo;

class VentaItemController extends Controller
{
    public function inicio()
    {
        $items = VentaItem::with(['venta', 'modelo'])-get();
        return response()->json($items, 200);
    }

    public function modelos() {
        $modelos = Modelo::all();
        return response()->json($modelos, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $item = VentaItem::create($this->filtrar($request));
        $modelo = Modelo::findOrFail($request->modelo_id);
        $modelo->stock = $modelo->stock - $request->cantidad;
        $nuevo = (array) $modelo;
        $modelo->update($nuevo);
        return response()->json($modelo, 201);
    }

    public function editar($id, Request $request)
    {
        $item = VentaItem::findOrFail($id);
        $item->update($this->filtrar($request));
        return response()->json($item, 201);
    }

    public function borrar($id)
    {
        $item = VentaItem::findOrFail($id);
        $item->delete();
        return response()->json([], 200);
    }

    public function validar($item)
    {
        return $this->validate($item, [
            'cantidad' => 'bail|required|integer|min:1',
            'precio' => 'required|numeric',
            'modelo' => 'required|string|min:5|max:20',
            'venta_id' => 'required|integer|min:1',
            'modelo_id' => 'required|integer|min:1'
        ]);
    }

    public function filtrar($item)
    {
        return [
            'cantidad' => $item->input('cantidad'),
            'precio' => $item->input('precio'),
            'modelo' => $item->input('modelo'),
            'venta_id' => $item->input('venta_id'),
            'modelo_id' => $item->input('modelo_id')
        ];
    }
}
