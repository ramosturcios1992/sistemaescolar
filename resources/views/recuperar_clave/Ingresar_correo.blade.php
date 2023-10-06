@extends('layouts/inicio')
@section('titulo', 'Ingresar Correo')
@section('contenido')
    @if (session('ERROR'))
        <script>
            $(function(){
                new PNotify({
                    'title':'ERROR',
                    'type':'error',
                    'text':"{{session('ERROR')}}",
                    'styling':'bootstrap3'
                })
            })
        </script>
    @endif
    @if (session('error-codigo'))
        <script>
            $(function(){
                new PNotify({
                    'title':'ERROR',
                    'type':'error',
                    'text':"{{session('error-codigo')}}",
                    'styling':'bootstrap3'
                })
            })
        </script>
    @endif
    @if (session('error-correo'))
        <script>
            $(function(){
                new PNotify({
                    'title':'ERROR',
                    'type':'error',
                    'text':"{{session('error-correo')}}",
                    'styling':'bootstrap3'
                })
            })
        </script>
    @endif
    <section class="container-fluid mt-5">
        <h3 class="text-center">VALIDAR DATOS PARA RESTABLECER LA CONTRASEÑA</h3>
        <hr>        
        <form class="mb-3" action="{{ route('mail.actualizar') }}" method="POST">
            @csrf
            @method('get')
            <div class="form-row col-12 d-flex flex-column">
                <div class="ol-12 col-md-6 m-auto">
                    <h4 class="font-italic">Paso 01...</h4>
                    <label class="text-secondary font-weight-bold">Ingrese el correo</label>
                    <input class="form-control" type="mail" placeholder="Correo" value="{{ old('txtusuario') }}"
                        name="txtusuario" />
                    @error('txtusuario')
                        <small class="text-danger">*{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-12 col-md-6 m-auto">
                    <button class="btn btn-success mt-3" type="submit" name="btnenviarusuario" value="ok"><i
                            class="fas fa-share-square"></i>&nbsp;&nbsp;&nbsp;Enviar</button>
                    <a href="../login2/Login.php" class="btn btn-warning mt-3" name="btnmodifiar">
                        <i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;&nbsp;Salir e iniciar Sesión</a>
                </div>
            </div>
        </form>
    </section>

    
@endsection
