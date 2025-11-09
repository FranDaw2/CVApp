<?php
//este archivo contiene el modelo Alumno
namespace App\Models;
//importa la clase Model de Eloquent para definir el modelo
use Illuminate\Database\Eloquent\Model;
//importa la clase Storage para manejar el almacenamiento de archivos
use Illuminate\Support\Facades\Storage;

class Alumno extends Model {

// aqui se define el nombre de la tabla asociada al modelo para que Eloquent sepa con que tabla trabajar
    protected $table = 'alumnos';
// Los campos que se rellenan manualmente
//protected fillable indica que estos campos pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'correo',
        'fecha_nacimiento',
        'nota_media',
        'experiencia',
        'formacion',
        'habilidades',
        'fotografia',
    ];

//esta funcion devuelve la url completa de la fotografia del alumno
    function getFoto() {
//usamos url() para generar la url completa de la imagen situada en storage
        $url = url('assets/img/noimage.png');
//si la fotografia no es nula y existe en storage, construimos la url correcta
        if ($this->fotografia != null && Storage::disk('public')->exists($this->fotografia)) {
//la url se construye apuntando a storage y el nombre del archivo
            $url = url('storage/' . $this->fotografia);
        }
//devolvemos la url
        return $url;
    }
}
//utilizamos este modelo en los controladores para interactuar con la tabla alumnos en la base de datos.
//concretamente en MainController para listar los alumnos y en AlumnoController para las operaciones CRUD.