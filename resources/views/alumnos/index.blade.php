@extends('template.base')

@section('title', 'Alumnos | CVApp')

@section('content')
  <h1 class="mb-4">Alumnos</h1>

  <div class="mb-3">
    <a href="{{ route('alumnos.create') }}" class="btn btn-primary">Nuevo alumno</a>
  </div>

  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Alumno</th>
        <th>Correo</th>
        <th class="text-center">Acción</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($alumnos as $alumno)
        <tr>
          <td>{{ $alumno->id }}</td>
          <td>
            <img src="{{ $alumno->getFoto() }}" width="64" class="rounded me-2" alt="Foto de {{ $alumno->nombre }}">
            {{ $alumno->nombre }} {{ $alumno->apellidos }}
          </td>
          <td>{{ $alumno->correo }}</td>
          <td class="text-center">
            <a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-sm btn-success">view</a>
            <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-sm btn-warning">edit</a>
            <button
              type="button"
              class="btn btn-sm btn-danger"
              data-bs-toggle="modal"
              data-bs-target="#deleteModal"
              data-title="{{ $alumno->nombre }} {{ $alumno->apellidos }}"
              data-href="{{ route('alumnos.destroy', $alumno->id) }}">
              delete
            </button>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4">No hay alumnos registrados.</td>
        </tr>
      @endforelse
    </tbody>
    <tfoot>
      <tr>
        <th colspan="3">Número de alumnos:</th>
        <th>{{ count($alumnos) }}</th>
      </tr>
    </tfoot>
  </table>
@endsection
