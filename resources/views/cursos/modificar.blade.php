@extends('layouts/app')
@section('titulo', 'Modificar Curso')
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


        <!-- Modal actualizar-->

        <div id="modal-edit">
            @foreach ($sql as $i)
                <h3 class="text-center" style="margin-bottom: 35px">MODIFICAR CURSO Y DOCENTE</h3>
                <form action="{{ route('cursos.update') }}" method="POST">
                    <input type="hidden" name="id" value="{{ $i->id_curso }}">
                    @csrf
                    <div class="form-row col-12">
                        @error('nombre')
                            <small>*{{ $message }}</small>
                        @enderror
                        <select name="nombre" id="nombre">
                            <option value="">Nombre del Curso...</option>
                            @foreach ($sql4 as $it)
                                <option {{ $it->nombre == $i->nombre ? 'selected' : '' }} value="{{ $it->nombre }}">
                                    {{ $it->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row col-12">
                        @error('docente')
                            <small>*{{ $message }}</small>
                        @enderror
                        <select name="docente" id="docente">
                            @foreach ($sql3 as $item)
                                <option {{ $item->id == $i->docente ? 'selected' : '' }} value="{{ $item->id }}">
                                    {{ $item->name . ' ' . $item->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row col-12">
                        @error('grado')
                            <small>*{{ $message }}</small>
                        @enderror
                        <select name="grado" id="grado">
                            @foreach ($sql2 as $it)
                                <option {{ $i->id_grado == $it->id_grado ? 'selected' : '' }} value="{{ $it->id_grado }}">
                                    {{ $it->grado . ' ' . $it->seccion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('cursos.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                        <button type="submit" id="boton" class="btn btn-primary">MODIFICAR</button>
                    </div>
                </form>
            @endforeach
        </div>
    @endif

@endsection
