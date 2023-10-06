<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Académico</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;

        }

        .portada {
            background-image: url("{{ asset('img/portada.webp') }}");
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .menu {
            position: absolute;
            bottom: 100px;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .menu a {
            font-size: 15px;
            text-decoration: none;
            color: #fff;
            background: rgb(0, 113, 179);
            padding: 10px 80px;
            border-radius: 40px;
        }

        .menu a:hover {
            background: rgb(0, 155, 245);
        }

        .efecto {
            width: 100%;
            height: 100vh;
            position: absolute;
            background: rgba(0, 0, 0, 0.774);
        }

        .group-titulo {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            font-size: 60px;
            text-align: center;
            color: #fff;
            letter-spacing: 8px;
            transition: all 3s;
            font-weight: normal;
        }

        .encabezado {
            position: absolute;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 35px 30px 40px;
            z-index: 2000;
        }

        .encabezado h4 {
            color: rgba(255, 255, 255, 0.514);
            font-size: 20px;
        }

        .encabezado a {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.473);
            margin: 20px;
            padding: 20px;
        }

        .encabezado a:hover {
            color: rgb(255, 255, 255);
            border-bottom: solid rgba(255, 255, 255, 0.116) 2px;
        }

        .encabezado li {
            list-style: none;
        }

        @media screen and (max-width: 765px) {
            h1.titulo {
                letter-spacing: 10px;
                font-size: 38px;
            }
        }

        @media screen and (max-width: 540px) {
            h1.titulo {
                letter-spacing: 10px;
                font-size: 30px;
            }

            .encabezado nav {
                display: none;
            }

            .encabezado div {
                margin: auto;
            }
        }

        @media screen and (max-width: 400px) {
            h1.titulo {
                letter-spacing: 10px;
                font-size: 20px;
            }

            .menu a {
                padding: 10px 50px;
            }

            .encabezado nav {
                display: none;
            }

            .encabezado div {
                margin: auto;
            }
        }

    </style>
</head>

<body>
    <section>
        <div class="efecto"></div>
        <section class="portada">
        </section>
        <header class="encabezado">
            <div>
                <h4>{{$empresa}}</h4>
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="#">Acerca de</a>
                        <a href="#">Nosotros</a>
                        <a href="#">servicios</a>
                    </li>
                </ul>
            </nav>
        </header>
        <div class="group-titulo">
            <h1 class="titulo">SISTEMA DE NOTAS <br> ACADEMICOS</h1>
        </div>
        <div class="flex-center position-ref full-height menu">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;Pagina de inicio</a>
                    @else
                        <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;&nbsp;Acceder al
                            sistema</a>
                    @endauth
                </div>
            @endif
        </div>
    </section>

</body>

</html>
