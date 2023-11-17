<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ferreteria Galba</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script>
        const now = new Date();
        const currentHour = now.getHours();
        if (currentHour < 6 || currentHour >= 18) {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            }
        }
    </script>
    <script src="{{ asset('js/validaciones.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @livewireScripts
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
        }

        aside {
            background-color: #333;
            color: #fff;
        }

        body,
        div,
        table,
        nav,
        aside,
        form,
        #formulario {
            font-size: 1.0rem;
        }
    </style>
</head>

<body class="font-montserrat antialiased">
    <div class="p-4 sm:ml-64 ">
        <div class="p-4 mt-14 ">
            {{ $slot }}
        </div>
    </div>
    <div class="flex justify-end p-4 font-semibold text-sm">
        Visitas: @stack('visitas')
    </div>

    @stack('modals')
    @stack('scripts')
</body>

</html>
