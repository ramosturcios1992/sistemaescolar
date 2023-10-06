{{-- @extends('layouts/app')
@section('titulo', 'Modificar Semestre')
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
                <h3 class="text-center" style="margin-bottom: 35px">MODIFICAR TIPO DE USUARIO</h3>
                <form action="{{ route('semestres.update') }}" method="POST">
                    @csrf
                    <input hidden type="text" value="{{ $i->id_semestre }}" name="id">
                    <div>
                        @error('semestre')
                            <small>*{{ $message }}</small>
                        @enderror
                        <input type="text" id="semestre" placeholder="Semestre" name="semestre" value="{{ $i->semestre }}">
                    </div>
                    <div class="form-row col-12">
                        @error('año')
                            <small>*{{ $message }}</small>
                        @enderror
                        <select name="año" id="año">
                            {{ $año = date('yy') }}
                            @for ($item = $año; $año <= 2025; $año++)
                                <option {{ $i->año == $año ? 'selected' : '' }} value="{{ $año }}">{{ $año }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('semestres.index') }}" class="btn btn-secondary" data-dismiss="modal">ATRAS</a>
                        <button type="submit" class="btn btn-primary">GUARDAR</button>
                    </div>
                </form>
            @endforeach
        </div>
    @endif

@endsection --}}
