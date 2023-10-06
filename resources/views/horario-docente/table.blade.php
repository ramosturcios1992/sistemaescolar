@extends('layouts/app')
@section('titulo', 'Mis cursos')
@section('content')
    @if (Auth::user()->tipo == 2)

        <div class="col-lg-12">
            <h3 class="text-center">MIS CURSOS</h3>            
            <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
                <thead class="bg-primary">
                    <tr>
                        <th>
                            Grado y Sección
                        </th>
                        <th>
                            Curso
                        </th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sql as $i)
                        <tr>
                            <td>{{ $i->grado."  ".$i->nom_seccion }}</td>
                            <td>{{ $i->nombre }}</td>
                        </tr>
                    @endforeach                    
                </tbody>
            </table>

        </div>

      
    @endif
@endsection
