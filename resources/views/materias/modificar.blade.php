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
                <h3 class="text-center" style="margin-bottom: 35px">MODIFICAR CURSO</h3>
                <form action="{{ route('materias.update') }}" method="POST">
                    <input type="hidden" name="id" value="{{ $i->id_materia }}">
                    @csrf
                    <div class="form-row col-12">
                        @error('nombre')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="text" placeholder="Nombre del Curso" name="nombre" id="nombre"
                            value="{{ $i->nombre }}">
                    </div>

                    <div class="modal-footer">
                        <a href="{{ route('materias.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                        <button type="submit" id="boton" class="btn btn-primary">MODIFICAR</button>
                    </div>
                </form>
            @endforeach
        </div>
    @endif

@endsection
