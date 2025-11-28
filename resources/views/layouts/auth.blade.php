<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auth')</title>

    {{-- ICON --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- VITE --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-cover bg-center flex items-center justify-center"
    style="background-image: url('{{ asset('images/saxon-switzerland-national-park-forest-day-light-green-5k-3840x2160-41.jpg') }}');">

    {{-- Background Overlay Gelap --}}
    <div class="absolute inset-0 bg-black/40"></div>

    {{-- Konten Auth --}}
    <div class="relative z-10 bg-white/20 backdrop-blur-md shadow-xl p-8 rounded-xl w-full max-w-md">
        @yield('content')
    </div>

</body>
</html>
