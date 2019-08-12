<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function() use($router) 
{
    $router->get('/usuarios/filas/{fila}', ['uses' => 'UsuarioController@inicio']);
    $router->get('/usuarios/{id}', ['uses' => 'UsuarioController@mostrar']);
    $router->post('/usuarios', ['uses' => 'UsuarioController@guardar']);
    $router->post('/usuarios/buscar', ['uses' => 'UsuarioController@buscar']);
    $router->put('/usuarios/{id}', ['uses' => 'UsuarioController@editar']);
    $router->delete('/usuarios/{id}', ['uses' => 'UsuarioController@borrar']);

    $router->get('/empleados/filas/{fila}', ['uses' => 'EmpleadoController@inicio']);
    $router->get('/empleados/listar', ['uses' => 'EmpleadoController@listar']);
    $router->get('/empleados/contar', ['uses' => 'EmpleadoController@contar']);
    $router->get('/empleados/usuarios', ['uses' => 'EmpleadoController@esUsuario']);
    $router->get('/empleados/{id}', ['uses' => 'EmpleadoController@mostrar']);
    $router->post('/empleados/buscar', ['uses' => 'EmpleadoController@buscar']);
    $router->post('/empleados', ['uses' => 'EmpleadoController@guardar']);
    $router->put('/empleados/{id}', ['uses' => 'EmpleadoController@editar']);
    $router->delete('/empleados/{id}', ['uses' => 'EmpleadoController@borrar']);

    $router->get('/modelos/filas/{fila}', ['uses' => 'ModeloController@inicio']);
    $router->get('/modelos/listar', ['uses' => 'ModeloController@listar']);
    $router->get('/modelos/{id}', ['uses' => 'ModeloController@mostrar']);
    $router->post('/modelos/buscar', ['uses' => 'ModeloController@buscar']);
    $router->post('/modelos', ['uses' => 'ModeloController@guardar']);
    $router->put('/modelos/{id}', ['uses' => 'ModeloController@editar']);
    $router->delete('/modelos/{id}', ['uses' => 'ModeloController@borrar']);

    $router->get('/operaciones/filas/{fila}', ['uses' => 'OperacionController@inicio']);
    $router->get('/operaciones/listar', ['uses' => 'OperacionController@listar']);
    $router->get('/operaciones/{id}', ['uses' => 'OperacionController@mostrar']);
    $router->post('/operaciones/buscar/operacion', ['uses' => 'OperacionController@buscarPorOperacion']);
    $router->post('/operaciones/buscar/modelo', ['uses' => 'OperacionController@buscarPorModelo']);
    $router->post('/operaciones', ['uses' => 'OperacionController@guardar']);
    $router->put('/operaciones/{id}', ['uses' => 'OperacionController@editar']);
    $router->delete('/operaciones/{id}', ['uses' => 'OperacionController@borrar']);

    $router->get('/lotes/filas/{fila}', ['uses' => 'ModeloLoteController@inicio']);
    $router->get('/lotes/{id}', ['uses' => 'Modelontrol-itemsler@mostrar']);
    $router->post('/lotes/buscar', ['uses' => 'ModeloLoteController@buscar']);
    $router->post('/lotes', ['uses' => 'ModeloLoteController@guardar']);
    $router->put('/lotes/{id}', ['uses' => 'ModeloLoteController@editar']);
    $router->delete('/lotes/{id}', ['uses' => 'ModeloLoteController@borrar']);

    $router->get('/nominas/filas/{fila}', ['uses' => 'NominaController@inicio']);
    $router->get('/nominas/{id}', ['uses' => 'NominaController@mostrar']);
    $router->post('/nominas/buscar', ['uses' => 'NominaController@buscar']);
    $router->post('/nominas', ['uses' => 'NominaController@guardar']);
    $router->put('/nominas/{id}', ['uses' => 'NominaController@editar']);
    $router->delete('/nominas/{id}', ['uses' => 'NominaController@borrar']);

    $router->get('/nomina-items/filas/{fila}', ['uses' => 'NominaItemController@inicio']);
    $router->get('/nomina-items/{id}', ['uses' => 'NominaItemController@mostrar']);
    $router->post('/nomina-items', ['uses' => 'NominaItemController@guardar']);
    $router->put('/nomina-items/{id}', ['uses' => 'NominaItemController@editar']);
    $router->delete('/nomina-items/{id}', ['uses' => 'NominaItemController@borrar']);

    $router->get('/defectos/filas/{fila}', ['uses' => 'DefectoController@inicio']);
    $router->get('/defectos/{id}', ['uses' => 'DefectoController@mostrar']);
    $router->post('/defectos/buscar/modelo', ['uses' => 'DefectoController@buscarPorModelo']);
    $router->post('/defectos/buscar/empleado', ['uses' => 'DefectoController@buscarPorEmpleado']);
    $router->post('/defectos', ['uses' => 'DefectoController@guardar']);
    $router->put('/defectos/{id}', ['uses' => 'DefectoController@editar']);
    $router->delete('/defectos/{id}', ['uses' => 'DefectoController@borrar']);

    $router->get('/telas/filas/{fila}', ['uses' => 'TelaController@inicio']);
    $router->get('/telas/listar', ['uses' => 'TelaController@listar']);
    $router->get('/telas/{id}', ['uses' => 'TelaController@mostrar']);
    $router->post('/telas/buscar', ['uses' => 'TelaController@buscar']);
    $router->post('/telas', ['uses' => 'TelaController@guardar']);
    $router->put('/telas/{id}', ['uses' => 'TelaController@editar']);
    $router->delete('/telas/{id}', ['uses' => 'TelaController@borrar']);

    $router->get('/proveedores/filas/{fila}', ['uses' => 'ProveedorController@inicio']);
    $router->get('/proveedores/listar', ['uses' => 'ProveedorController@listar']);
    $router->get('/proveedores/{id}', ['uses' => 'ProveedorController@mostrar']);
    $router->post('/proveedores/buscar', ['uses' => 'ProveedorController@buscar']);
    $router->post('/proveedores', ['uses' => 'ProveedorController@guardar']);
    $router->put('/proveedores/{id}', ['uses' => 'ProveedorController@editar']);
    $router->delete('/proveedores/{id}', ['uses' => 'ProveedorController@borrar']);

    $router->get('/adquisiciones/filas/{fila}', ['uses' => 'AdquisicionController@inicio']);
    $router->get('/adquisiciones/{id}', ['uses' => 'AdquisicionController@mostrar']);
    $router->post('/adquisiciones/buscar', ['uses' => 'AdquisicionController@buscar']);
    $router->post('/adquisiciones', ['uses' => 'AdquisicionController@guardar']);
    $router->put('/adquisiciones/{id}', ['uses' => 'AdquisicionController@editar']);
    $router->delete('/adquisiciones/{id}', ['uses' => 'AdquisicionController@borrar']);

    $router->get('/adquisicion-items', ['uses' => 'AdquisicionItemController@inicio']);
    $router->get('/adquisicion-items/{id}', ['uses' => 'AdquisicionItemController@mostrar']);
    $router->post('/adquisicion-items', ['uses' => 'AdquisicionItemController@guardar']);
    $router->put('/adquisicion-items/{id}', ['uses' => 'AdquisicionItemController@editar']);
    $router->delete('/adquisicion-items/{id}', ['uses' => 'AdquisicionItemController@borrar']);

    $router->get('/clientes/filas/{fila}', ['uses' => 'ClienteController@inicio']);
    $router->get('/clientes/listar', ['uses' => 'ClienteController@listar']);
    $router->get('/clientes/{id}', ['uses' => 'ClienteController@mostrar']);
    $router->post('/clientes/buscar', ['uses' => 'ClienteController@buscar']);
    $router->post('/clientes', ['uses' => 'ClienteController@guardar']);
    $router->put('/clientes/{id}', ['uses' => 'ClienteController@editar']);
    $router->delete('/clientes/{id}', ['uses' => 'ClienteController@borrar']);

    $router->get('/ventas/filas/{fila}', ['uses' => 'VentaController@inicio']);
    $router->get('/ventas/{id}', ['uses' => 'VentaController@mostrar']);
    $router->post('/ventas/buscar', ['uses' => 'VentaController@buscar']);
    $router->post('/ventas', ['uses' => 'VentaController@guardar']);
    $router->put('/ventas/{id}', ['uses' => 'VentaController@editar']);
    $router->delete('/ventas/{id}', ['uses' => 'VentaController@borrar']);

    $router->get('/venta-items/filas/{fila}', ['uses' => 'VentaItemController@inicio']);
    $router->get('/venta-items/{id}', ['uses' => 'VentaItemController@mostrar']);
    $router->post('/venta-items', ['uses' => 'VentaItemController@guardar']);
    $router->put('/venta-items/{id}', ['uses' => 'VentaItemController@editar']);
    $router->delete('/venta-items/{id}', ['uses' => 'VentaItemController@borrar']);

    $router->get('/secciones/listar', ['uses' => 'SeccionController@listar']);
    $router->post('/secciones/buscar', ['uses' => 'SeccionController@buscar']);
    $router->post('/secciones', ['uses' => 'SeccionController@guardar']);
    $router->put('/secciones/{id}', ['uses' => 'SeccionController@editar']);
    $router->delete('/secciones/{id}', ['uses' => 'SeccionController@borrar']);

    $router->get('/tallas/listar', ['uses' => 'TallaController@listar']);
    $router->post('/tallas/buscar', ['uses' => 'TallaController@buscar']);
    $router->post('/tallas', ['uses' => 'TallaController@guardar']);
    $router->put('/tallas/{id}', ['uses' => 'TallaController@editar']);
    $router->delete('/tallas/{id}', ['uses' => 'TallaController@borrar']);

    $router->get('/tipos/listar', ['uses' => 'TipoController@listar']);
    $router->post('/tipos/buscar', ['uses' => 'TipoController@buscar']);
    $router->post('/tipos', ['uses' => 'TipoController@guardar']);
    $router->put('/tipos/{id}', ['uses' => 'TipoController@editar']);
    $router->delete('/tipos/{id}', ['uses' => 'TipoController@borrar']);

    $router->get('/materiales/listar', ['uses' => 'MaterialController@listar']);
    $router->post('/materiales/buscar', ['uses' => 'MaterialController@buscar']);
    $router->post('/materiales', ['uses' => 'MaterialController@guardar']);
    $router->put('/materiales/{id}', ['uses' => 'MaterialController@editar']);
    $router->delete('/materiales/{id}', ['uses' => 'MaterialController@borrar']);

    $router->get('/maquinas/listar', ['uses' => 'MaquinaController@listar']);
    $router->post('/maquinas/buscar', ['uses' => 'MaquinaController@buscar']);
    $router->post('/maquinas', ['uses' => 'MaquinaController@guardar']);
    $router->put('/maquinas/{id}', ['uses' => 'MaquinaController@editar']);
    $router->delete('/maquinas/{id}', ['uses' => 'MaquinaController@borrar']);
});