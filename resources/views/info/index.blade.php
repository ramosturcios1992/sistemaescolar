@extends('layouts/app')
@section('titulo', 'Informacion')
@section('content')

@if (Auth::user()->tipo==1)
@if (session('correcto'))
<script>
    $(function notificacion() {
                new PNotify({
                    title: 'CORRECTO',
                    type: 'success',
                    text: "{{ session('correcto') }}",
                    styling: 'bootstrap3'
                })
            })

</script>
@endif

@if (session('incorrecto'))
<script>
    $(function notificacion() {
                new PNotify({
                    title: 'CORRECTO',
                    type: 'error',
                    text: "{{ session('incorrecto') }}",
                    styling: 'bootstrap3'
                })
            })

</script>
@endif


@foreach ($sql as $item)
<div class="modal-body" id="modal-create">
    <h3 class="text-center" style="margin-bottom: 55px">MIS DATOS</h3>
    <form action="{{route('info.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row col-12">
            <div class="col-xs-12 col-md-6">
                @error('nombre')
                <small>*{{ $message }}</small>
                @enderror
                <input type="text" placeholder="Nombre *" id="nombre" name="nombre" value="{{ $item->nombre }}">
            </div>
            <div class="col-xs-12 col-md-6">
                @error('ubicacion')
                <small>*{{ $message }}</small>
                @enderror
                <input type="text" placeholder="ubicacion *" id="ubicacion" name="ubicacion"
                    value="{{ $item->ubicacion }}">
            </div>

            <div class="col-xs-12 col-md-6">
                @error('ruc')
                <small>*{{ $message }}</small>
                @enderror
                <input type="text" placeholder="ruc" name="ruc" value="{{ $item->ruc }}">
            </div>

            <div class="col-xs-12 col-md-6">
                @error('telefono')
                <small>*{{ $message }}</small>
                @enderror
                <input type="text" placeholder="telefono" name="telefono" value="{{ $item->telefono }}">
            </div>

        </div>
        <div class="modal-footer">
            <a href="{{ url('/home') }}" class="btn btn-secondary" data-dismiss="modal">SALIR</a>
            <button type="submit" id="boton" class="btn btn-primary">MODIFICAR</button>
        </div>
    </form>
</div>
@endforeach
@endif

@endsection