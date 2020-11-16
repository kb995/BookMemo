<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('./css/app.css' )}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">{{-- toastr --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">{{-- fontawesome --}}

    @yield('styles')
</head>

<body>
    @include('layouts.header')

    <main id="app">
        @yield('content')
    </main>

    @yield('scripts')

    <script src="{{ asset('/js/common.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>{{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>{{-- torstr --}}
    <script>
        @if (session('flash_message'))
            $(function () {
                    toastr.success('{{ session('flash_message') }}');
            });
        @endif
    </script>
</body>
</html>
