<?php
// Web Routes es el mapa de la aplicación donde se definen las rutas y sus controladores asociados.
// Este archivo esta relacionado con los controladores MainController, ImageController y AlumnoController.
// Al estar relacionado tenemos que añadir use para cada uno de ellos.
// Además, se utiliza el facade Route para definir las rutas por defecto de Laravel.
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AlumnoController;
// Portada establecida como la ruta raíz y asociada al método index del MainController y nombrada como main.index.
Route::get('/', [MainController::class, 'index'])->name('main.index');
// Página "copy" establecida y asociada al método copy del MainController y nombrada como main.copy.
Route::get('copy', [MainController::class, 'copy'])->name('main.copy');
// Ver imagen por id establecida y asociada al método view del ImageController y nombrada como image.view.  
Route::get('image/{id}', [ImageController::class, 'view'])->name('image.view');
// Búsqueda de alumnos establecida y asociada al método search del AlumnoController y nombrada como alumnos.search.
Route::get('/alumnos/search', [AlumnoController::class, 'search'])->name('alumnos.search');
// CRUD principal establecido y asociado al AlumnoController.
Route::resource('alumnos', AlumnoController::class);
//En definitiva, este archivo configura las rutas web de la aplicación, 
//vinculando URLs específicas a métodos de controlador para manejar las solicitudes HTTP.

