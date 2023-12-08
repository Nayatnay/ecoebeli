<?php

use App\Http\Controllers\BuscarController;
use App\Http\Controllers\CarroController;
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

//Route::get('verproductos', VerProductos::class)->name('verproductos');
Route::get('verproductos/{buscar}', [VerproductosController::class, 'index'])->name('verproductos');
Route::get('buscar', [BuscarController::class, 'index'])->name('buscar');

Route::get('categorias', IndexCategorias::class)->name('categorias');
Route::get('productos', IndexProductos::class)->name('productos');
Route::get('carrito', IndexCarrito::class)->name('carrito');
Route::get('carro', [CarroController::class, 'index'])->name('carro');


Route::get('condiciones', function () {
    return view('condiciones');
})->name('condiciones');

Route::get('politicas', function () {
    return view('politicas');
})->name('politicas');

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard', [EbeliController::class, 'index'])->name('dashboard');
});
