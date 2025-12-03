<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque Pro - Sistema de Gestão Multi-Empresas</title>
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
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(5deg);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .slide-in-left {
            animation: slideInLeft 1s ease-out forwards;
        }

        .slide-in-right {
            animation: slideInRight 1s ease-out forwards;
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-bg-animated {
            background: linear-gradient(270deg, #667eea, #764ba2, #f093fb, #4facfe);
            background-size: 800% 800%;
            animation: gradientShift 15s ease infinite;
        }

        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-12px) scale(1.02);
        }

        .glass-effect {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body
    class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
    <!-- Modern Navbar -->
    <nav
        class="fixed w-full glass-effect dark:bg-gray-900/95 dark:border-gray-800 shadow-lg z-50 border-b border-gray-100 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-boxes text-white text-2xl"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">Estoque
                            Pro</span>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Sistema de Gestão</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <button id="theme-toggle"
                        class="p-2 rounded-xl text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none transition-colors duration-300 mr-2">
                        <i id="theme-toggle-dark-icon" class="fas fa-moon hidden"></i>
                        <i id="theme-toggle-light-icon" class="fas fa-sun hidden"></i>
                    </button>
                    <a href="{{ route('login') }}"
                        class="px-6 py-2.5 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-bold transition-all duration-300 rounded-xl hover:bg-indigo-50 dark:hover:bg-gray-800">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}"
                        class="btn-modern bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-xl hover:shadow-2xl">
                        <i class="fas fa-rocket mr-2"></i>Começar Agora
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 px-4 overflow-hidden">
        <!-- Background decorations -->
        <div
            class="absolute top-20 right-0 w-96 h-96 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-full blur-3xl opacity-20 animate-pulse">
        </div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full blur-3xl opacity-20 animate-pulse"
            style="animation-delay: 1s;"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="slide-in-left">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-200 rounded-full mb-6">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                        <span class="text-sm font-bold text-indigo-700">Novo: Dashboard Analytics Avançado 🚀</span>
                    </div>

                    <h1 class="text-6xl lg:text-7xl font-black text-gray-900 dark:text-white mb-6 leading-tight">
                        Gestão de Estoque
                        <span class="gradient-text block mt-2">Inteligente e Eficiente</span>
                    </h1>

                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed font-medium">
                        Sistema completo para gerenciar múltiplas empresas, produtos e movimentações de estoque com
                        <span class="text-indigo-600 dark:text-indigo-400 font-bold">relatórios em tempo real</span> e
                        <span class="text-purple-600 dark:text-purple-400 font-bold">análises detalhadas</span>.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <a href="{{ route('register') }}"
                            class="btn-modern bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-lg shadow-2xl hover:shadow-indigo-500/50 group">
                            <i class="fas fa-rocket mr-2 group-hover:rotate-45 transition-transform"></i>
                            Começar Gratuitamente
                        </a>
                        <a href="#features"
                            class="btn-modern bg-white dark:bg-gray-800 text-gray-700 dark:text-white border-2 border-gray-200 dark:border-gray-700 hover:border-indigo-600 hover:text-indigo-600 dark:hover:text-indigo-400 text-lg">
                            <i class="fas fa-play-circle mr-2"></i>
                            Saiba Mais
                        </a>
                    </div>

                    <div class="flex flex-wrap gap-6 text-sm">
                        <div
                            class="flex items-center px-4 py-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-2 text-lg"></i>
                            <span class="font-semibold text-gray-700 dark:text-gray-300">Sem cartão de crédito</span>
                        </div>
                        <div
                            class="flex items-center px-4 py-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-2 text-lg"></i>
                            <span class="font-semibold text-gray-700 dark:text-gray-300">Configuração em 2
                                minutos</span>
                        </div>
                        <div
                            class="flex items-center px-4 py-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                            <i class="fas fa-shield-alt text-indigo-600 mr-2 text-lg"></i>
                            <span class="font-semibold text-gray-700 dark:text-gray-300">100% Seguro</span>
                        </div>
                    </div>
                </div>

                <div class="slide-in-right relative">
                    <div class="relative float-animation">
                        <!-- Floating elements -->
                        <div
                            class="absolute -top-10 -left-10 w-32 h-32 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl shadow-2xl opacity-80 blur-sm">
                        </div>
                        <div
                            class="absolute -bottom-10 -right-10 w-40 h-40 bg-gradient-to-br from-pink-500 to-orange-500 rounded-3xl shadow-2xl opacity-80 blur-sm">
                        </div>

                        <!-- Main image -->
                        <div
                            class="relative modern-card p-4 bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900">
                            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1200&h=800&fit=crop"
                                alt="Dashboard Preview" class="rounded-2xl shadow-2xl w-full">

                            <!-- Stats overlay -->
                            <div class="absolute top-8 right-8 modern-card bg-white dark:bg-gray-800 p-4 shadow-xl">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-chart-line text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold">Crescimento
                                        </p>
                                        <p class="text-2xl font-black text-gray-900 dark:text-white">+47%</p>
                                    </div>
                                </div>
                            </div>

                            <div class="absolute bottom-8 left-8 modern-card bg-white dark:bg-gray-800 p-4 shadow-xl">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-boxes text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold">Produtos</p>
                                        <p class="text-2xl font-black text-gray-900 dark:text-white">1.2K+</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 gradient-bg-animated relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="fade-in-up text-center">
                    <div
                        class="modern-card bg-white/10 backdrop-blur-lg border border-white/20 p-8 hover:scale-105 transition-transform duration-300">
                        <div
                            class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-building text-white text-3xl"></i>
                        </div>
                        <div class="text-6xl font-black text-white mb-2">1000+</div>
                        <div class="text-white/90 font-semibold text-lg">Empresas Cadastradas</div>
                        <p class="text-white/70 text-sm mt-2">Confiando em nosso sistema</p>
                    </div>
                </div>

                <div class="fade-in-up text-center" style="animation-delay: 0.1s;">
                    <div
                        class="modern-card bg-white/10 backdrop-blur-lg border border-white/20 p-8 hover:scale-105 transition-transform duration-300">
                        <div
                            class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-boxes text-white text-3xl"></i>
                        </div>
                        <div class="text-6xl font-black text-white mb-2">50K+</div>
                        <div class="text-white/90 font-semibold text-lg">Produtos Gerenciados</div>
                        <p class="text-white/70 text-sm mt-2">Inventário controlado</p>
                    </div>
                </div>

                <div class="fade-in-up text-center" style="animation-delay: 0.2s;">
                    <div
                        class="modern-card bg-white/10 backdrop-blur-lg border border-white/20 p-8 hover:scale-105 transition-transform duration-300">
                        <div
                            class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-server text-white text-3xl"></i>
                        </div>
                        <div class="text-6xl font-black text-white mb-2">99.9%</div>
                        <div class="text-white/90 font-semibold text-lg">Uptime</div>
                        <p class="text-white/70 text-sm mt-2">Disponibilidade garantida</p>
                    </div>
                </div>

                <div class="fade-in-up text-center" style="animation-delay: 0.3s;">
                    <div
                        class="modern-card bg-white/10 backdrop-blur-lg border border-white/20 p-8 hover:scale-105 transition-transform duration-300">
                        <div
                            class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-headset text-white text-3xl"></i>
                        </div>
                        <div class="text-6xl font-black text-white mb-2">24/7</div>
                        <div class="text-white/90 font-semibold text-lg">Suporte</div>
                        <p class="text-white/70 text-sm mt-2">Sempre disponível</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-200 dark:border-indigo-700 rounded-full mb-4">
                    <i class="fas fa-star text-indigo-600 dark:text-indigo-400 mr-2"></i>
                    <span class="text-sm font-bold text-indigo-700 dark:text-indigo-300">RECURSOS</span>
                </div>
                <h2 class="text-5xl font-black text-gray-900 dark:text-white mb-6">Recursos Poderosos</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto font-medium">
                    Tudo que você precisa para gerenciar seu estoque com eficiência e inteligência
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="feature-card modern-card p-8 bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-gray-900 border border-blue-100 dark:border-gray-700">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-chart-line text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Relatórios em Tempo Real</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed font-medium">
                        Visualize gráficos e métricas atualizadas instantaneamente sobre entradas, saídas e
                        lucratividade.
                    </p>
                    <div class="mt-6 flex items-center text-blue-600 dark:text-blue-400 font-bold text-sm">
                        <span>Saiba mais</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div
                    class="feature-card modern-card p-8 bg-gradient-to-br from-white to-purple-50 dark:from-gray-800 dark:to-gray-900 border border-purple-100 dark:border-gray-700">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-building text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Multi-Empresas</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed font-medium">
                        Gerencie múltiplas empresas com dados separados e seguros para cada CNPJ cadastrado.
                    </p>
                    <div class="mt-6 flex items-center text-purple-600 dark:text-purple-400 font-bold text-sm">
                        <span>Saiba mais</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div
                    class="feature-card modern-card p-8 bg-gradient-to-br from-white to-green-50 dark:from-gray-800 dark:to-gray-900 border border-green-100 dark:border-gray-700">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-shield-alt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Segurança Avançada</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed font-medium">
                        Autenticação segura por CNPJ com criptografia de senhas e isolamento total dos dados.
                    </p>
                    <div class="mt-6 flex items-center text-green-600 dark:text-green-400 font-bold text-sm">
                        <span>Saiba mais</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div
                    class="feature-card modern-card p-8 bg-gradient-to-br from-white to-red-50 dark:from-gray-800 dark:to-gray-900 border border-red-100 dark:border-gray-700">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-red-500 to-rose-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-bell text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Alertas Inteligentes</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed font-medium">
                        Receba notificações automáticas sobre estoque baixo e movimentações importantes.
                    </p>
                    <div class="mt-6 flex items-center text-red-600 dark:text-red-400 font-bold text-sm">
                        <span>Saiba mais</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div
                    class="feature-card modern-card p-8 bg-gradient-to-br from-white to-yellow-50 dark:from-gray-800 dark:to-gray-900 border border-yellow-100 dark:border-gray-700">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-mobile-alt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Totalmente Responsivo</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed font-medium">
                        Acesse de qualquer dispositivo - desktop, tablet ou smartphone com interface adaptativa.
                    </p>
                    <div class="mt-6 flex items-center text-yellow-600 dark:text-yellow-400 font-bold text-sm">
                        <span>Saiba mais</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div
                    class="feature-card modern-card p-8 bg-gradient-to-br from-white to-indigo-50 dark:from-gray-800 dark:to-gray-900 border border-indigo-100 dark:border-gray-700">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-database text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Backup Automático</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed font-medium">
                        Seus dados protegidos com backups automáticos e recuperação instantânea.
                    </p>
                    <div class="mt-6 flex items-center text-indigo-600 dark:text-indigo-400 font-bold text-sm">
                        <span>Saiba mais</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-24 px-4 overflow-hidden">
        <div class="absolute inset-0 hero-gradient"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <div class="max-w-5xl mx-auto text-center relative z-10">
            <div class="modern-card bg-white/10 backdrop-blur-xl border border-white/20 p-12 lg:p-16">
                <div class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full mb-8">
                    <i class="fas fa-rocket text-white mr-3 text-xl"></i>
                    <span class="text-white font-bold text-lg">Comece Agora</span>
                </div>

                <h2 class="text-5xl lg:text-6xl font-black text-white mb-6 leading-tight">
                    Pronto para revolucionar sua gestão de estoque?
                </h2>

                <p class="text-2xl text-white/90 mb-10 font-medium max-w-3xl mx-auto">
                    Junte-se a <span class="font-black">milhares de empresas</span> que já utilizam o Estoque Pro
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('register') }}"
                        class="btn-modern bg-white text-indigo-600 hover:bg-gray-100 text-xl shadow-2xl group px-12 py-5">
                        <i class="fas fa-rocket mr-2 group-hover:rotate-45 transition-transform"></i>
                        Criar Conta Gratuita
                    </a>
                    <a href="{{ route('login') }}"
                        class="btn-modern bg-white/10 backdrop-blur-sm text-white border-2 border-white/30 hover:bg-white/20 text-xl px-12 py-5">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Já tenho conta
                    </a>
                </div>

                <div class="mt-12 flex flex-wrap justify-center gap-8 text-white/90">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-2xl mr-3"></i>
                        <span class="font-semibold text-lg">Grátis para começar</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-2xl mr-3"></i>
                        <span class="font-semibold text-lg">Sem compromisso</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-2xl mr-3"></i>
                        <span class="font-semibold text-lg">Suporte incluído</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-5 gap-12 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-boxes text-white text-2xl"></i>
                        </div>
                        <div>
                            <span class="text-2xl font-black">Estoque Pro</span>
                            <p class="text-xs text-gray-400">Sistema de Gestão</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed font-medium">
                        Sistema completo de gestão de estoque para múltiplas empresas com relatórios em tempo real.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-black text-lg mb-4 text-white">Produto</h4>
                    <ul class="space-y-3">
                        <li><a href="#features"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Recursos
                            </a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Preços
                            </a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Demonstração
                            </a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Integrações
                            </a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-black text-lg mb-4 text-white">Empresa</h4>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Sobre Nós
                            </a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Blog
                            </a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Contato
                            </a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Carreiras
                            </a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-black text-lg mb-4 text-white">Suporte</h4>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Central de Ajuda
                            </a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Documentação
                            </a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Status do Sistema
                            </a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition font-medium flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform"></i>
                                API Docs
                            </a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 font-medium mb-4 md:mb-0">
                        &copy; 2025 Estoque Pro. Todos os direitos reservados.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-indigo-400 transition font-medium">Termos de
                            Uso</a>
                        <a href="#"
                            class="text-gray-400 hover:text-indigo-400 transition font-medium">Privacidade</a>
                        <a href="#"
                            class="text-gray-400 hover:text-indigo-400 transition font-medium">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animate on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.8s ease-out';
            observer.observe(el);
        });
    </script>
</body>

</html>
