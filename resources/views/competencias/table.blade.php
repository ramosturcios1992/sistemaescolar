@extends('layouts/app')
@section('titulo', 'Lista Competencias')
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
                        type: 'success',
                        text: "{{ session('incorrecto') }}",
                        styling: 'bootstrap3'
                    })
                })

            </script>
        @endif

        <div class="col-lg-12">
            <h3 class="text-center">LISTA DE COMPETENCIAS</h3>
            <div class="text-right" style="margin-bottom: 5px;">
                <a href="{{ route('competencias.create') }}" class="btn btn-primary"><i
                        class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Agregar Competencia</a>
            </div>
            <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
                <thead class="bg-primary">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            competencia
                        </th>
                        <th>
                            Curso
                        </th>
                        <th>
                            Año
                        </th>
                        <th>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($sql as $i)
                        <tr>
                            <td>{{ $i->id_competencias }}</td>
                            <td>{{ $i->competencia }}</td>
                            <td>{{ $i->nombre }}</td>
                            <td>{{ $i->año }}</td>
                            <td>
                                <a href="{{ route('competencias.edit', $i->id_competencias) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('competencias.destroy', $i->id_competencias) }}"
                                    onclick="return confirmarEliminar();" class="btn btn-danger btn-sm">
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
