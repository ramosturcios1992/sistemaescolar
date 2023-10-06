@extends('layouts/app')
@section('titulo', 'Modificar Competencia')
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
            <h3 class="text-center" style="margin-bottom: 35px">MODIFICAR COMPETENCIA</h3>
            <form action="{{ route('competencias.update') }}" method="POST">
                <input type="hidden" name="id" value="{{ $i->id_competencias }}">
                @csrf

                <div class="form-row col-12">
                    @error('nombre')
                        <small>*{{ $message }}</small>
                    @enderror
                    <input type="text" placeholder="Nombre de la competencia" name="nombre" id="nombre"
                        value="{{ $i->competencia }}">
                </div>
                <div class="form-row col-12">
                    @error('curso')
                        <small>*{{ $message }}</small>
                    @enderror
                    <select name="curso" id="curso">
                        @foreach ($sql2 as $it)
                            <option {{ $it->id_curso == $i->curso ? 'selected' : '' }} value="{{ $it->id_curso }}">
                                {{ $it->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row col-12">
                    @error('año')
                        <small>*{{ $message }}</small>
                    @enderror
                    <select name="año" id="año">
                        {{ $año2 = $i->año }}
                        {{ $año = date('yy') }}
                        @for ($i = $año; $año <= 2025; $año++)
                            <option {{ $año2 == $año ? 'selected' : '' }} value="{{ $año }}">{{ $año }}</option>
                        @endfor
                    </select>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('competencias.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                    <button type="submit" id="boton" class="btn btn-primary">MODIFICAR</button>
                </div>
            </form>
        @endforeach
    </div>
   
@endif

@endsection
