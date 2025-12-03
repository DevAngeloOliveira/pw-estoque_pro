<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistema de Gestão</title>
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
    <link rel="stylesheet" href="{{ asset('css/modern-theme.css') }}">
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
        class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
    </div>

    <!-- Animated Shapes -->
    <div class="absolute inset-0 overflow-hidden">
        <div
            class="absolute top-20 left-20 w-72 h-72 bg-white/10 dark:bg-indigo-500/10 rounded-full blur-3xl animate-pulse">
        </div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-white/10 dark:bg-purple-500/10 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-white/5 dark:bg-pink-500/10 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 2s;"></div>
    </div>

    <!-- Content -->
    <div class="max-w-md w-full relative z-10">
        <div class="modern-card overflow-hidden animate-fadeInUp dark:bg-gray-800">
            <!-- Modern Header with Gradient -->
            <div class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600"></div>
                <div class="absolute inset-0 opacity-20"
                    style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;0.4&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
                </div>
                <div class="relative p-8 text-center">
                    <div
                        class="w-24 h-24 bg-white/20 backdrop-blur-lg rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-2xl">
                        <i class="fas fa-shield-alt text-white text-5xl"></i>
                    </div>
                    <h2 class="text-4xl font-black text-white tracking-tight">Admin Dashboard</h2>
                    <p class="text-white/90 mt-2 font-medium">Acesso restrito ao sistema</p>
                </div>
            </div>

            <!-- Modern Form -->
            <div class="p-8 dark:bg-gray-800">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white">Área Administrativa</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Faça login com suas credenciais</p>
                </div>

                <!-- Errors -->
                @if ($errors->any())
                    <div
                        class="mb-6 p-4 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-2xl shadow-lg animate-fadeInUp">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-exclamation-circle text-xl"></i>
                            </div>
                            <p class="font-semibold">{{ $errors->first() }}</p>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            E-mail Administrativo
                        </label>
                        <div class="relative">
                            <div
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="input-modern w-full pl-20 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="admin@sistema.com" required autofocus>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Senha
                        </label>
                        <div class="relative">
                            <div
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-lock text-white"></i>
                            </div>
                            <input type="password" id="password" name="password"
                                class="input-modern w-full pl-20 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="••••••••" required autocomplete="current-password">
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-5 h-5 text-indigo-600 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-4 focus:ring-indigo-200 dark:bg-gray-700">
                        <label for="remember"
                            class="ml-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Manter-me
                            conectado</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="btn-modern w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Acessar Painel Admin
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span
                                class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-medium">Retornar</span>
                        </div>
                    </div>
                    <a href="{{ route('welcome') }}"
                        class="mt-4 inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 border-2 border-gray-200 dark:border-gray-600 hover:border-indigo-600 dark:hover:border-indigo-400 text-gray-700 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 font-bold rounded-xl transition-all duration-300 hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Voltar ao site
                    </a>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 mt-4 text-white text-center">
            <p class="text-sm">
                <i class="fas fa-info-circle mr-2"></i>
                Apenas administradores autorizados podem acessar esta área
            </p>
        </div>
    </div>
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
