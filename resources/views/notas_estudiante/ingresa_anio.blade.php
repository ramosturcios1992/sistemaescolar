@extends('layouts/app')
@section('titulo', 'Lista Notas')
@section('content')
@if (Auth::user()->tipo == 3)
<div>
    <div class="panel panel-info bg-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <h4>DEBES SELECCIONAR EL AÑO CORRESPONDIENTE...</h4>
            <div style="text-align: center" class="panel-body">
                @foreach ($anio as $item)
                <a style="margin: 3px; padding:20px 40px;font-size:20px" class="btn btn-primary"
                    href="{{ route('notasEstudiante.index', [$item->año]) }}">{{$item->año}}</a>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endif
@endsection