<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Cliente;

class ClienteController extends Controller
{
    public function inicio($fila)
    {
        $clientes = Cliente::paginate($fila);
        return response()->json($clientes, 200);
    }

    public function listar()
    {
        $clientes = Cliente::all();
        return response()->json($clientes, 200);
    }

    public function mostrar($id)
    {
        $cliente = Cliente::find($id);
        return response()->json($cliente, 200);
    }

    public function buscar($campo, Request $request)
    {
        $busqueda = $request->search;
        $resultado = Cliente::where("$campo", 'LIKE', "%$busqueda%")->paginate(10);
        return response()->json($resultado, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $cliente = Cliente::create($this->filtrar($request));
        return response()->json($cliente, 201);
    }

    public function editar($id, Request $request)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($this->filtrar($request));
        return response()->json($cliente, 201);
    }

    public function borrar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return response()->json([], 200);
    }

    public function validar($cliente)
    {
        return $this->validate($cliente, [
            'nombre' => 'bail|required|string|min:3|max:20',
            'apellido_p' => 'required|string|min:3|max:15',
            'apellido_m' => 'required|string|min:3|max:15',
            'correo' => 'unique:clientes|required|email|min:12|max:30',
            'telefono' => 'unique:clientes|required|alpha_dash|min:10|max:15'
        ]);
    }

    public function filtrar($cliente)
    {
        return [
            'nombre' => $cliente->input('nombre'),
            'apellido_p' => $cliente->input('apellido_p'),
            'apellido_m' => $cliente->input('apellido_m'),
            'correo' => $cliente->input('correo'),
            'telefono' => $cliente->input('telefono')
        ];
    }
}
