@extends('layouts/app')
@section('titulo', 'Horarios de clase')
@section('content')
@if (Auth::user()->tipo == 1)

@if (session('correcto'))
<script>
    $(function notificacion(){
            new PNotify({
                title:"CORRECTO",
                type:"success",
                text:"{{session('correcto')}}",
                styling:"bootstrap3"
            })
        })
</script>
@endif

@if (session('incorrecto'))
<script>
    $(function notificacion(){
            new PNotify({
                title:"ERROR",
                type:"error",
                text:"{{session('incorrecto')}}",
                styling:"bootstrap3"
            })
        })
</script>
@endif
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
<div class="col-lg-12">
    <h3 class="text-center">PARA CREAR EL HORARIO PRIMERO ELIGE UN GRADO</h3>
    <div class="text-center">
        <a onclick="return eliminar()" href="{{route('horarios.eliminar')}}" class="btn btn-danger">ELIMINAR TODO LOS HORARIOS</a>
    </div>
    <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
        <thead class="bg-primary">
            <tr>
                <th>
                    Grado y Sección
                </th>
                <th>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sql as $i)
            <tr>
                <td>{{ $i->grado."  ".$i->nom_seccion }}</td>
                <td><a target="_blank" href="{{route('horarios.index',[$i->id_grado])}}"><i
                            class="fas fa-share"></i>&nbsp;&nbsp;&nbsp;GENERAR HORARIO DE CLASES</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>


@endif
@endsection