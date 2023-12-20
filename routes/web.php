<?php

use App\Http\Controllers\PagoFacilController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Compra\ListCompra;
use App\Http\Livewire\Compra\ShowCompra;
use App\Http\Livewire\Compra\NewCompra;
use App\Http\Livewire\CompraDetalle\NewCompraDetalle;
use App\Http\Livewire\Producto\ListProducto;
use App\Http\Livewire\Producto\NewProducto;
use App\Http\Livewire\Producto\EditProducto;
use App\Http\Livewire\Producto\Producto;
use App\Http\Livewire\Pedido\Pedidos\ListPedido;
use App\Http\Livewire\Pedido\Pedidos\NewPedido;
use App\Http\Livewire\Pedido\Pedidos\ShowPedido;
use App\Http\Livewire\Public\AcercaDe;
use App\Http\Livewire\Public\Auth\Profile;
use App\Http\Livewire\Public\Contacto;
use App\Http\Livewire\Public\Inicio;
use App\Http\Livewire\Public\Pedido\ConfirmPedido;
use App\Http\Livewire\Public\Pedido\ListPedido as PedidoListPedido;
use App\Http\Livewire\Public\Pedido\ShowCarrito;
use App\Http\Livewire\Public\Pedido\ShowPedido as PedidoShowPedido;
use App\Http\Livewire\Public\Producto\ListProduct;
use App\Http\Livewire\Public\Producto\ShowProduct;
use App\Http\Livewire\Sistema\Rol\EditRol;
use App\Http\Livewire\Sistema\Rol\ListRol;
use App\Http\Livewire\Sistema\Rol\NewRol;
use App\Http\Livewire\Sistema\Usuario\EditUsuario;
use App\Http\Livewire\Sistema\Usuario\ListUsuario;
use App\Http\Livewire\Sistema\Usuario\NewUsuario;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Inicio::class);
Route::get('/inicio', Inicio::class)->name('inicio');
Route::get('/inicio/producto', ListProduct::class)->name('public.producto.list');
Route::get('/inicio/producto/{id}', ShowProduct::class)->name('public.producto.show');
Route::get('/inicio/carrito', ShowCarrito::class)->name('public.carrito');
Route::get('/inicio/pedido/confirm', ConfirmPedido::class)->name('public.confirm_pedido');
Route::get('/inicio/acerca-de', AcercaDe::class)->name('public.acerca_de');
Route::get('/inicio/contacto', Contacto::class)->name('public.contacto');
Route::get('/inicio/perfil', Profile::class)->name('public.perfil');
Route::get('/inicio/pedidos', PedidoListPedido::class)->name('public.pedido');
Route::get('/inicio/pedidos/{id}', PedidoShowPedido::class)->name('public.pedido.show');

Route::group(['prefix' => 'pago_facil'], function () {
    Route::get('/qr/{pedido}', [PagoFacilController::class, 'GenerarQR'])->name('pago_facil.pagar.qr');
    Route::get('/pagar/{usuario}/{pedido}/{nit}', [PagoFacilController::class, 'RecolectarDatos'])->name('pago_facil.pagar');
    Route::post('/estado/{pedido}', [PagoFacilController::class, 'ConsultarEstado'])->name('pago_facil.estado');
    Route::get('/callback/{pedido}', [PagoFacilController::class, 'urlCallback'])->name('pago_facil.callback');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // MODULO SISTEMA
    Route::group(['prefix' => 'usuario', 'middleware' => ['can:usuarios', 'auth']], function () {
        Route::get('/list', ListUsuario::class)->name('usuario.list');
        Route::get('/new', NewUsuario::class)->name('usuario.new');
        Route::get('/edit/{usuario}', EditUsuario::class)->name('usuario.edit');
    });

    Route::group(['prefix' => 'rol', 'middleware' => ['can:roles', 'auth']], function () {
        Route::get('/list', ListRol::class)->name('rol.list');
        Route::get('/new', NewRol::class)->name('rol.new');
        Route::get('/edit/{rol}', EditRol::class)->name('rol.edit');
    });

    // MODULO PEDIDO
    Route::group(['prefix' => 'pedido', 'middleware' => [/* 'can:roles', */'auth']], function () {
        Route::get('/list', ListPedido::class)->name('pedido.list');
        Route::get('/new', NewPedido::class)->name('pedido.new');
        Route::get('/show/{pedido}', ShowPedido::class)->name('pedido.show');
    });

    // MODULO PRODUCTO
    Route::group(['prefix' => 'producto', 'middleware' => [/* 'can:roles', */'auth']], function () {
        Route::get('/list', ListProducto::class)->name('producto.list');
        Route::get('/new', NewProducto::class)->name('producto.new');
        Route::get('/edit/{producto}', EditProducto::class)->name('producto.edit');
    });

    // MODULO COMPRA
    Route::group(['prefix' => 'compra', 'middleware' => [/* 'can:roles', */'auth']], function () {
        Route::get('/list', ListCompra::class)->name('compra.list');
        Route::get('/new', NewCompra::class)->name('compra.new');
        Route::get('/show/{id}', ShowCompra::class)->name('compra.show');
        Route::get('/detalle/{id}', NewCompraDetalle::class)->name('compra-detalle.new');
    });
});
