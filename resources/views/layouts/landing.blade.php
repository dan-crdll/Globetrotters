<html>

<head>
    <title>Globetrotters - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/landing_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lobster&family=Work+Sans:ital,wght@0,100;0,400;0,500;0,600;1,100;1,400;1,500;1,600&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <script src="{{ asset('javascript/error_check.js') }}" defer></script>
</head>

<body>
    <div id="container">
        <div id="left_container">

        </div>
        <div id="right_container">
            <div id="title">Globetrotters</div>
            <div id="signup_container" class="form_container">
                <div class="section_title">
                    @yield('message')
                </div>

                @section('errors')
                @show

                @section('form')
                    form
                @show

                @section('to_other_link')
                @show
            </div>
        </div>
    </div>
</body>

</html>
