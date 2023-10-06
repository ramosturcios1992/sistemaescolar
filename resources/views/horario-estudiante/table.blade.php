@extends('layouts/app')
@section('titulo', 'Mis cursos')
@section('content')
    @if (Auth::user()->tipo == 3)

        <div class="col-lg-12">
            <h3 class="text-center">MIS CURSOS</h3>            
            <table class="table table-bordered table-responsive table-hover" id="example" width="100%">
                <thead class="bg-primary">
                    <tr>
                        <th>
                            Curso
                        </th>                                               
                        <th>Docente
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sql as $i)
                        <tr>
                            <td>{{ $i->nombre }}</td>
                            <td>{{ $i->name." ".$i->apellido}}</td>
                        </tr>
                    @endforeach                    
                </tbody>
            </table>

        </div>

      
    @endif
@endsection
