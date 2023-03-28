<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\CategoriesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//SACA EN PANTALLA TODAS LAS TAREAS
Route::get('/tareas', [TodosController::class, 'index'])->name('tareas');
//PERMITE CREAR TAREAS NUEVAS VALIDANDO QUE NO ESTÉN NI VACIAS NI CON MENOS DE 3 CARACTERES
Route::post('/tareas', [TodosController::class, 'store'])->name('tareas');
//ENSEÑA UNA TAREA ESPECÍFICA
Route::get('/tareas/{id}', [TodosController::class, 'show'])->name('tareas-show');
//CUANDO SE PULSA ACTUALIZAR TAREA ESTA RUTA ACTUALIZA ESA TAREA EN LA BASE DE DATOS
Route::patch('/tareas/{id}', [TodosController::class, 'update'])->name('tareas-update');
//CUANDO SE PULSA ELIMINAR TAREA SE BORRA LA TAREA DE LA BASE DE DATOS
Route::delete('/tareas/{id}', [TodosController::class, 'destroy'])->name('tareas-destroy');


Route::resource('categories', CategoriesController::class);

Route::get('categories/{category}', [CategoriesController::class, 'show'])->name('categorias-show');
Route::patch('categories/{category}', [CategoriesController::class, 'update'])->name('categorias-update');
Route::delete('categories', [CategoriesController::class, 'destroy'])->name('categorias-destroy');