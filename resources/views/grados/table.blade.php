@extends('layouts/app')
@section('titulo', 'Lista Grados')
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
                $(function() {
                    new PNotify({
                        title: 'ERROR',
                        type: 'error',
                        text: "{{ session('incorrecto') }}",
                        styling: 'bootstrap3'
                    })
                })

            </script>
        @endif

        <div class="col-lg-12">
            <h3 class="text-center">LISTA DE GRADOS</h3>
            <div class="text-right" style="margin-bottom: 5px;">
                <a href="{{ route('grados.create') }}" class="btn btn-primary"><i
                        class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Agregar Grado</a>
            </div>
            <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
                <thead class="bg-primary">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Grado
                        </th>
                        <th>
                            Sección
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sql as $i)
                        <tr>
                            <td>{{ $i->id_grado }}</td>
                            <td>{{ $i->grado }}</td>
                            <td>{{ $i->seccion }}</td>
                            <td>
                                <a href="{{ route('grados.edit', $i->id_grado) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('grados.destroy', $i->id_grado) }}" onclick="return confirmarEliminar();"
                                    class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
