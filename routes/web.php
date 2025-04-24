<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\InicioController;




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

Route::get('/', function () {
    return view('welcome');
});



//Route::get('/dashboard', [AsistenteController::class, 'new'])->middleware(['auth'])->name('dashboard');
//Route::get('/dashboard', function () {  return view('inicio'); })->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', [InicioController::class, 'show'])->middleware(['auth'])->name('dashboard');
Route::get('/contacto', [InicioController::class, 'contacto'])->name('contacto');



Route::middleware('auth')->group(function () {

   // Route::get('/inicio', function () {  return view('inicio'); });
    
    Route::get('asistente/new', [AsistenteController::class, 'new'])->name('asistente.new');
    Route::post('asistente/store', [AsistenteController::class, 'store'])->name('asistente.store');
    Route::get('asistente/mostrar', [AsistenteController::class, 'show'])->name('asistente.show');
    Route::get('asistente/editar/{id}', [AsistenteController::class, 'editar'])->name('asistente.editar');
    Route::patch('asistente/actualizar/{id}', [AsistenteController::class, 'update'])->name('asistente.actualizar');
    Route::delete('asistente/eliminar/{id}', [AsistenteController::class, 'destroy'])->name('asistente.eliminar');

    Route::get('reunion/new', [ReunionController::class, 'new'])->name('reunion.new');
    Route::post('reunion/store', [ReunionController::class, 'store'])->name('reunion.store');
    Route::get('reunion/bitacora/{id}', [ReunionController::class, 'bitacora'])->name('reunion.bitacora');
    Route::get('reunion/mostrar', [ReunionController::class, 'show'])->name('reunion.show');
    Route::get('reunion/editar/{id}', [ReunionController::class, 'editar'])->name('reunion.editar');
    Route::patch('reunion/actualizar/{id}', [ReunionController::class, 'update'])->name('reunion.actualizar');
    Route::delete('reunion/eliminar/{id}', [ReunionController::class, 'destroy'])->name('reunion.eliminar');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
