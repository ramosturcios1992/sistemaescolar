@extends('layouts.app')
@section('titulo', 'Inicio')
@section('content')
    <div style="padding: 20px">
        <div>
            <h2 class="text-center">SISTEMA DE NOTAS ACADEMICAS</h2>
        </div>
        <div class="form-row col-12" style="display: flex;flex-wrap: wrap;margin-top: 30px">

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="background: #00bfa6bb;border-radius: 2px;">
                <div style="display: flex;justify-content: space-between;align-items: center;padding: 19px">
                    <div style="border-right: solid rgb(255, 255, 255) 2px"><img
                            style="min-width: 100px;max-width: 100px;height: 100px;max-height: 100px"
                            src="{{ asset('img/users.svg') }}" alt=""></div>
                    <div
                        style="font-size: 30px;color:  rgb(255, 255, 255);font-weight: bold;background: rgba(0, 0, 0, 0.13);padding: 5px">
                        @foreach ($sql4 as $item)
                            {{ $item->total }}
                        @endforeach
                    </div>
                </div>
                <h4 style="color: white" class="text-center">TODOS LOS USUARIOS</h4>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="background: #ffa6008e;border-radius: 2px;">
                <div style="display: flex;justify-content: space-between;align-items: center;padding: 19px">
                    <div style="border-right: solid rgb(255, 255, 255) 2px"><img
                            style="min-width: 100px;max-width: 100px;height: 100px;max-height: 100px"
                            src="{{ asset('img/admin.svg') }}" alt=""></div>
                    <div
                        style="font-size: 30px;color:  rgb(255, 255, 255);font-weight: bold;background: rgba(0, 0, 0, 0.13);padding: 5px">
                        @foreach ($sql as $item)
                            {{ $item->total }}
                        @endforeach
                    </div>
                </div>
                <h4 style="color: white" class="text-center">ADMINISTRADOR</h4>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="background: #00a2ff94;border-radius: 2px;">
                <div style="display: flex;justify-content: space-between;align-items: center;padding: 19px">
                    <div style="border-right: solid rgb(255, 255, 255) 2px"><img
                            style="min-width: 100px;max-width: 100px;height: 100px;max-height: 100px"
                            src="{{ asset('img/miss.svg') }}" alt=""></div>
                    <div
                        style="font-size: 30px;color:  rgb(255, 255, 255);font-weight: bold;background: rgba(0, 0, 0, 0.13);padding: 5px">
                        @foreach ($sql2 as $item)
                            {{ $item->total }}
                        @endforeach
                    </div>
                </div>
                <h4 style="color: white" class="text-center">DOCENTES</h4>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="background: #cc00ff96;border-radius: 2px;">
                <div style="display: flex;justify-content: space-between;align-items: center;padding: 19px">
                    <div style="border-right: solid rgb(255, 255, 255) 2px"><img
                            style="min-width: 100px;max-width: 100px;height: 100px;max-height: 100px"
                            src="{{ asset('img/student.svg') }}" alt=""></div>
                    <div
                        style="font-size: 30px;color:  rgb(255, 255, 255);font-weight: bold;background: rgba(0, 0, 0, 0.13);padding: 5px">
                        @foreach ($sql3 as $item)
                            {{ $item->total }}
                        @endforeach
                    </div>
                </div>
                <h4 style="color: white" class="text-center">ESTUDIANTES</h4>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="background: #ff000081;border-radius: 2px;">
                <div style="display: flex;justify-content: space-between;align-items: center;padding: 19px">
                    <div style="border-right: solid rgb(255, 255, 255) 2px"><img
                            style="min-width: 100px;max-width: 100px;height: 100px;max-height: 100px"
                            src="{{ asset('img/curso.svg') }}" alt=""></div>
                    <div
                        style="font-size: 30px;color:  rgb(255, 255, 255);font-weight: bold;background: rgba(0, 0, 0, 0.13);padding: 5px">
                        @foreach ($sql5 as $item)
                            {{ $item->total }}
                        @endforeach
                    </div>
                </div>
                <h4 style="color: white" class="text-center">MATERIAS</h4>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="background: #abbe00;border-radius: 2px;">
                <div style="display: flex;justify-content: space-between;align-items: center;padding: 19px">
                    <div style="border-right: solid rgb(255, 255, 255) 2px"><img
                            style="min-width: 100px;max-width: 100px;height: 100px;max-height: 100px"
                            src="{{ asset('img/nota.svg') }}" alt=""></div>
                    <div
                        style="font-size: 13px;color: rgb(255, 255, 255);font-weight: bold;background: rgba(0, 0, 0, 0.13);padding: 5px">
                        @foreach ($sql7 as $item)
                            <p>Max : {{ $item->promedio }}</p>
                        @endforeach
                        @foreach ($sql8 as $item)
                            <p>Min : {{ $item->promedio }}</p>
                        @endforeach
                        @foreach ($sql6 as $item)
                            <p>Pro : {{ $item->promedio }}</p>
                        @endforeach
                    </div>
                </div>
                <h4 style="color: white" class="text-center">NOTAS</h4>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="background: #ff007785;border-radius: 2px;">
                <div style="display: flex;justify-content: space-between;align-items: center;padding: 19px">
                    <div style="border-right: solid rgb(255, 255, 255) 2px"><img
                            style="min-width: 100px;max-width: 100px;height: 100px;max-height: 100px"
                            src="{{ asset('img/seccion.svg') }}" alt=""></div>
                    <div
                        style="font-size: 30px;color:  rgb(255, 255, 255);font-weight: bold;background: rgba(0, 0, 0, 0.13);padding: 5px">

                        @foreach ($sql9 as $item)
                            {{ $item->total }}
                        @endforeach
                    </div>
                </div>
                <h4 style="color: white" class="text-center">SECCION</h4>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="background: #1088008a;border-radius: 2px;">
                <div style="display: flex;justify-content: space-between;align-items: center;padding: 19px">
                    <div style="border-right: solid rgb(255, 255, 255) 2px"><img
                            style="min-width: 100px;max-width: 100px;height: 100px;max-height: 100px"
                            src="{{ asset('img/grado.svg') }}" alt=""></div>
                    <div
                        style="font-size: 30px;color:  rgb(255, 255, 255);font-weight: bold;background: rgba(0, 0, 0, 0.13);padding: 5px">
                        @foreach ($sql10 as $item)
                            {{ $item->total }}
                        @endforeach
                    </div>
                </div>
                <h4 style="color: white" class="text-center">GRADO Y SECCION</h4>
            </div>


        </div>

    </div>
@endsection
