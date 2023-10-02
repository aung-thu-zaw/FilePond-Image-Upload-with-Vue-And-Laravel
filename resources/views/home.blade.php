<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">


    <title>Laravel</title>
    @vite('resources/css/app.css')

    <style>
        .container {
            padding: 20px;
        }

        .title {
            color: rgba(0, 0, 0, 0.822);
            width: 100%;
            text-align: center;
            font-family: sans-serif;
            font-size: 1.5rem;
            margin-bottom: 50px;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container">
        <h1 class="title">Filepond Image Upload with Laravel + Vue Js</h1>

        <div id="app">

        </div>
    </div>

    @vite("resources/js/app.js")
</body>

</html>
