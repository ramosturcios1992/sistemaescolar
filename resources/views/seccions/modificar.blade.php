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
                <h3 class="text-center" style="margin-bottom: 35px">MODIFICAR SECCION</h3>
                <form action="{{ route('seccions.update') }}" method="POST">
                    @csrf
                    <input hidden type="text" value="{{ $i->id_seccion }}" name="id">
                    <div>
                        @error('seccion')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="text" id="seccion" placeholder="Sección" name="seccion" value="{{ $i->seccion }}">
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('seccions.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                        <button type="submit" class="btn btn-primary">GUARDAR</button>
                    </div>
                </form>
            @endforeach
        </div>


    @endif
@endsection
