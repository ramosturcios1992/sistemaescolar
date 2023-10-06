@extends('layouts/app')
@section('titulo', 'Mi verfil')
@section('content')

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

@if (session('dni'))
<script>
    $(function notificacion() {
                new PNotify({
                    title: 'CORRECTO',
                    type: 'warning',
                    text: "{{ session('dni') }}",
                    styling: 'bootstrap3'
                })
            })

</script>
@endif

@if (session('correo'))
<script>
    $(function notificacion() {
                new PNotify({
                    title: 'CORRECTO',
                    type: 'warning',
                    text: "{{ session('correo') }}",
                    styling: 'bootstrap3'
                })
            })

</script>
@endif

@if (session('error-clave'))
<script>
    $(function notificacion() {
                new PNotify({
                    title: 'AVISO',
                    type: 'warning',
                    text: "{{ session('error-clave') }}",
                    styling: 'bootstrap3'
                })
            })

</script>
@endif

@foreach ($sql as $item)
<div class="modal-body" id="modal-create">
    <h3 class="text-center" style="margin-bottom: 55px">MIS DATOS</h3>
    <form action="{{ route('verPerfil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $item->id }}">
        <div class="form-row col-12">
            <div class="col-xs-12 col-md-6">
                @error('dni')
                <small>*{{ $message }}</small>
                @enderror
                <input type="number" placeholder="Dni *" name="dni" id="dni" value="{{ $item->dni }}">
            </div>
            <div class="col-xs-12 col-md-6">
                @error('nombre')
                <small>*{{ $message }}</small>
                @enderror
                <input type="text" placeholder="Nombre *" id="nombre" name="nombre" value="{{ $item->name }}">
            </div>
            <div class="col-xs-12 col-md-6">
                @error('apellido')
                <small>*{{ $message }}</small>
                @enderror
                <input type="text" placeholder="Apellido *" id="apellido" name="apellido" value="{{ $item->apellido }}">
            </div>
            <div class="col-xs-12 col-md-6">
                @error('email')
                <small>*{{ $message }}</small>
                @enderror
                <input type="email" placeholder="Correo *" name="email" value="{{ $item->email }}">
            </div>

            <div class="col-xs-12 col-md-6">
                @error('direccion')
                <small>*{{ $message }}</small>
                @enderror
                <input type="text" placeholder="Direccion" name="direccion" value="{{ $item->direccion }}">
            </div>
            @if ($item->tipo == 3)
            <div class="col-xs-12 col-md-6">
                @error('grado')
                <small>*{{ $message }}</small>
                @enderror
                <select name="grado" id="grado">
                    @foreach ($sql2 as $ite)
                    <option value="{{$ite->id_grado}}">{{$ite->grado}} {{$ite->seccion1}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            @if ($item->tipo == 3)
            <div class="col-xs-12">
                @error('telefono')
                <small>*{{ $message }}</small>
                @enderror
                <input type="number" placeholder="Numero de telefono" name="telefono" value="{{ $item->telefono }}">
            </div>
            @else
            <div class="col-xs-12 col-md-6">
                @error('telefono')
                <small>*{{ $message }}</small>
                @enderror
                <input type="number" placeholder="Numero de telefono" name="telefono" value="{{ $item->telefono }}">
            </div>
            @endif
        </div>
        <div class="modal-footer">
            <a href="{{ url('/home') }}" class="btn btn-secondary" data-dismiss="modal">SALIR</a>
            <button type="submit" id="boton" class="btn btn-primary">MODIFICAR</button>
        </div>
    </form>
</div>
<div id="modal-create">
    <h4 class="text-center">MODIFICAR CONTRASEÑA</h4>
    <form method="POST" action="{{route('verPerfil.modificarClave')}}">
        @csrf
        <div class="col-xs-12 col-md-6">
            @error('clave')
            <small>*{{ $message }}</small>
            @enderror
            <input value="{{old('clave')}}" type="password" name="clave" id="clave" placeholder="Nueva Contraseña"
                value="">
        </div>
        <div class="col-xs-12 col-md-6">
            @error('nuevoClave')
            <small>*{{ $message }}</small>
            @enderror
            <input value="{{old('nuevoClave')}}" type="password" name="nuevoClave" id="nuevoClave"
                placeholder="Repita la Contraseña" value="">
        </div>
        <div class="modal-footer">
            <button type="submit" id="boton" class="btn btn-primary">MODIFICAR CONTRASEÑA</button>
        </div>
    </form>
</div>

@endforeach
<script>
    var boton = document.getElementById("boton");
        $("#dni").change(function() {
            var dni = document.getElementById("dni").value;
            fetch('https://dni.optimizeperu.com/api/persons/' + dni).then(res => res.json()).then(data => {
                document.getElementById("nombre").value = (data.name);
                document.getElementById("apellido").value = (data.first_name + " " + data.last_name);
            });
        })

        //OJO ESTE CODIGO E EJECUTA SI LA PAGINA NO ES HTTPS
        // var boton = document.getElementById("boton");
        // $("#dni").change(function() {
        //     var dni = document.getElementById("dni").value;
        //     fetch('http://zekasystem.xyz/api/dni2?dni=' + dni).then(res => res.json()).then(data => {
        //         document.getElementById("nombre").value = (data.nombres);
        //         document.getElementById("apellido").value = (data.apellido_paterno + " " + data
        //             .apellido_materno);
        //     });
        // })

</script>
@endsection