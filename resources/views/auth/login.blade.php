<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon"
        href="https://media.istockphoto.com/photos/stack-of-books-with-graduation-cap-picture-id175529558?b=1&k=6&m=175529558&s=170667a&w=0&h=LbsOKQrDfPfQjZBMvkoqJHZqvow5weqo-dnPsrsbHJ4=">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('inicio/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>


</head>

<body class="hold-transition login-page">
    <img class="wave" src="{{ asset('inicio/img/wave.png') }}">
    <div class="container">
        <div class="img">
            <img src="{{ asset('inicio/img/bg.svg') }}">
        </div>
        <div class="login-content">
            <form {{ url('/login') }} method="POST">
                @csrf
                <img src="{{ asset('inicio/img/avatar.svg') }}">
                <h2 class="title">BIENVENIDO</h2>

                @if (session('mensaje'))
                    <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                        <small>{{ session('mensaje') }}</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="mb-3">
                    @if ($errors->has('dni'))
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            <small>{{ $errors->first('dni') }}</small>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif
                    @if ($errors->has('password'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <small>{{ $errors->first('password') }}</small>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input type="text" class="input" name="dni" value="{{ old('dni') }}"
                            title="ingrese su nombre de usuario">
                    </div>

                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" id="input" class="input" name="password"
                            title="ingrese su clave para ingresar">
                    </div>

                </div>
                <div class="view">
                    <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
                </div>

                <div class="text-center" style="margin-top: 10px">
                    {{-- <a class="font-italic isai5" href="{{ url('/password/reset') }}">Olvidé mi contraseña</a> --}}
                    {{-- <a class="font-italic isai5"
                        href="{{ url('/register') }}">Registrarse</a> --}}
                </div>
                <button name="btningresar" class="btn" title="click para ingresar" type="submit"><i
                        class="fas fa-sign-in-alt mr-3"></i>INGRESAR</button>
            </form>
        </div>
    </div>


    <script type="text/javascript" src="{{ asset('inicio/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('inicio/js/main2.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>
