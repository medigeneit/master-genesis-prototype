<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <title>{{ $title ?? 'Master Genesis Prototype v1' }}</title>
        @vite('resources/css/app.css')
    </head>
    <body>

        <div id="app">
            <main>
                {{ $slot }}
            </main>
        </div>

        @yield('scripts')

    </body>
</html>
<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

