<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @include('layouts.head')
    </head>
    <body>
        @include('layouts.navbar')
        @yield('content')

        @include('layouts.javascript')
    </body>
</html>
