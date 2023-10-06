@extends('layouts/app')
@section('titulo', 'Lista Semestres')
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

        <div class="col-lg-12">
            <h3 class="text-center">LISTA DE SEMESTRES</h3>
            <div class="text-right" style="margin-bottom: 5px;">
                <a href="{{ route('semestres.create') }}" class="btn btn-primary"><i
                        class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Agregar Semestre</a>
            </div>
            <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
                <thead class="bg-primary">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Semestre
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
                            <td>{{ $i->id_semestre }}</td>
                            <td>{{ $i->semestre }}</td>
                            <td>{{ $i->año }}</td>
                            <td>
                                <a href="{{ route('semestres.edit', $i->id_semestre) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('semestres.destroy', $i->id_semestre) }}"
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
