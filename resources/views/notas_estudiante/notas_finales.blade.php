@extends('layouts/app')
@section('titulo', 'Notas Finales')
@section('content')
    @if (Auth::user()->tipo == 3)

        <div>
            <div class="panel panel-info bg-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h4>PROMEDIO FINALES</h4>
                </div>

            </div>
            <div class="modal-footer">
                <a href="{{ route('notasEstudiante.index',[$anio]) }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
            </div>
            <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
                <thead class="bg-primary">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            CURSO
                        </th>
                        <th>
                            DNI
                        </th>
                        <th>
                            ALUMNO
                        </th>
                        <th>
                            PROMEDIO
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sql as $i)
                        <tr class="post">
                            <td>{{ $i->id_nota }}</td>
                            <td>{{ $i->nombre }}</td>
                            <td>{{ $i->dni }}</td>
                            <td>{{ $i->name . ' ' . $i->apellido }}</td>
                            <td style="font-size: 16px;color: #000;font-weight: bold"><span
                                    id="prom">{{ $i->pro_total }}</span>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($consulta as $ite)
                        <tr>
                            <td>--</td>
                            <td>{{ $ite->nombre }}</td>
                            <td>{{ Auth::user()->dni }}</td>
                            <td>{{ Auth::user()->name . ' ' . Auth::user()->apellido }}</td>
                            <td style="font-size: 16px;color: #000;font-weight: bold"><span id="prom">--</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>






        </div>

        <script>
            var span = document.querySelectorAll("span");
            span.forEach(span => {
                var valorSpan = parseInt(span.innerHTML);
                if (valorSpan < 11) {
                    span.style.color = "red"
                } else {}

            });

        </script>


    @endif
@endsection
