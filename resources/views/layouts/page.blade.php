<html>

<head>
    <title>Globetrotters - @yield('title')</title>
    @section('head')
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Lobster&family=Work+Sans:ital,wght@0,100;0,400;0,500;0,600;1,100;1,400;1,500;1,600&display=swap"
            rel="stylesheet">
        <script src="{{ asset('javascript/sandwich_btn.js') }}" defer></script>
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    @show
</head>

<body>
    <header id="navbar">
        <a href="/home" id="title_link">
            <img src="{{ asset('img/world.svg') }}" id="logo">
            <div id="title">
                Globetrotters
            </div>
        </a>

        <div id="link-group">
            <a href="/home" class="tabs">
                <i class="fi fi-rr-house-blank"></i>
                Home
            </a>

            <a href="/article_list" class="tabs">
                <i class="fi fi-rr-plane"></i>
                Articoli
            </a>

            <a href="/article_writing" class="tabs">
                <i class="fi fi-rr-pen-nib"></i>
                Scrivi un articolo
            </a>

            <a href="/profile/{{ session('username') }}" class="tabs">
                <i class="fi fi-rr-user"></i>
                {{ $username }}
            </a>

            <a id="logout_btn" href="/logout">
                Logout
            </a>
        </div>

        <div id="sandwich_btn">
            <i class="fi fi-rr-settings-sliders"></i>
        </div>

    </header>

    <div id="sandwich_container" class="hidden">
        <div id="sandwich">
            <a href="/home" class="tabs">
                <i class="fi fi-rr-house-blank"></i>
                Home
            </a>

            <a href="/article_list" class="tabs">
                <i class="fi fi-rr-plane"></i>
                Articoli
            </a>

            <a href="/article_writing" class="tabs">
                <i class="fi fi-rr-pen-nib"></i>
                Scrivi un articolo
            </a>

            <a href="/profile/{{ session('username') }}" class="tabs">
                <i class="fi fi-rr-user"></i>
                {{ $username }}
            </a>

            <a id="logout_btn" href="/logout">
                Logout
            </a>
        </div>
    </div>

    @section('page')
    @show

    <footer>
        Made by Daniele S. Cardullo - 1000014469 <a href="https://github.com/dan-crdll"><img
                src="{{ asset('img/github.png') }}"></a>
    </footer>
</body>

</html>
