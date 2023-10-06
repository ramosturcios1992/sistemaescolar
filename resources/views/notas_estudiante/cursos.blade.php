@extends('layouts/app')
@section('titulo', 'Lista Notas')
@section('content')
@if (Auth::user()->tipo == 3)
<div>
    <div class="panel panel-info bg-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <h4>SELECCIONAR UN SEMESTRE...</h4>
        </div>
    </div>
    <div style="text-align: center" class="panel-body">
        @foreach ($semestre as $sem)
        <a style="margin: 3px;" class="btn btn-primary"
            href="{{ route('notasEstudiante.verNotasPorSemestre', [$sem->id_semestre,$anio]) }}">SEMESTRE
            {{ $sem->semestre . ' ' . $sem->año }}</a>
        @endforeach
        <a class="btn btn-success" href="{{ route('notasEstudiante.verNotasFinales',[$anio]) }}">PROMEDIO
            FINAL</a>
    </div>
    <h3 class="text-center">MIS CALIFICACIONES</h3>

    <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
        <thead class="bg-primary">
            <tr>
                <th>
                    CURSO
                </th>
                <th>
                    NOTA 1
                </th>
                <th>
                    NOTA 2
                </th>
                <th>
                    NOTA 3
                </th>
                <th>
                    PROMEDIO
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sql as $i)
            <tr>
                <td>{{ $i->nombre }}</td>
                <td>{{ $i->nota1 }}</td>
                <td>{{ $i->nota2 }}</td>
                <td>{{ $i->nota3 }}</td>
                <td style="font-size: 16px;color: black;font-weight: bold"><span>{{ $i->promedio }}</span></td>
            </tr>
            @endforeach

            @foreach ($consulta as $ite)
            <tr>
                <td>{{ $ite->nombre }}</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td><span>--</span></td>
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