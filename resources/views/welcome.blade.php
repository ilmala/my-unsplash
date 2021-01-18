<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Unsplash</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-gray-100 antialiased">
        <div id="app" class="">
            <h1 class="text-4xl text-gray-700">My Unsplash</h1>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
