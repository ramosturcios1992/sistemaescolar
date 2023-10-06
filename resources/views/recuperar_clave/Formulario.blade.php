<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <link href="{{asset('notify/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- PNotify -->
    <link href="{{asset('notify/css/pnotify.css')}}" rel="stylesheet" />
    <link href="{{asset('notify/css/pnotify.buttons.css')}}" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="{{asset('notify/css/custom.min.css')}}" rel="stylesheet" />
    <!-- SCRIPTS PARA NOTIFICACION -->
    <!-- jQuery -->
    <script src="{{asset('notify/js/jquery.min.js')}}">
    </script>
    <!-- PNotify -->
    <script src="{{asset('notify/js/pnotify.js')}}">
    </script>
    <script src="{{asset('notify/js/pnotify.buttons.js')}}">
    </script>


</head>

<body>
    @if (session('correcto'))
        <script>
            $(function notificacion() {
                new PNotify({
                    title: 'MODIFICADO',
                    type: 'success',
                    text: "{{ session('correcto') }}",
                    styling: 'bootstrap3'
                })
            })

        </script>
    @endif
    @if (session('incorrecto'))
        <script>
            $(function notificacion() {
                new PNotify({
                    title: 'ERROR',
                    type: 'error',
                    text: "{{ session('incorrecto') }}",
                    styling: 'bootstrap3'
                })
            })

        </script>
    @endif
    @if (session('error-clave'))
        <script>
            $(function notificacion() {
                new PNotify({
                    title: 'ERROR',
                    type: 'error',
                    text: "{{ session('error-clave') }}",
                    styling: 'bootstrap3'
                })
            })

        </script>
    @endif
    <section class="container-fluid mt-5">
        <h3 class="text-center text-secondary">RESTABLECER CONTRASEÑA</h3>
        <div class="alert alert-info alert-dismissible fade show col-12 col-md-6 m-auto" role="alert">
            <strong>Le recomendamos utilizar una contraseña que pueda recordarlo.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <hr>
        <form class="" action="{{ route('mail.recuperar') }}" method="POST">
            @csrf
            <div class="form-row col-12 d-flex flex-column">
                <input class="form-control" type="hidden" value="{{ $correo }}" name="txtcorreo" />
                <div class="col-12 col-md-6 m-auto">
                    <input class="form-control  mt-2" type="password" name="clave2" placeholder="Contraseña nueva"
                        value="{{ old('clave2') }}">
                    @error('clave2')
                        <small class="text-danger">*{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-12 col-md-6 m-auto">
                    <input class="form-control mt-3" type="password" name="clave3"
                        placeholder="Repita la contraseña nueva" value="{{ old('clave3') }}">
                    @error('clave3')
                        <small class="text-danger">*{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-md-6 m-auto">
                    <button class="btn btn-success mt-2" type="submit" name="btnrestablecer" value="ok">
                        <i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Restablecer</button>
                    <a href="{{ route('inicio') }}" class="btn btn-info mt-2" name="btnmodifiar">
                        <i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;&nbsp;Iniciar Sesión</a>
                </div>
            </div>
        </form>
        <div class="col-12 col-md-6 m-auto">
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>
