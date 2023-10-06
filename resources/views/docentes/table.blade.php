@extends('layouts/app')
@section('titulo', 'Lista Docentes')
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
            <h3 class="text-center">LISTA DE DOCENTES</h3>
            <div class="text-right" style="margin-bottom: 5px;">
                <a href="{{ route('docentes.create') }}" class="btn btn-primary"><i
                        class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;Agregar
                    Docente</a>
            </div>
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
                            Telefono
                        </th>
                        <th>
                            Dirección
                        </th>
                        {{-- <th>
                            Foto
                        </th> --}}
                        <th>
                        </th>

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
                            <td>{{ $i->direccion }}</td>
                            {{-- <td>{{ $i->semestres }}</td> --}}
                            {{-- <td><img data-toggle="modal" data-target="#exampleModal{{ $i->id }}"
                                    style="width: 15px;cursor: pointer;"
                                    src="data:image/jpg;base64,{{ base64_encode($i->foto) }}" alt=""></td> --}}
                            <td>
                                <a href="{{ route('docentes.edit', $i->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('docentes.destroy', $i->id) }}" onclick="return confirmarEliminar();"
                                    class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>

                        </tr>
                        <!--VER PERFIL -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $i->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h3 class="modal-title" id="exampleModalLabel">Foto del perfil</h3>
                                    </div>
                                    <div class="modal-body">
                                        <img data-toggle="modal" data-target="#exampleModal"
                                            style="width:230px;margin: auto;display: flex"
                                            src="data:image/jpg;base64,{{ base64_encode($i->foto) }}" alt="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
