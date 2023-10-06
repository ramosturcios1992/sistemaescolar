@extends('layouts/app')
@section('titulo', 'Modificar Sección')
@section('content')
    @if (Auth::user()->tipo == 1)
        @if (session('correcto'))
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'CORRECTO',
                        type: 'success',
                        text: "{{ session('correcto') }}",
                        styling: 'bootstrap3'
                    });
                })

            </script>
        @endif
        @if (session('incorrecto'))
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ERROR',
                        type: 'warning',
                        text: "{{ session('incorrecto') }}",
                        styling: 'bootstrap3'
                    });
                })

            </script>
        @endif

        @if (session('duplicado'))
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ERROR',
                        type: 'warning',
                        text: "{{ session('duplicado') }}",
                        styling: 'bootstrap3'
                    });
                })

            </script>
        @endif


        <!-- Modal actualizar-->

        <div id="modal-edit">
            @foreach ($sql as $i)
                <h3 class="text-center" style="margin-bottom: 35px">MODIFICAR GRADO Y SECCION</h3>
                <form action="{{ route('grados.update') }}" method="POST">
                    @csrf
                    <input hidden type="text" value="{{ $i->id_grado }}" name="id">
                    <div>
                        @error('grado')
                            <small>*{{ $message }}</small>
                        @enderror
                        <select name="grado" id="grado">
                            <option value="">Seleccionar grado...</option>
                            @for ($it = 1; $it <= 6; $it++)
                                <option {{ $it . '°' == $i->grado ? 'selected' : '' }} value="{{ $it . '°' }}">
                                    {{ $it . ' °' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-row col-12">
                        @error('seccion')
                            <small>*{{ $message }}</small>
                        @enderror
                        <select name="seccion" id="seccion">
                            @foreach ($sql2 as $item)
                                <option {{ $i->seccion == $item->id_seccion ? 'selected' : '' }}
                                    value="{{ $item->id_seccion }}">{{ $item->seccion }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="modal-footer">
                        <a href="{{ route('grados.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                        <button type="submit" class="btn btn-primary">GUARDAR</button>
                    </div>
                </form>
            @endforeach
        </div>
    @endif

@endsection
