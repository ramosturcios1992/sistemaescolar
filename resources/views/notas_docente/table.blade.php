@extends('layouts/app')
@section('titulo', 'Lista Semestres')
@section('content')
@if (Auth::user()->tipo == 2)

<div style="padding: 20px 0">
    <div class="panel panel-info bg-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            @foreach ($gradoSeccion as $item)
            <h3 class="text-center">{{ $item->grado . '' . $item->nom_seccion . '---' . $item->nombre . ' ' }}
            </h3>
            @endforeach
            <h4>SELECCIONAR UN SEMESTRE...</h4>
        </div>
        <div style="text-align: center" class="panel-body">
            @foreach ($semestre as $sem)
            <a style="margin: 3px;" class="btn btn-primary"
                href="{{ route('notasDocente.verNotasPorSemestre', [$curso, $grado, $sem->id_semestre,$anio]) }}">SEMESTRE
                {{ $sem->semestre . ' ' . $sem->año }}</a>
            @endforeach
            <a class="btn btn-success"
                href="{{ route('notasDocente.verNotasFinales', [$curso, $grado,$anio]) }}">PROMEDIO
                FINAL</a>
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{ route('notasDocente.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
    </div>
    <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
        <thead class="bg-primary">
            <tr>
                <th>
                    ID
                </th>
                <th>
                    ALUMNO
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
                    PRO
                </th>
                <th>
                </th>

            </tr>
        </thead>
        <tbody>
            <?php $c = 1; ?>
            @foreach ($sql as $i)
            <tr class="post">
                <td>{{ $i->id }}</td>
                <td>{{ $i->name . ' ' . $i->apellido }}</td>
                <form action="" id="formulario">
                    <td>
                        <input type="text" hidden id="id" name="id" value="{{ $i->id }}">
                        <input type="text" hidden id="anio" name="anio" value="{{ $anio }}">
                        <input type="text" hidden id="semestre" name="semestre" value="{{ $id_semestre }}">
                        <input type="number" onchange="actualizar('{{ $i->id_nota }}','{{ $c }}');"
                            value="{{ $i->nota1 }}" name="n1" id="n1{{ $c }}" style="width: 65px" min="0" max="20"
                            step="0" value="">
                    </td>
                    <td><input type="number" onchange="actualizar('{{ $i->id_nota }}','{{ $c }}');"
                            value="{{ $i->nota2 }}" name="n2" id="n2{{ $c }}" style="width: 65px" min="0" max="20"
                            step="0" value=""></td>
                    <td><input type="number" onchange="actualizar('{{ $i->id_nota }}','{{ $c }}');"
                            value="{{ $i->nota3 }}" name="n3" id="n3{{ $c }}" style="width: 65px" min="0" max="20"
                            step="0" value=""></td>
                    <td style="font-size: 16px;color: #000;font-weight: bold"><span
                            id="prom{{ $c }}">{{ $i->promedio }}</span></td>

                    <td>
                        <a onclick="actualizar('{{ $i->id_nota }}','{{ $c }}')" class="btn btn-success btn-sm">
                            <i class="fas fa-save"></i>
                        </a>
                    </td>
                </form>
            </tr>


            <?php $c++; ?>
            @endforeach
            <?php $c2 = 1; ?>

            @foreach ($consulta as $ite)
            <tr>
                <td>{{ $ite->id }}</td>
                <td>{{ $ite->name . ' ' . $ite->apellido }}</td>
                <form action="" id="formulario2">
                    <td>
                        <input type="text" hidden id="anio" name="anio" value="{{ $anio }}">
                        <input type="text" hidden id="id" name="id" value="{{ $ite->id }}">
                        <input type="text" hidden id="semestre" name="semestre" value="{{ $id_semestre }}">
                        <input type="number" onchange="actualizar2('{{ $ite->id }}','{{ $curso }}','{{ $c2 }}');"
                            value="" name="nn1" id="nn1{{ $c2 }}" style="width: 65px" min="0" max="20" step="0"
                            value="">
                    </td>
                    <td><input type="number" onchange="actualizar2('{{ $ite->id }}','{{ $curso }}','{{ $c2 }}');"
                            value="" name="nn2" id="nn2{{ $c2 }}" style="width: 65px" min="0" max="20" step="0"
                            value="">
                    </td>
                    <td><input type="number" onchange="actualizar2('{{ $ite->id }}','{{ $curso }}','{{ $c2 }}');"
                            value="" name="nn3" id="nn3{{ $c2 }}" style="width: 65px" min="0" max="20" step="0"
                            value="">
                    </td>
                    <td style="font-size: 16px;color: #000;font-weight: bold"><span id="prom2{{ $c2 }}"></span>
                    </td>
                    <td>
                        <a onclick="actualizar2('{{ $ite->id }}','{{ $curso }}','{{ $c2 }}')"
                            class="btn btn-success btn-sm">
                            <i class="fas fa-save"></i>
                        </a>
                    </td>
                </form>
            </tr>
            <?php $c2++; ?>
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

<script>
    function actualizar(id, c) {
                var nota1 = document.getElementById("n1" + c).value;
                var nota2 = document.getElementById("n2" + c).value;
                var nota3 = document.getElementById("n3" + c).value;
                var semestre = document.getElementById("semestre").value;
                var anio = document.getElementById("anio").value;

                if (nota1 == "") {
                    nota1 = 0;
                }
                if (nota2 == "") {
                    nota2 = 0;
                }
                if (nota3 == "") {
                    nota3 = 0;
                }
                var ruta = "{{ url('notas-docente-actualizar/') }}/" + id + "/" + nota1 + "/" + nota2 + "/" + nota3 + "/" +
                    semestre + "/" + anio + "";
                $.ajax({
                    url: ruta,
                    type: "get",
                    success: function(data) {
                        document.getElementById("prom" + c).innerHTML = data.dato;
                    },
                    error: function(data) {
                        $("#prom").html(data.error);

                        // if ($.isEmptyObject(errors) == false) {
                        //     $.each(errors.errors, function(key, value) {
                        //         var errorId = '#' + key + 'Error';
                        //         $(errorId).removeClass("d-none");
                        //         $(errorId).text(value);
                        //     })
                        // }
                    }
                })
            }

</script>
<script>
    function actualizar2(id, curso, c2) {

                var nota1 = document.getElementById("nn1" + c2).value;
                var nota2 = document.getElementById("nn2" + c2).value;
                var nota3 = document.getElementById("nn3" + c2).value;
                var semestre = document.getElementById("semestre").value;
                var anio = document.getElementById("anio").value;

                if (nota1 == "") {
                    nota1 = 0;
                }
                if (nota2 == "") {
                    nota2 = 0;
                }
                if (nota3 == "") {
                    nota3 = 0;
                }
                var ruta = "{{ url('notas-docente-actualizar2/') }}/" + id + "/" + nota1 + "/" + nota2 + "/" + nota3 + "/" +
                    curso + "/" + semestre + "/" + anio + "";
                $.ajax({
                    url: ruta,
                    type: "get",
                    success: function(data) {
                        document.getElementById("prom2" + c2).innerHTML = data.dato2;
                    },
                    error: function(data) {
                        $("#prom2").html(data.error);

                        // if ($.isEmptyObject(errors) == false) {
                        //     $.each(errors.errors, function(key, value) {
                        //         var errorId = '#' + key + 'Error';
                        //         $(errorId).removeClass("d-none");
                        //         $(errorId).text(value);
                        //     })
                        // }
                    }
                })
            }

</script>

@endif
@endsection