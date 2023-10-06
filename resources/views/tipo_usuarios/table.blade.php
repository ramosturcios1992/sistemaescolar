@extends('layouts/app')
@section('titulo', 'Lista Tipo Usuarios')
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

        <div class="col-lg-12">
            <h3 class="text-center">LISTA DE TIPOS DE USUARIO</h3>
            {{-- <div class="text-right" style="margin-bottom: 5px;">
                <a href="{{ route('tipo_usuarios.create') }}" class="btn btn-primary"><i
                        class="fas fa-plus"></i></i>&nbsp;&nbsp;&nbsp;Agregar Tipo
                    Usuario</a>
            </div> --}}
            <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
                <thead class="bg-primary">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Tipo Usuario
                        </th>
                        {{-- <th>
                        </th> --}}

                    </tr>
                </thead>
                <tbody>
                    @foreach ($sql as $i)
                        <tr>
                            <td>{{ $i->id_tipo_usuario }}</td>
                            <td>{{ $i->tipo }}</td>
                            {{-- <td>
                                <a href="{{ route('tipo_usuarios.edit', $i->id_tipo_usuario) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('tipo_usuarios.destroy', $i->id_tipo_usuario) }}"
                                    onclick="return confirmarEliminar();" class="btn btn-danger btn-sm">
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
