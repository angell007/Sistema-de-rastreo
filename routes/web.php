<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::view('/pdf', 'prueba');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@welcome')->name('/');

Route::get('/clear-cache', 'HomeController@clear');

//Clientes
Route::resource('/clientes', 'ClienteController', ['except' => 'update']);
Route::patch('/clientes/update', 'ClienteController@update')->name('clientes.update');
Route::get('/clientes/OrdersCliente/{cliente}', 'ClienteController@ordersCliente');

//Seguimientos
Route::resource('/seguimientos', 'SeguimientoController', ['except' => 'update', 'index']);
Route::get('/seguimientos/orders/guia', 'SeguimientoController@index')->name('seguimientos');

//Orders
Route::resource('/orders', 'OrderController', ['except' => 'update']);
Route::patch('/orders/update', 'OrderController@update')->name('orders.update');
Route::get('/orders/filter/{finicio}/{ffin}', 'OrderController@filtro');
Route::get('/orders/enviar/email/{order}', 'OrderController@enviar')->name('orders.enviar');
Route::get('/orders/printOrder/{orders}', 'OrderController@printOrder')->name('orders.printOrder');

//Historias
Route::resource('/historias', 'HistoriaController', ['except' => 'update', 'index']);
Route::get('/orders/historias/{key}', 'HistoriaController@index');
Route::patch('/historias/update', 'HistoriaController@update')->name('historias.update');

//Users
Route::resource('/users', 'UserController', ['except' => 'update']);
Route::get('/user/roles/{key}', 'UserController@show');
Route::patch('/users/update', 'UserController@update')->name('users.update');

//Rols
Route::resource('/rols', 'RoleController', ['except' => 'update']);
Route::patch('/rols/update', 'RoleController@update')->name('rols.update');
Route::post('/rols/asignar-rol', 'RoleController@asignarRole')->name('rols.asignarRole');
Route::get('/user/roles/eliminar-rol/{rolkey}/{userkey}', 'RoleController@eliminarRol');

//Acciones
Route::resource('/acciones', 'AccionController', ['except' => 'update']);
Route::patch('/acciones/update', 'AccionController@update')->name('acciones.update');

//Clausula
Route::resource('/clausulas', 'ClausulaController', ['except' => 'update']);
Route::patch('/clausulas/update', 'ClausulaController@update')->name('clausulas.update');

//Empresa
Route::resource('/empresa', 'EmpresaController');
Route::patch('/empresa/update', 'EmpresaController@update')->name('empresa.update');
