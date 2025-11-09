<?php

namespace App\Http\Controllers;
//Este archivo contiene el controlador MainController 
// maneja las solicitudes relacionadas con la página principal
//  y la página "copy" de la aplicación.
use App\Models\Alumno;
use Illuminate\View\View;

class MainController extends Controller{
//declara el método index que devuelve la vista principal
    function index(): View {
//construye una consulta para obtener la lista de alumnos
//ordenados por su ID en orden descendente
//get() ejecuta la consulta y obtiene los resultados  
        $alumnos = Alumno::orderBy('id', 'desc')->get();
//devuelve una vista Blade de views/main/index.blade.php
//se referencia como main.index
//alumnos esta disponible en la vista como variable $alumnos
        return view('main.index', ['alumnos' => $alumnos]);
    }
//En definitiva el controlador recibe la petiticion (laruta),
//habla con el modelo (alumno)
//y devuelve la vista con los datos necesarios.
}
