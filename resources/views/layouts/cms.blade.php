<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title>Content Management</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-success bg-success sticky-top">
    <a class="navbar-brand text-white" href="{{ url('/cms') }}">BRAND NAME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="{{ url('/cms/assets') }}">Assets <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Banner</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Brochures</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">External Links</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Quiz</a>
            </li>
        </ul>

        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item">
                <a class="btn btn-primary text-white" href="#" role="button">Login</a>
            </li>
        </ul>

        <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
    </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- <script src="{{ mix('js/app.js') }}"></script> -->
</body>
</html>