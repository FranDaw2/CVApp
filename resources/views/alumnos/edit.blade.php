@extends('template.base')

@section('title', 'Editar CV | CVApp')

@section('content')
<form action="{{ route('alumnos.update', $alumno->id) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('put')

  <div>
    <label for="nombre">Nombre *</label>
    <input class="form-control" id="nombre" name="nombre" required minlength="5" maxlength="40"
           value="{{ old('nombre', $alumno->nombre) }}">
  </div>

  <div>
    <label for="apellidos">Apellidos *</label>
    <input class="form-control" id="apellidos" name="apellidos" required minlength="5" maxlength="40"
           value="{{ old('apellidos', $alumno->apellidos) }}">
  </div>

  <div>
    <label for="telefono">Teléfono *</label>
    <input class="form-control" id="telefono" name="telefono" required maxlength="10"
           value="{{ old('telefono', $alumno->telefono) }}">
  </div>

  <div>
    <label for="correo">Correo *</label>
    <input class="form-control" id="correo" name="correo" type="email" required maxlength="40"
           value="{{ old('correo', $alumno->correo) }}">
  </div>

  <div>
    <label for="fecha_nacimiento">Fecha de nacimiento *</label>
    <input class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required type="date"
           value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}">
  </div>

  <div>
    <label for="nota_media">Nota media (0–10) *</label>
    <input class="form-control" id="nota_media" name="nota_media" required type="number" step="0.01" min="0" max="10"
           value="{{ old('nota_media', $alumno->nota_media) }}">
  </div>

  <div>
    <label for="experiencia">Experiencia</label>
    <textarea class="form-control" id="experiencia" name="experiencia" rows="4">{{ old('experiencia', $alumno->experiencia) }}</textarea>
  </div>

  <div>
    <label for="formacion">Formación *</label>
    <textarea class="form-control" id="formacion" name="formacion" required rows="4">{{ old('formacion', $alumno->formacion) }}</textarea>
  </div>

  <div>
    <label for="habilidades">Habilidades *</label>
    <textarea class="form-control" id="habilidades" name="habilidades" required rows="3">{{ old('habilidades', $alumno->habilidades) }}</textarea>
  </div>

  <div class="mb-3">
    <label for="fotografia">Reemplazar fotografía (opcional)</label>
    <input class="form-control" id="fotografia" name="fotografia" type="file" accept="image/*">

    @if($alumno->fotografia)
      <div class="mt-2">
        <img src="{{ $alumno->getFoto() }}" width="140" class="rounded" alt="Foto actual">
      </div>

      <div class="form-check form-switch mt-2">
        <label for="deleteimage" class="form-check-label">Borrar fotografía actual</label>
        <input type="checkbox" class="form-check-input" id="deleteimage" name="deleteimage" value="delete">
      </div>
    @endif
  </div>

  <div class="upper-space">
    <input class="btn btn-primary" type="submit" value="Guardar cambios">
  </div>
</form>
@endsection
