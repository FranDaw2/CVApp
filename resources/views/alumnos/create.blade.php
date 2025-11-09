@extends('template.base')

@section('title', 'Nuevo CV | CVApp')

@section('content')

<form action="{{ route('alumnos.store') }}" method="post" enctype="multipart/form-data">
  @csrf

  <div>
    <label for="nombre">Nombre *</label>
    <input class="form-control" id="nombre" name="nombre" required minlength="5" maxlength="40" value="{{ old('nombre') }}">
  </div>

  <div>
    <label for="apellidos">Apellidos *</label>
    <input class="form-control" id="apellidos" name="apellidos" required minlength="5" maxlength="40" value="{{ old('apellidos') }}">
  </div>

  <div>
    <label for="telefono">Teléfono *</label>
    <input class="form-control" id="telefono" name="telefono" required maxlength="10" value="{{ old('telefono') }}">
  </div>

  <div>
    <label for="correo">Correo *</label>
    <input class="form-control" id="correo" name="correo" type="email" required maxlength="40" value="{{ old('correo') }}">
  </div>

  <div>
    <label for="fecha_nacimiento">Fecha de nacimiento *</label>
    <input class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required type="date" value="{{ old('fecha_nacimiento') }}">
  </div>

  <div>
    <label for="nota_media">Nota media (0–10) *</label>
    <input class="form-control" id="nota_media" name="nota_media" required type="number" step="0.01" min="0" max="10" value="{{ old('nota_media') }}">
  </div>

  <div>
    <label for="experiencia">Experiencia</label>
    <textarea class="form-control" id="experiencia" name="experiencia" rows="4">{{ old('experiencia') }}</textarea>
  </div>

  <div>
    <label for="formacion">Formación *</label>
    <textarea class="form-control" id="formacion" name="formacion" required rows="4">{{ old('formacion') }}</textarea>
  </div>

  <div>
    <label for="habilidades">Habilidades *</label>
    <textarea class="form-control" id="habilidades" name="habilidades" required rows="3">{{ old('habilidades') }}</textarea>
  </div>

  <div>
    <label for="fotografia">Fotografía (opcional)</label>
    <input class="form-control" id="fotografia" name="fotografia" type="file" accept="image/*">
  </div>

  <div class="upper-space">
    <input class="btn btn-primary" type="submit" value="Crear CV">
  </div>
</form>
@endsection
