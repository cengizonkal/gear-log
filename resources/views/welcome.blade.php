<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gearlog</title>

    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <h1 class="text-4xl lg:text-6xl font-bold text-center mb-4">
            Welcome to Gear Log
        </h1>
        <a href="{{ url('docs/api') }}">Api Documentation</a>
    </body>
</html>
