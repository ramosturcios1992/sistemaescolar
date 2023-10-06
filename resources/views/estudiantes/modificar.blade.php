@extends('layouts/app')
@section('titulo', 'Modificar Estudiante')
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
                <h3 class="text-center" style="margin-bottom: 35px">MODIFICAR ESTUDIANTE</h3>
                <form action="{{ route('estudiantes.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" placeholder="id" name="id" id="id" value="{{ $i->id }}">
                    <div class="form-row col-12">
                        <div class="col-xs-12 col-md-6">
                            @error('dni')
                                <small>*{{ $message }}</small>
                            @enderror
                            <input type="number" placeholder="Dni" name="dni" id="dni" value="{{ $i->dni }}">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            @error('nombre')
                                <small>*{{ $message }}</small>
                            @enderror
                            <input type="text" placeholder="Nombre" id="nombre" name="nombre" value="{{ $i->name }}">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            @error('apellido')
                                <small>*{{ $message }}</small>
                            @enderror
                            <input type="text" placeholder="Apellido" id="apellido" name="apellido"
                                value="{{ $i->apellido }}">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            @error('correo')
                                <small>*{{ $message }}</small>
                            @enderror
                            <input type="email" placeholder="Correo" name="correo" value="{{ $i->email }}">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            @error('direccion')
                                <small>*{{ $message }}</small>
                            @enderror
                            <input type="text" placeholder="Direccion" name="direccion" value="{{ $i->direccion }}">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            @error('grado')
                                <small>*{{ $message }}</small>
                            @enderror
                            <select name="grado" id="grado">
                                <option value="">Grado y seccion...</option>
                                @foreach ($sql2 as $item)
                                    <option {{ $item->id_grado == $i->id_grado ? 'selected' : '' }}
                                        value="{{ $item->id_grado }}">
                                        {{ $item->grado . ' ' . $item->seccion1 }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12">
                            @error('telefono')
                                <small>*{{ $message }}</small>
                            @enderror
                            <input type="number" placeholder="Numero de telefono" name="telefono"
                                value="{{ $i->telefono }}">
                        </div>



                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                        <button type="submit" id="boton" class="btn btn-primary">MODIFICAR</button>
                    </div>
                </form>
            @endforeach
        </div>

        <script>
            $("#dni").change(function() {
                var dni = document.querySelector("#dni").value;
                fetch('https://dni.optimizeperu.com/api/persons/' + dni).then(res =>
                        res.json())
                    .then(
                        data => {
                            document.querySelector("#nombre").value = (data.name);
                            document.querySelector("#apellido").value = (data
                                .first_name + " " +
                                data
                                .last_name);
                        });
                console.log("bien")
            })

            //OJO ESTE CODIGO E EJECUTA SI LA PAGINA NO ES HTTPS
            // $("#dni").change(function() {
            //     var dni = document.getElementById("dni").value;
            //     fetch('http://zekasystem.xyz/api/dni2?dni=' + dni).then(res => res.json()).then(data => {
            //         document.getElementById("nombre").value = (data.nombres);
            //         document.getElementById("apellido").value = (data.apellido_paterno + " " + data
            //             .apellido_materno);
            //     });
            // })

        </script>
    @endif
@endsection
