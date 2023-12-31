<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #0a4293;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            body {
                height: 100%;
                margin: 0;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-image: linear-gradient(#b1ccea, #98b8df, #638dc9);
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 70px;
            }

            .links > a {
                color: #0a4293;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 10px;
            }

            .subtitle{
                font-size: 25px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @endauth
                </div>
            @endif

            <div class="content" style="background-color:#bfe8ff; padding:20px; border-radius: 10px; border:1px solid #0a4293">
                <div class="title" style="line-height:70px">
                <h5 style="font-weight:bold">PENGADILAN TINGGI AGAMA</h5>
                <h5 style="font-weight:bold">PAPUA BARAT</h5>
                    <img src="public/images/new logo.png" style="width:250px"><br>
                    <span style="font-weight:bold; font-size: 50px">Siperlatin <span class="badge badge-danger" style="font-size:15px;">v 1.1</span></span><br>
                </div>
                <div style="font-weight:bold; font-size: 15px"><b>Sistem Perawatan Peralatan dan Mesin</b></div>
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm btn-block" role="button" style="margin-top:10px">Login</a>
                <!--<div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>-->
            </div>
        </div>
    </body>
</html>
