@extends('layouts/app')
@section('titulo', 'Registro Curso')
@section('content')
    @if (Auth::user()->tipo == 1)
        @if (session('correcto'))
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'CORRECTO',
                        type: 'success',
                        text: "{{ session('correcto') }}",
                        styling: 'bootstrap3'
                    });
                })

            </script>
        @endif
        @if (session('incorrecto'))
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ERROR',
                        type: 'warning',
                        text: "{{ session('incorrecto') }}",
                        styling: 'bootstrap3'
                    });
                })

            </script>
        @endif

        @if (session('duplicado'))
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ERROR',
                        type: 'warning',
                        text: "{{ session('duplicado') }}",
                        styling: 'bootstrap3'
                    });
                })

            </script>
        @endif

        <div class="modal-body" id="modal-create">
            <h3 class="text-center" style="margin-bottom: 55px">REGISTRO PARA ASINAR CURSO AL DOCENTE</h3>
            <form action="{{ route('cursos.store') }}" method="POST">
                @csrf
                <div class="form-row col-12">
                    @error('nombre')
                        <small>*{{ $message }}</small>
                    @enderror
                    <select name="nombre" id="nombre">
                        <option value="">Nombre del Curso...</option>
                        @foreach ($sql3 as $it)
                            <option value="{{ $it->nombre }}">{{ $it->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row col-12">
                    @error('docente')
                        <small>*{{ $message }}</small>
                    @enderror
                    <select name="docente" id="docente">
                        <option value="">Docente...</option>
                        @foreach ($sql as $item)
                            <option value="{{ $item->id }}">{{ $item->name . ' ' . $item->apellido }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row col-12">
                    @error('grado')
                        <small>*{{ $message }}</small>
                    @enderror
                    <select name="grado" id="grado">
                        <option value="">Grado...</option>
                        @foreach ($sql2 as $i)
                            <option value="{{ $i->id_grado }}">{{ $i->grado . ' ' . $i->seccion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('cursos.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                    <button type="submit" id="boton" class="btn btn-primary">REGISTRAR</button>
                </div>
            </form>
        </div>
    @endif
@endsection
