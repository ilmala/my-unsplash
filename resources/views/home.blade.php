<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>My Unsplash</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">

        <link href="{{ asset('css/app.css', true) }}" rel="stylesheet">
    </head>
    <body class="antialiased">
        <div id="app" class=""></div>

        <script src="{{ asset('js/app.js', true) }}"></script>
    </body>
</html>
