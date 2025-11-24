<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login - Sistema de Estoque' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/modern-theme.css') }}">
    @livewireStyles
</head>

<body class="relative min-h-screen flex items-center justify-center p-4 overflow-hidden"
    style="font-family: 'Inter', sans-serif;">
    <!-- Animated Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500"></div>

    <!-- Animated Shapes -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-80 h-80 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-40 -right-40 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 1s;"></div>
        <div class="absolute -bottom-40 left-1/3 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 2s;"></div>
    </div>

    <!-- Content -->
    <div class="w-full max-w-md relative z-10">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>
