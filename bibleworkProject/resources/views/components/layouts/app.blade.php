<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Bible Search</title>
        @livewireStyles
    </head>
    <body>
        <h1>Bible Search</h1>
        {{ $slot }}
        @livewireScripts
    </body>
</html>
