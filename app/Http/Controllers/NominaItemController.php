<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use DB;
use App\Models\NominaItem;
use App\Models\Operacion;
use App\Models\Tela;

class NominaItemController extends Controller
{
    public function inicio()
    {
        $items = NominaItem::with(['nomina', 'operacion'])->get();
        return response()->json($items, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $item = NominaItem::create($this->filtrar($request));
        $operacion = Operacion::findOrFail($request->operacion_id);
        $tela = Tela::findOrFail($operacion->tela_id);
        $tela->stock = $tela->stock - ($request->cantidad * ($operacion->necesario / 100));
        $nueva = (array) $tela;
        $tela->update($nueva);
        return response()->json($tela, 201);
    }

    public function editar($id, Request $request)
    {
        $item = NominaItem::findOrFail($id);
        $item->update($this->filtrar($request));
        return response()->json($item, 201);
    }

    public function borrar($id)
    {
        $item = NominaItem::findOrFail($id);
        $item->delete();
        return response()->json([], 200);
    }

    public function validar($item)
    {
        return $this->validate($item, [
            'cantidad' => 'bail|required|integer|min:1',
            'precio' => 'required|numeric',
            'operacion' => 'required|string|min:5|max:20',
            'nomina_id' => 'required|integer|min:1',
            'operacion_id' => 'required|integer|min:1'
        ]);
    }

    public function filtrar($item)
    {
        return [
            'cantidad' => $item->input('cantidad'),
            'precio' => $item->input('precio'),
            'operacion' => $item->input('operacion'),
            'nomina_id' => $item->input('nomina_id'),
            'operacion_id' => $item->input('operacion_id')
        ];
    }
}
