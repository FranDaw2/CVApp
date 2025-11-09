<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Título por-vista (sección "title") --}}
    <title>@yield('title', 'CV App')</title>

    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/css/styles.css?r=' . rand(1, 10000)) }}">
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        {{-- Texto de marca en navbar (sección "navbar") --}}
        <a class="navbar-brand" href="{{ route('main.index') }}">@yield('navbar', 'CV App')</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('main.index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('alumnos.create') }}">Nuevo alumno</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Currículums
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('alumnos.create') }}">Crear</a></li>
                <li><a class="dropdown-item" href="{{ route('alumnos.index') }}">Listado</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Otra opción</a></li>
              </ul>
            </li>
          </ul>

          {{-- Buscador --}}
          <form class="d-flex" role="search" method="get" action="{{ route('alumnos.search') }}">
            <input class="form-control me-2" type="search" name="q" placeholder="Buscar alumno..." value="{{ request('q') }}">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
          </form>
        </div>
      </div>
    </nav>

    <div class="container my-5">
      {{-- Mensaje de error general (flash) --}}
      @error('general')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      {{-- Mensaje de éxito general (flash) --}}
      @if(session('general'))
        <div class="alert alert-success">{{ session('general') }}</div>
      @endif

      {{-- Contenido específico de cada vista --}}
      @yield('content')
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"></script>

    {{-- Scripts extra por-vista --}}
    @yield('scripts')

    {{-- JS principal (con bust de caché) --}}
    <script src="{{ url('assets/js/main.js?r=' . rand(1, 10000)) }}"></script>

    {{-- =================== FORMULARIO GLOBAL + MODAL DE BORRADO =================== --}}
    <form id="form-delete" method="POST">
      @csrf
      @method('DELETE')
    </form>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmar eliminación</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            ¿Seguro que quieres borrar <strong id="modal-news-title"></strong>?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button form="form-delete" type="submit" class="btn btn-danger">Borrar definitivamente</button>
          </div>
        </div>
      </div>
    </div>
    {{-- =========================================================================== --}}
  </body>
</html>
