<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque Pro - Sistema de Gestão Multi-Empresas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
            50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8); }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .feature-card {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Navbar -->
    <nav class="fixed w-full bg-white/90 backdrop-blur-sm shadow-md z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-boxes text-blue-600 text-3xl"></i>
                    <span class="text-2xl font-bold text-gray-800">Estoque Pro</span>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}" class="px-6 py-2 text-blue-600 hover:text-blue-800 font-semibold transition">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 font-semibold shadow-lg transition">
                        Começar Agora
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="fade-in-up">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                        Gestão de Estoque
                        <span class="gradient-text block">Inteligente e Eficiente</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Sistema completo para gerenciar múltiplas empresas, produtos e movimentações de estoque com relatórios em tempo real e análises detalhadas.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 font-semibold shadow-2xl transition text-center">
                            <i class="fas fa-rocket mr-2"></i>Começar Gratuitamente
                        </a>
                        <a href="#features" class="px-8 py-4 bg-white text-gray-800 rounded-lg hover:bg-gray-50 font-semibold shadow-lg transition text-center border-2 border-gray-200">
                            <i class="fas fa-info-circle mr-2"></i>Saiba Mais
                        </a>
                    </div>
                    <div class="mt-8 flex items-center space-x-6 text-sm text-gray-600">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Sem cartão de crédito</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Configuração em 2 minutos</span>
                        </div>
                    </div>
                </div>
                <div class="fade-in-up float-animation">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl blur-3xl opacity-30"></div>
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800" alt="Dashboard" class="relative rounded-3xl shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 text-center text-white">
                <div class="fade-in-up">
                    <div class="text-5xl font-bold mb-2">1000+</div>
                    <div class="text-blue-100">Empresas Cadastradas</div>
                </div>
                <div class="fade-in-up" style="animation-delay: 0.1s;">
                    <div class="text-5xl font-bold mb-2">50K+</div>
                    <div class="text-blue-100">Produtos Gerenciados</div>
                </div>
                <div class="fade-in-up" style="animation-delay: 0.2s;">
                    <div class="text-5xl font-bold mb-2">99.9%</div>
                    <div class="text-blue-100">Uptime</div>
                </div>
                <div class="fade-in-up" style="animation-delay: 0.3s;">
                    <div class="text-5xl font-bold mb-2">24/7</div>
                    <div class="text-blue-100">Suporte</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Recursos Poderosos</h2>
                <p class="text-xl text-gray-600">Tudo que você precisa para gerenciar seu estoque com eficiência</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Relatórios em Tempo Real</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Visualize gráficos e métricas atualizadas instantaneamente sobre entradas, saídas e lucratividade.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Multi-Empresas</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Gerencie múltiplas empresas com dados separados e seguros para cada CNPJ cadastrado.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Segurança Avançada</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Autenticação segura por CNPJ com criptografia de senhas e isolamento total dos dados.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-bell text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Alertas Inteligentes</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Receba notificações automáticas sobre estoque baixo e movimentações importantes.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Responsivo</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Acesse de qualquer dispositivo - desktop, tablet ou smartphone com interface adaptativa.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-database text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Backup Automático</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Seus dados protegidos com backups automáticos e recuperação instantânea.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Pronto para revolucionar sua gestão de estoque?
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                Junte-se a milhares de empresas que já utilizam o Estoque Pro
            </p>
            <a href="{{ route('register') }}" class="inline-block px-12 py-5 bg-white text-blue-600 rounded-lg hover:bg-gray-100 font-bold text-lg shadow-2xl transition">
                <i class="fas fa-rocket mr-2"></i>Criar Conta Gratuita
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <i class="fas fa-boxes text-blue-500 text-2xl"></i>
                        <span class="text-xl font-bold">Estoque Pro</span>
                    </div>
                    <p class="text-gray-400">
                        Sistema completo de gestão de estoque para múltiplas empresas.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Produto</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#features" class="hover:text-white transition">Recursos</a></li>
                        <li><a href="#" class="hover:text-white transition">Preços</a></li>
                        <li><a href="#" class="hover:text-white transition">Demonstração</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Empresa</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Sobre</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Suporte</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Central de Ajuda</a></li>
                        <li><a href="#" class="hover:text-white transition">Documentação</a></li>
                        <li><a href="#" class="hover:text-white transition">Status</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Estoque Pro. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
