<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dona Tiempo - {{ $title }}</title>
    <meta name="author" content="Vicente Anton">
    <meta name="description" content="{{ $metaDescription }}">


    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>

<body class="bg-white font-family-karla">


    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
                Dona Tiempo
            </a>
            <p class="text-lg text-gray-600">
                Web de servicios colaborativos
            </p>
        </div>
    </header>
    @if(session('status'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="w-full pl-3 py-1 bg-green-200 text-white">
        {{session('status')}}
    </div>
    @endif
    @if(isset($title) && $title!='Errores')
    <x-partials.navigation :$categories :$notification :$cities />
    @endif
    <div class="container mx-auto flex flex-wrap py-6">


        {{ $slot }}
        @if(isset($title) && $title!='Errores')
        @if(!str_contains(Request::fullUrl(),'/profile'))
        <x-sidebar />
        @endif
        @endif

    </div>
    <footer class="w-full border-t bg-white pb-12">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="uppercase py-6">&copy; DonaTiempo.es</div>
        </div>
    </footer>

</body>

</html>