<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use BD;
use App\Models\AdquisicionItem;
use App\Models\Tela;

class AdquisicionItemController extends Controller
{
    public function inicio()
    {
        $items = AdquisicionItem::with(['adquisicion', 'tela'])->get();
        return response()->json($items, 200);
    }

    public function telas() {
        $telas = Tela::all();
        return response()->json($telas, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $item = AdquisicionItem::create($this->filtrar($request));
        $tela = Tela::findOrFail($request->tela_id);
        $tela->stock = $tela->stock + $request->cantidad;
        $nueva = (array) $tela;
        $tela->update($nueva);
        return response()->json($item, 201);
    }

    public function editar($id, Request $request)
    {
        $item = AdquisicionItem::findOrFail($id);
        $item->update($this->filtrar($request));
        return response()->json($item, 201);
    }

    public function borrar($id)
    {
        $item = AdquisicionItem::findOrFail($id);
        $item->delete();
        return response()->json([], 200);
    }

    public function validar($item)
    {
        return $this->validate($item, [
            'cantidad' => 'bail|required|numeric',
            'precio' => 'required|numeric',
            'tela' => 'required|string|min:5|max:20',
            'adquisicion_id' => 'required|integer|min:1',
            'tela_id' => 'required|integer|min:1'
        ]);
    }

    public function filtrar($item)
    {
        return [
            'cantidad' => $item->input('cantidad'),
            'precio' => $item->input('precio'),
            'tela' => $item->input('tela'),
            'adquisicion_id' => $item->input('adquisicion_id'),
            'tela_id' => $item->input('tela_id')
        ];
    }
}
