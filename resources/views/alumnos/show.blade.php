@extends('template.base')

@section('title', 'Detalle CV | CVApp')

@section('scripts')
{{-- (Opcional) iconos fontawesome del profe --}}
{{-- <script src="https://kit.fontawesome.com/ec3e7e2cc5.js" crossorigin="anonymous"></script> --}}
@endsection

@section('content')
<header class="masthead" style="background-image: url('{{ route('image.view', $alumno->id) }}')">
  <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="post-heading">
          <h1>{{ $alumno->nombre }} {{ $alumno->apellidos }}</h1>
          <h2 class="subheading">{{ $alumno->formacion ?: 'Formación no especificada' }}</h2>
          <span class="meta">
            Contacto:
            <a href="mailto:{{ $alumno->correo }}">{{ $alumno->correo }}</a>
            @if($alumno->telefono) · Tel: {{ $alumno->telefono }} @endif
            @if($alumno->nota_media !== null) · Nota media: {{ $alumno->nota_media }} @endif
            @if($alumno->created_at) · Creado el {{ $alumno->created_at->format('F d, Y') }} @endif
            @if($alumno->updated_at && $alumno->updated_at != $alumno->created_at)
              , actualizado el {{ $alumno->updated_at->format('F d, Y') }}
            @endif
          </span>
        </div>
      </div>
    </div>
  </div>
</header>

<article class="mb-4">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <h3 class="section-heading">Experiencia</h3>
        <p>{{ $alumno->experiencia ?: 'No especificada' }}</p>

        <h3 class="section-heading">Habilidades</h3>
        <p>{{ $alumno->habilidades ?: 'No especificadas' }}</p>

        <hr class="my-4">

        <div class="d-flex gap-2">
          <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Volver al listado</a>
          <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-primary">Editar</a>
        </div>
      </div>
    </div>
  </div>
</article>

<footer class="border-top">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="small text-center text-muted fst-italic">
          Copyright &copy; CV App {{ $year ?? now()->year }}
        </div>
      </div>
    </div>
  </div>
</footer>
@endsection
