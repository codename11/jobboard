<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/larico.png" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JobBoard') }}</title>

    <!-- Scripts -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include("inc.navbar")

        <main class="py-4 container mainContainer">
            @include("inc.messages")
            @yield('content')
        </main>
        @include("inc.footer")
    </div>

    <script src="/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
