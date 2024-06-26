<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    @yield('styles')

    <!-- Scripts -->
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <a class="navbar-brand" href="{{ url('/list-user') }}">
                    Kênh chat
                </a>
                <a class="navbar-brand" href="{{ url('/board') }}">
                    Quản lí công việc
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@yield('scripts')
<script>
    /* Custom Dragula JS */
    // dragula([
    //     document.getElementById("to-do"),
    //     document.getElementById("doing"),
    //     document.getElementById("done"),
    //     document.getElementById("trash")
    // ]);
    // removeOnSpill: false
    //     .on("drag", function(el) {
    //         el.className.replace("ex-moved", "");
    //     })
    //     .on("drop", function(el) {
    //         el.className += "ex-moved";
    //     })
    //     .on("over", function(el, container) {
    //         container.className += "ex-over";
    //     })
    //     .on("out", function(el, container) {
    //         container.className.replace("ex-over", "");
    //     });

    // /* Vanilla JS to add a new task */
    // function addTask() {
    //     /* Get task text from input */
    //     var inputTask = document.getElementById("taskText").value;
    //     /* Add task to the 'To Do' column */
    //     document.getElementById("to-do").innerHTML +=
    //         "<li class='task'><p>" + inputTask + "</p></li>";
    //     /* Clear task text from input after adding task */
    //     document.getElementById("taskText").value = "";
    // }

    // /* Vanilla JS to delete tasks in 'Trash' column */
    // function emptyTrash() {
    //     /* Clear tasks from 'Trash' column */
    //     document.getElementById("trash").innerHTML = "";
    // }
</script>

</html>
