@extends('template.base')

@section('content')

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach($alumnos as $alumno)
    <div class="col">
        <div class="card shadow-sm" style="min-height: 500px;">
            <!-- Imagen de cabecera -->
            <svg aria-label="Placeholder: Thumbnail" class="bd-placeholder-img card-img-top"
                height="225" preserveAspectRatio="xMidYMid slice" role="img" width="100%"
                xmlns="http://www.w3.org/2000/svg"
                style="background-image: url('{{ $alumno->getFoto() }}');
                       background-size: cover;
                       background-position: center center;">
                <title>Foto del alumno</title>
                <rect width="100%" height="100%" fill="#55595c11"></rect>
                <text x="5%" y="30%" fill="#eceeef"
                    dy=".3em" style="font-weight: bold; font-size: 1.5rem;">
                    {{ $alumno->nombre }} {{ $alumno->apellidos }}
                </text>
            </svg>

            <!-- Contenido de la tarjeta -->
            <div class="card-body">
                <p class="card-text">
                    {{ $alumno->formacion }}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                        <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    </div>
                    <small class="text-body-secondary">{{ $alumno->correo }}</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
