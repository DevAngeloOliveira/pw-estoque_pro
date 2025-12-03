<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login - Sistema de Estoque' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <script>
        // Aplicar tema ANTES de qualquer renderização
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
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

<body class="relative min-h-screen flex items-center justify-center p-4 overflow-hidden dark:bg-gray-900"
    style="font-family: 'Inter', sans-serif;">
    <!-- Dark Mode Toggle -->
    <button id="theme-toggle"
        class="absolute top-4 right-4 z-50 p-2 rounded-full bg-white/10 backdrop-blur-lg text-white hover:bg-white/20 transition-all duration-300 focus:outline-none">
        <i id="theme-toggle-dark-icon" class="fas fa-moon hidden"></i>
        <i id="theme-toggle-light-icon" class="fas fa-sun hidden"></i>
    </button>

    <!-- Animated Background -->
    <div
        class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
    </div>

    <!-- Animated Shapes -->
    <div class="absolute inset-0 overflow-hidden">
        <div
            class="absolute -top-40 -left-40 w-80 h-80 bg-white/10 dark:bg-indigo-500/10 rounded-full blur-3xl animate-pulse">
        </div>
        <div class="absolute top-40 -right-40 w-96 h-96 bg-white/10 dark:bg-purple-500/10 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 1s;"></div>
        <div class="absolute -bottom-40 left-1/3 w-72 h-72 bg-white/10 dark:bg-pink-500/10 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 2s;"></div>
    </div>

    <!-- Content -->
    <div class="w-full max-w-md relative z-10">
        {{ $slot }}
    </div>

    @livewireScripts
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('theme')) {
                if (localStorage.getItem('theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
        });
    </script>
</body>

</html>
