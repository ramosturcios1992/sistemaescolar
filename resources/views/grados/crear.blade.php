@extends('layouts/app')
@section('titulo', 'Registro Grado')
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
            <h3 class="text-center" style="margin-bottom: 55px">REGISTRO DE NUEVO GRADO Y SECCION</h3>
            <form action="{{ route('grados.store') }}" method="POST">
                @csrf
                <div class="form-row col-12">
                    @error('grado')
                        <small>*{{ $message }}</small>
                    @enderror
                    <select name="grado" id="grado">
                        <option value="">Seleccionar grado...</option>
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i . '°' }}">{{ $i . ' °' }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-row col-12">
                    @error('seccion')
                        <small>*{{ $message }}</small>
                    @enderror
                    <select name="seccion" id="seccion">
                        @foreach ($sql as $i)
                            <option value="{{ $i->id_seccion }}">{{ $i->seccion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('grados.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                    <button type="submit" id="boton" class="btn btn-primary">REGISTRAR</button>
                </div>
            </form>
        </div>
    @endif
@endsection
