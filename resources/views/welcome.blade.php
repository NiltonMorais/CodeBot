<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
        <script>
            window.Laravel = {!! json_encode([
                'crsfToken' => csrf_token()
            ]) !!}
        </script>
    </head>
    <body>
        <nav id="main-nav">
            <div class="nav-wrapper container-fluid grey darken-4">
                <div class="row">
                    <div class="col s12">
                        <a href="#/" class="brand-logo"><i class="material-icons">chat</i>ChatBot</a>

                        <ul class="right hide-on-med-and-down">
                            <li>
                                <a id="nav-mobile" href="#" data-activates="slide-out" class="menu"><i class="material-icons">menu</i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <ul id="slide-out" class="side-nav">
            <li>
                <div class="userView">
                    <div class="background"><img src="img/leaf_background.jpg" alt="background"></div>
                    <a><img src="https://secure.gravatar.com/avatar/0d2ed3be2bf553a1a36e8645310156f0" alt="Avatar" class="circle"></a>
                    <a><span class="white-text name">Nilton Morais</span></a>
                    <a href="https://github.com/NiltonMorais"><span class="white-text email">@NiltonMorais</span></a>
                </div>
            </li>
        </ul>

       <div id="app">
       </div>

       <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script>
            $('#nav-mobile').sideNav();
        </script>
       <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>
