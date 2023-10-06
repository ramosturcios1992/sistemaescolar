@extends('layouts/app')
@section('titulo', 'Lista Semestres')
@section('content')
@if (Auth::user()->tipo == 1)
@if (session('mensaje'))

<script>
    $(function(){
        new PNotify({
            title:"CORRECTO",
            type:"success",
            text:"{{session('mensaje')}}",
            styling:"bootstrap3"
        })
    })
</script>
@endif
@if (session('inmensaje'))
<script>
    $(function(){
        new PNotify({
            title:"INCORRECTO",
            type:"error",
            text:"{{session('inmensaje')}}",
            styling:"bootstrap3"
        })
    })
</script>
@endif
<div class="panel panel-info bg-primary">
    <script>
        function eliminar(e){
            var res=confirm("Estas seguro que deseas eliminar. Ten en cuenta que ya no podrás recuperarlo")
            if (res==true) {
                var res2=confirm("Por seguridad le preguntamos otra vez ¿ Estas seguro que deseas eliminar. Ten en cuenta que ya no podrás recuperarlo ?")
                return res2
            }else{
                return false
            }
        }
    </script>
    <!-- Default panel contents -->
    <div class="panel-heading">
        @foreach ($sql2 as $item)
        <h3 class="text-center">{{ $item->name . ' ' . $item->apellido }}</h3>
        @endforeach
        @foreach ($gradoSeccion as $item)
        <h3 class="text-center">{{ $item->grado . '' . $item->nom_seccion . '---' . $item->nombre . ' ' }}</h3>
        @endforeach
        <h4 class="text-danger">DEBES SELECCIONAR UN SEMESTRE...</h4>
    </div>
    <div style="text-align: center" class="panel-body">
        @foreach ($semestre as $sem)
        <a style="margin: 3px;" class="btn btn-primary"
            href="{{ route('notas.verNotasSemestre', [$id, $grado, $sem->id_semestre,$anio]) }}">SEMESTRE
            {{ $sem->semestre . ' ' . $anio }}</a>
        @endforeach
        <a class="btn btn-success" href="{{ route('notas.verNotasFinales', [$id, $grado,$anio]) }}">PROMEDIO FINAL</a>
        <a onclick="return eliminar()" class="btn btn-danger"
            href="{{ route('notas.eliminarNotas', [$anio]) }}">ELIMINAR NOTAS DE ESTE AÑO</a>
    </div>
</div>
<div class="col-lg-12">
    <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                        PRO
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($sql as $i)
                <tr>
                    <td>{{ $i->id_nota }}</td>
                    <td>{{ $i->name . ' ' . $i->apellido }}</td>
                    <td>{{ $curso }}</td>
                    <td>
                        {{ $i->nota1 }}
                    </td>
                    <td>{{ $i->nota2 }}</td>
                    <td>{{ $i->nota3 }}</td>
                    <td style="font-size: 16px;color: #000;font-weight: bold"><span>{{ $i->promedio }}</span>
                    </td>


                </tr>
                @endforeach
                @foreach ($consulta as $ite)
                <tr>
                    <td>{{ $ite->id }}</td>
                    <td>{{ $ite->name . ' ' . $ite->apellido }}</td>
                    <td>{{ $curso }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-size: 16px;color: #000;font-weight: bold"><span id="pro"></span>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal-footer">
    <a href="{{ route('notas.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
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
    (function() {
                $("#n1").change(function() {
                    console.log("bien")
                })
            }())

</script>



@endif
@endsection