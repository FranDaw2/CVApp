<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
// esta es la clase para devolver archivos como respuesta
class ImageController extends Controller
{
//esta funcion view recibe el id del alumno y devuelve la imagen almacenada en storage
    public function view($id)
    {
//tenemos la variable alumno que busca el alumno por id
        $alumno = Alumno::find($id);
// Si no existe el alumno o no tiene foto, devuelve imagen por defecto que tenemos en public/assets/img/cv-placeholder.jpg
        if (
            $alumno == null ||
            $alumno->fotografia == null ||
            !file_exists(storage_path('app/public') . '/' . $alumno->fotografia)
        ) {
            return response()->file(base_path('public/assets/img/cv-placeholder.jpg'));
        }
// Devuelve la imagen real desde storage y alumno->fotografia contiene el nombre del archivo
        return response()->file(storage_path('app/public') . '/' . $alumno->fotografia);
    }
}
