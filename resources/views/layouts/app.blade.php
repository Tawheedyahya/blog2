<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <script src="{{ asset('js/common.js') }}?v=1"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            transition: background-color 0.3s, color 0.3s;
        }

        /* Light Mode */
        body.light-mode {
            background-color: #ffffff;
            color: #000000;
        }

        .navbar.light-mode {
            background-color: #ffffff !important;
        }

        /* Dark Mode */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .navbar.dark-mode {
            background-color: #1f1f1f !important;
        }

        /* Elements affected in dark mode */
        body.dark-mode a,
        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4,
        body.dark-mode h5,
        body.dark-mode h6,
        body.dark-mode p,
        body.dark-mode label,
        body.dark-mode span {
            color: #e0e0e0 !important;
        }

        body.dark-mode .card,
        body.dark-mode .form-control,
        body.dark-mode input,
        body.dark-mode textarea,
        body.dark-mode select {
            background-color: #1e1e1e;
            color: #ffffff;
            border-color: #444;
        }

        body.dark-mode .dropdown-menu {
            background-color: #2c2c2c;
            color: #ffffff;
        }

        body.dark-mode .btn {
            background-color: #333;
            color: #fff;
            border-color: #555;
        }

        .mode-toggle {
            cursor: pointer;
            font-size: 1rem;
            margin-left: 15px;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <h2 class="me-2">Posts</h2>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link mode-toggle" id="modeToggle">🌙 Dark Mode</span>
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.getElementById('modeToggle');
            const body = document.body;
            const navbar = document.querySelector('.navbar');

            let mode = localStorage.getItem('mode') || 'light';
            applyMode(mode);

            toggle.addEventListener('click', function () {
                mode = (mode === 'light') ? 'dark' : 'light';
                localStorage.setItem('mode', mode);
                applyMode(mode);
            });

            function applyMode(mode) {
                if (mode === 'dark') {
                    body.classList.add('dark-mode');
                    body.classList.remove('light-mode');
                    navbar.classList.add('dark-mode');
                    navbar.classList.remove('light-mode');
                    toggle.textContent = '☀️ Light Mode';
                } else {
                    body.classList.add('light-mode');
                    body.classList.remove('dark-mode');
                    navbar.classList.add('light-mode');
                    navbar.classList.remove('dark-mode');
                    toggle.textContent = '🌙 Dark Mode';
                }
            }
        });
    </script>
</body>

</html>
