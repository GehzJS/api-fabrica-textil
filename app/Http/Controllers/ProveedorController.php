<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function inicio($fila)
    {
        $proveedores = Proveedor::paginate($fila);
        return response()->json($proveedores, 200);
    }

    public function listar()
    {
        $proveedores = Proveedor::all();
        return response()->json($proveedores, 200);
    }
    
    public function mostrar($id)
    {
        $proveedor = Proveedor::find($id);
        return response()->json($proveedor, 200);
    }

    public function buscar($campo, Request $request)
    {
        $busqueda = $request->search;
        $resultado = Proveedor::where("$campo", 'LIKE', "%$busqueda%")->paginate(10);
        return response()->json($resultado, 200);
    }

    public function guardar(Request $request)
    {
        $this->validar($request);
        $proveedor = Proveedor::create($this->filtrar($request));
        return response()->json($proveedor, 201);
    }

    public function editar($id, Request $request)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($this->filtrar($request));
        return response()->json($proveedor, 201);
    }

    public function borrar($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return response()->json([], 200);
    }

    public function validar($proveedor)
    {
        return $this->validate($proveedor, [
            'nombre' => 'bail|required|string|min:3|max:20',
            'apellido_p' => 'required|string|min:3|max:15',
            'apellido_m' => 'required|string|min:3|max:15',
            'correo' => 'unique:clientes|required|email|min:12|max:30',
            'telefono' => 'unique:clientes|required|alpha_dash|min:10|max:15'
        ]);
    }

    public function filtrar($proveedor)
    {
        return [
            'nombre' => $proveedor->input('nombre'),
            'apellido_p' => $proveedor->input('apellido_p'),
            'apellido_m' => $proveedor->input('apellido_m'),
            'correo' => $proveedor->input('correo'),
            'telefono' => $proveedor->input('telefono')
        ];
    }
}
