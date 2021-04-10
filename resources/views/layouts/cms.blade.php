<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-success bg-success sticky-top">
    <a class="navbar-brand text-white" href="{{ url('/cms') }}">Virtual Machine</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @hasrole('sponsor')

                @foreach (Auth::user()->booth->hotspots->whereNotIn('name',['external-link','contact-us']) as $hotspot)

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('cms.sponsor.assets.index', ['hotspot_id' => $hotspot->id]) }}">{{ $hotspot->name }}</a>
                    </li>
                @endforeach

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('cms.sponsor.links.edit',1) }}">External Links</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('cms.sponsor.contacts.edit',1) }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('cms.questions.index', 'questionnaire_id='. auth()->user()->booth->questionnaire->id) }}">Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('cms.sponsor.visitors.index',1) }}">Visitors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('cms.sponsor.events.index',1) }}">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('cms.sponsor.messages.index',1) }}">Messages</a>
                </li>
            @endhasrole

            @hasrole('admin')
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('cms.event-management.index')}}">Event Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/cms/users">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/cms/booths">Booths</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/cms/questionnaires">Questionnaires</a>
                </li>
            @endhasrole
        </ul>

        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item">
                @if(Auth::check())
                    <a class="btn btn-danger text-white" href="/cms/logout" role="button">Logout</a>
                @else
                    <a class="btn btn-primary text-white" href="/cms/login" role="button">Login</a>
                @endif
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

    <script>$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});</script>
    @yield('js')



</body>
</html>
