@extends('layouts/app')
@section('titulo', 'Notas Finales')
@section('content')
    @if (Auth::user()->tipo == 2)

        <div>
            <div class="panel panel-info bg-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    @foreach ($gradoSeccion as $item)
                        <h3 class="text-center">{{ $item->grado . '' . $item->nom_seccion . '---' . $item->nombre . ' ' }}
                        </h3>
                    @endforeach
                    <h4>PROMEDIO FINALES</h4>
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
                    <?php $c = 1; ?>
                    @foreach ($sql as $i)
                        <tr class="post">
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->dni }}</td>
                            <td>{{ $i->name . ' ' . $i->apellido }}</td>                                                       
                            <td style="font-size: 16px;color: #000;font-weight: bold"><span
                                    id="prom">{{ $i->pro_total }}</span>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($consulta as $ite)
                        <tr>
                            <td>{{ $ite->id }}</td>
                            <td>{{ $ite->dni }}</td>
                            <td>{{ $ite->name . ' ' . $ite->apellido }}</td>                            
                            <td style="font-size: 16px;color: #000;font-weight: bold"><span
                                    id="prom">--</span>
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
