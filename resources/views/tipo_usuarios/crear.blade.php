@extends('layouts/app')
@section('titulo', 'Registro Tipo Usuario')
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
        @if (session('aviso'))
            <script>
                $(function() {
                    new PNotify({
                        title: 'correcto',
                        type: 'warning',
                        text: "{{ session('aviso') }}",
                        styling: 'bootstrap3'
                    })
                })

            </script>
        @endif

        <div class="modal-body" id="modal-create">
            <h3 class="text-center" style="margin-bottom: 55px">REGISTRO DE NUEVO TIPO DE USUARIO</h3>
            <form action="{{ route('tipo_usuarios.store') }}" method="POST">
                @csrf
                <div class="form-row col-12">
                    @error('tipo')
                        <small>*{{ $message }}</small>
                    @enderror
                    <input type="text" placeholder="Tipo de usuario" name="tipo" id="tipo" value="{{ old('tipo') }}">
                </div>
                <div class="modal-footer">
                    <a href="{{ route('tipo_usuarios.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                    <button type="submit" id="boton" class="btn btn-primary">REGISTRAR</button>
                </div>
            </form>
        </div>


    @endif
@endsection
