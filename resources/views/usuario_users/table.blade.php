@extends('layouts/app')
@section('titulo', 'Lista Usuarios')
@section('content')
    @if (Auth::user()->tipo == 1)
        <script>
            function confirmarEliminar() {
                var res = confirm("Estas seguro que deseas eliminar");
                if (res == true) {
                    return true;
                } else {
                    return false;
                }
            }

        </script>

        @if (session('correcto'))
            <script>
                $(function() {
                    new PNotify({
                        title: 'correcto',
                        type: 'success',
                        text: "{{ session('correcto') }}",
                        styling: 'bootstrap3'
                    })
                })

            </script>
        @endif

        @if (session('incorrecto'))
            <script>
                $(function() {
                    new PNotify({
                        title: 'correcto',
                        type: 'error',
                        text: "{{ session('incorrecto') }}",
                        styling: 'bootstrap3'
                    })
                })

            </script>
        @endif

        @if (session('estado'))
            <script>
                $(function() {
                    new PNotify({
                        title: 'correcto',
                        type: 'info',
                        text: "{{ session('estado') }}",
                        styling: 'bootstrap3'
                    })
                })

            </script>
        @endif

        <div class="col-lg-12">
            <h3 class="text-center">LISTA DE USUARIOS</h3>
            {{-- <div class="text-right" style="margin-bottom: 5px;">
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary"><i
                        class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;Agregar
                    Usuario</a>
            </div> --}}
            <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
                <thead class="bg-primary">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Dni
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Apellido
                        </th>
                        <th>
                            Correo
                        </th>
                        <th>
                            Teléfono
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th>
                            Estado
                        </th>
                        {{-- <th>
                        </th> --}}

                    </tr>
                </thead>
                <tbody>
                    @foreach ($sql as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->dni }}</td>
                            <td>{{ $i->name }}</td>
                            <td>{{ $i->apellido }}</td>
                            <td>{{ $i->email }}</td>
                            <td>{{ $i->telefono }}</td>
                            <td>{{ $i->tipo_usuario }}</td>
                            <td>
                                @if ($i->estado == 1)
                                    <a href="{{ route('estado', $i->id) }}" style="color: rgb(0, 175, 53)"><i
                                            class="fas fa-toggle-on fa-2x"></i></a>
                                @else
                                    <a href="{{ route('estado', $i->id) }}" style="color: rgb(255, 0, 0)"><i
                                            class="fas fa-toggle-on fa-2x"></i></a>
                                @endif
                            </td>
                            {{-- <td>
                                <a href="{{ route('usuarios.edit', $i->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('usuarios.destroy', $i->id) }}" onclick="return confirmarEliminar();"
                                    class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td> --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        


    @endif
@endsection
