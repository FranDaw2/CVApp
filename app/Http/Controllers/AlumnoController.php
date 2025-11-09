<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AlumnoController extends Controller{
    public function index(): View
    {
        $alumnos = Alumno::all();
        return view('alumnos.index', ['alumnos' => $alumnos]);
    }
    public function create(): View
    {
        return view('alumnos.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre'           => 'required|string|min:5|max:40',
            'apellidos'        => 'required|string|min:5|max:40',
            'telefono'         => 'required|string|max:10|unique:alumnos,telefono',
            'correo'           => 'required|email|max:40|unique:alumnos,correo',
            'fecha_nacimiento' => 'required|date',
            'nota_media'       => 'required|numeric|min:0|max:10',
            'experiencia'      => 'nullable|string',
            'formacion'        => 'required|string',
            'habilidades'      => 'required|string',
            'fotografia'       => 'nullable|image|max:400',
        ]);

        $result = false;
        $alumno = new Alumno($request->except('fotografia'));

        try {
            $result = $alumno->save();
            $path = $this->upload($request, $alumno->id);
            $alumno->fotografia = $path;
            $result = $alumno->save();
            $message = 'El cv se ha guardado correctamente.';
        } catch (UniqueConstraintViolationException $e) {
            $message = 'El mismo email no puede guardarse dos veces';
        } catch (QueryException $e) {
            $message = 'Alguna de las entradas es nula.';
        } catch (\Exception $e) {
            $message = 'Se ha producido un error, en caso de que persista, consulte al administrador.';
        }
        $messageArray = ['general' => $message];
        return $result
            ? redirect()->route('main.index')->with($messageArray)
            : back()->withInput()->withErrors($messageArray);
    }

    private function upload(Request $request, $id)
    {
        $pathPublic = null;
        if ($request->hasFile('fotografia') && $request->file('fotografia')->isValid()) {
            $image = $request->file('fotografia');
            $fileName = $id . '.' . $image->getClientOriginalExtension();
            $pathPublic = $image->storeAs('alumnos', $fileName, 'public');
            $image->storeAs('alumnos', $fileName, 'local');
        }
        return $pathPublic;
    }
    public function show(Alumno $alumno): View
    {
        $year = Carbon::now()->year;
        return view('alumnos.show', ['alumno' => $alumno, 'year' => $year]);
    }
    public function edit(Alumno $alumno): View
    {
        return view('alumnos.edit', ['alumno' => $alumno]);
    }
    public function update(Request $request, Alumno $alumno): RedirectResponse
    {
        $request->validate([
            'nombre'           => 'required|string|min:5|max:40',
            'apellidos'        => 'required|string|min:5|max:40',
            'telefono'         => 'required|string|max:10|unique:alumnos,telefono,' . $alumno->id,
            'correo'           => 'required|email|max:40|unique:alumnos,correo,' . $alumno->id,
            'fecha_nacimiento' => 'required|date',
            'nota_media'       => 'required|numeric|min:0|max:10',
            'experiencia'      => 'nullable|string',
            'formacion'        => 'required|string',
            'habilidades'      => 'required|string',
            'fotografia'       => 'nullable|image|max:400',
            'deleteimage'      => 'nullable|string'
        ]);

        $result = false;

        if ($request->deleteimage === 'delete') {
            $this->destroyImage($alumno->fotografia);
            $alumno->fotografia = null;
        }

        try {
            $path = $this->upload($request, $alumno->id);
            if ($path !== null) {
                $alumno->fotografia = $path;
            }
            $result = $alumno->update($request->except(['fotografia', 'deleteimage']));
            $message = 'El cv ha sido editado.';
        } catch (UniqueConstraintViolationException $e) {
            $message = 'No se puede subir el mismo email dos veces.';
        } catch (QueryException $e) {
            $message = 'Alguna de las entradas es nula.';
        } catch (\Exception $e) {
            $message = 'Se ha producido un error.';
        }

        $messageArray = ['general' => $message];
        return $result
            ? redirect()->route('alumnos.edit', $alumno->id)->with($messageArray)
            : back()->withInput()->withErrors($messageArray);
    }
    private function destroyImage(?string $relativePath): void
    {
        if ($relativePath) {
            Storage::disk('public')->delete($relativePath);
            Storage::disk('local')->delete($relativePath);
        }
    }
    public function destroy(Alumno $alumno): RedirectResponse
    {
        try {
            $result = $alumno->delete();
            $message = 'El cv ha sido eliminado.';
        } catch (\Exception $e) {
            $result = false;
            $message = 'El cv no ha sido eliminado.';
        }

        $messageArray = ['general' => $message];
        return $result
        // rdirect hace una redirección a la ruta nombrada 'alumnos.index' with es para pasar mensajes de sesión
            ? redirect()->route('alumnos.index')->with($messageArray)
        // bck() vuelve a la página anterior con los datos de entrada y los errores
            : back()->withInput()->withErrors($messageArray);
    }
    public function search(Request $request): View
    {
        $query = trim($request->input('q'));
        $alumnos = $query === ''
            ? Alumno::orderBy('id', 'desc')->get()
            : Alumno::where('nombre', 'like', "%$query%")
                ->orWhere('apellidos', 'like', "%$query%")
                ->orWhere('correo', 'like', "%$query%")
                ->orderBy('id', 'desc')
                ->get();

        return view('alumnos.index', compact('alumnos'));
    }
}
