<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('./css/app.css' )}}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    {{-- @include('layouts.header') --}}

    <main>
        @yield('content')
    </main>

    {{-- @yield('scripts') --}}

</body>
</html>
