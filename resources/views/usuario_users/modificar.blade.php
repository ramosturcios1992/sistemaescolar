@extends('layouts/app')
@section('titulo', 'Modificar Usuario')
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
                <h3 class="text-center" style="margin-bottom: 35px">MODIFICAR USUARIO</h3>
                <form action="{{ route('usuarios.update') }}" method="POST">
                    @csrf
                    <input hidden type="text" value="{{ $i->id }}" name="id">
                    <div>
                        @error('dni')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="number" id="dni" placeholder="Dni" name="dni" value="{{ $i->dni }}">
                        @error('nombre')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="text" id="nombre" placeholder="Nombre" name="nombre" value="{{ $i->name }}">
                        @error('apellido')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="text" id="apellido" placeholder="Apellido" name="apellido" value="{{ $i->apellido }}">
                        @error('email')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="email" placeholder="Correo" name="email" value="{{ $i->email }}">
                        @error('tipo')
                            <small>*{{ $message }}</small>
                        @enderror
                        <select name="tipo">
                            <option {{ $i->tipo == 1 ? 'selected' : '' }} value="1">Administrador
                            </option>
                            <option {{ $i->tipo == 2 ? 'selected' : '' }} value="2">Docente</option>
                            <option {{ $i->tipo == 3 ? 'selected' : '' }} value="3">Estudiante
                            </option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                        <button type="submit" class="btn btn-primary">GUARDAR</button>
                    </div>
                </form>
            @endforeach
        </div>

        <script>
            // const token = new Headers({
            //     'Authorization': 'k4d2956bd531ab61d44f4fa07304b20e13913815'
            // });
            // , {
            //     method: 'GET',
            //     headers: token
            // }
            $("#dni").change(function() {
                var dni = document.querySelector("#dni").value;
                fetch('https://dni.optimizeperu.com/api/persons/' + dni)
                    .then(res =>
                        res.json()
                    )
                    .then(
                        data => {
                            document.querySelector("#nombre").value = (data.name);
                            document.querySelector("#apellido").value = (data
                                .first_name + " " +
                                data
                                .last_name);
                        }
                    );
                console.log("bien")
            })
            //OJO ESTE CODIGO E EJECUTA SI LA PAGINA NO ES HTTPS
            //  $("#dni").change(function() {
            //      var dni = document.getElementById("dni").value;
            //      fetch('http://zekasystem.xyz/api/dni2?dni=' + dni).then(res => res.json()).then(data => {
            //          document.getElementById("nombre").value = (data.nombres);
            //          document.getElementById("apellido").value = (data.apellido_paterno + " " + data
            //              .apellido_materno);
            //      });
            //  })

        </script>


    @endif
@endsection
