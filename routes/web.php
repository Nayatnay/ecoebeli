<?php

use App\Http\Controllers\BuscarController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalproductosController;
use App\Http\Controllers\EbeliController;
use App\Http\Controllers\VerproductosController;
use App\Livewire\Carrito\IndexCarrito;
use App\Livewire\Carrito\IndexCarro as CarritoIndexCarro;
use App\Livewire\Categorias\IndexCategorias;
use App\Livewire\IndexCarro;
use App\Livewire\Productos\IndexProductos;
use App\Livewire\Productos\VerProductos;
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
Route::get('/', [EbeliController::class, 'index'])->name('/');

Route::get('verproductos/{buscar}', [VerproductosController::class, 'index'])->name('verproductos');
Route::get('detalproducto/{producto}', [DetalproductosController::class, 'index'])->name('detalproducto');
Route::get('buscar', [BuscarController::class, 'index'])->name('buscar');

Route::get('admincat', function () {
    return view('admincat');
})->name('admincat');

Route::get('adminpro', function () {
    return view('adminpro');
})->name('adminpro');

Route::get('admincom', function () {
    return view('admincom');
})->name('admincom');

Route::get('categorias', IndexCategorias::class)->name('categorias');
Route::get('productos', IndexProductos::class)->name('productos');
Route::get('carro', [CarroController::class, 'index'])->name('carro');

Route::get('condiciones', function () {
    return view('condiciones');
})->name('condiciones');

Route::get('politicas', function () {
    return view('politicas');
})->name('politicas');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard', [EbeliController::class, 'index'])->name('dashboard');
});

//Rutas carrito

Route::post('cart/add', [CartController::class, 'add'])->name('add');
Route::post('adicion', [CarroController::class, 'adicion'])->name('adicion');
Route::get('cart/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('cart/clear', [CartController::class, 'clear'])->name('clear');
Route::post('cart/removeitem', [CarroController::class, 'removeItem'])->name('removeitem');
Route::post('cart/updateqty', [CarroController::class, 'updateqty'])->name('updateqty');

//Rutas Compras
Route::get('compra', [CompraController::class, 'index'])->name('compra');
Route::get('verificalog', [CarroController::class, 'verificalog'])->name('verificalog');
Route::get('adicompra/{producto}', [CarroController::class, 'adicompra'])->name('adicompra');
Route::get('editmedio/{medio}', [CompraController::class, 'editmedio'])->name('editmedio');

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
*/