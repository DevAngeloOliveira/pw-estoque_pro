<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Estoque Multi-Empresas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {}
            }
        }
    </script>
    <script>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/modern-theme.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
    <style>
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .sidebar-open {
            animation: slideIn 0.3s ease-out;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        /* Loading spinner */
        .spinner {
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            width: 20px;
            height: 20px;
            animation: spin 0.8s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Smooth transitions for all interactive elements */
        a,
        button,
        input,
        textarea,
        select {
            transition: all 0.2s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:bg-gradient-to-br dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-300"
    style="font-family: 'Inter', sans-serif;">
    <div class="flex h-screen overflow-hidden">
        <!-- Modern Sidebar -->
        <aside id="sidebar"
            class="modern-sidebar fixed left-0 top-0 h-screen overflow-y-auto z-40 transition-all duration-300 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
            <!-- Toggle Button (Inside Sidebar) -->
            <button id="sidebarToggle"
                class="absolute top-6 right-4 z-50 w-10 h-10 bg-white dark:bg-gray-700 rounded-xl shadow-md flex items-center justify-center text-indigo-600 dark:text-indigo-400 hover:bg-indigo-600 hover:text-white transition-all duration-300 hover:shadow-lg border border-indigo-100 dark:border-gray-600">
                <i id="toggleIcon" class="fas fa-chevron-left text-sm transition-transform duration-300"></i>
            </button>

            <div class="p-6 border-b border-gray-100 dark:border-gray-700 pr-16">
                <div id="sidebarLogo" class="flex items-center space-x-3 mb-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0">
                        <i class="fas fa-boxes text-white text-xl"></i>
                    </div>
                    <div class="sidebar-text overflow-hidden">
                        <h1 class="text-xl font-black text-gray-900 dark:text-white tracking-tight whitespace-nowrap">
                            Estoque Pro</h1>
                        <p class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">Sistema de Gestão</p>
                    </div>
                </div>
                @php
                    $loggedCompany = Auth::guard('company')->user();
                @endphp
                @if ($loggedCompany)
                    <div id="sidebarCompany"
                        class="mt-4 p-3 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-600 rounded-2xl border border-indigo-100 dark:border-gray-600">
                        <div class="flex items-center space-x-2 mb-2">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ strtoupper(substr($loggedCompany->nome_fantasia ?? $loggedCompany->razao_social, 0, 1)) }}
                            </div>
                            <div class="flex-1 sidebar-text overflow-hidden">
                                <div class="font-bold text-sm text-gray-900 dark:text-white truncate">
                                    {{ $loggedCompany->nome_fantasia ?? $loggedCompany->razao_social }}</div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 font-mono sidebar-text">
                            {{ $loggedCompany->formatted_cnpj }}
                        </div>
                    </div>
                @endif
            </div>

            <nav class="py-6">
                <div class="px-4 mb-4">
                    <p
                        class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3 sidebar-text">
                        Menu Principal
                    </p>

                    <a href="{{ route('dashboard') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-700 dark:text-gray-300' }}"
                        title="Dashboard">
                        <div
                            class="w-8 h-8 flex items-center justify-center flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-indigo-600' }}">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <span class="ml-3 font-medium sidebar-text whitespace-nowrap">Dashboard</span>
                    </a>
                </div>

                <div class="border-t border-gray-100 my-4"></div>

                <div class="px-4 mb-4">
                    <p
                        class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3 sidebar-text">
                        Gestão</p>

                    <a href="{{ route('products.index') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('products.*') ? 'active' : 'text-gray-700 dark:text-gray-300' }}"
                        title="Produtos">
                        <div
                            class="w-8 h-8 flex items-center justify-center flex-shrink-0 {{ request()->routeIs('products.*') ? 'text-white' : 'text-indigo-600 dark:text-indigo-400' }}">
                            <i class="fas fa-box"></i>
                        </div>
                        <span class="ml-3 font-medium sidebar-text whitespace-nowrap">Produtos</span>
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('categories.*') ? 'active' : 'text-gray-700 dark:text-gray-300' }}"
                        title="Categorias">
                        <div
                            class="w-8 h-8 flex items-center justify-center flex-shrink-0 {{ request()->routeIs('categories.*') ? 'text-white' : 'text-indigo-600 dark:text-indigo-400' }}">
                            <i class="fas fa-tags"></i>
                        </div>
                        <span class="ml-3 font-medium sidebar-text whitespace-nowrap">Categorias</span>
                    </a>

                    <a href="{{ route('suppliers.index') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('suppliers.*') ? 'active' : 'text-gray-700 dark:text-gray-300' }}"
                        title="Fornecedores">
                        <div
                            class="w-8 h-8 flex items-center justify-center flex-shrink-0 {{ request()->routeIs('suppliers.*') ? 'text-white' : 'text-indigo-600 dark:text-indigo-400' }}">
                            <i class="fas fa-truck"></i>
                        </div>
                        <span class="ml-3 font-medium sidebar-text whitespace-nowrap">Fornecedores</span>
                    </a>

                    <a href="{{ route('movements.index') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('movements.*') ? 'active' : 'text-gray-700 dark:text-gray-300' }}"
                        title="Movimentações">
                        <div
                            class="w-8 h-8 flex items-center justify-center flex-shrink-0 {{ request()->routeIs('movements.*') ? 'text-white' : 'text-indigo-600 dark:text-indigo-400' }}">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <span class="ml-3 font-medium sidebar-text whitespace-nowrap">Movimentações</span>
                    </a>

                    <a href="{{ route('audit.index') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('audit.*') ? 'active' : 'text-gray-700 dark:text-gray-300' }}"
                        title="Auditoria">
                        <div
                            class="w-8 h-8 flex items-center justify-center flex-shrink-0 {{ request()->routeIs('audit.*') ? 'text-white' : 'text-indigo-600 dark:text-indigo-400' }}">
                            <i class="fas fa-history"></i>
                        </div>
                        <span class="ml-3 font-medium sidebar-text whitespace-nowrap">Auditoria</span>
                    </a>
                </div>

                <div class="px-4">
                    <p
                        class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3 sidebar-text">
                        Conta</p>

                    <a href="{{ route('profile') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('profile') ? 'active' : 'text-gray-700 dark:text-gray-300' }}"
                        title="Meu Perfil">
                        <div
                            class="w-8 h-8 flex items-center justify-center flex-shrink-0 {{ request()->routeIs('profile') ? 'text-white' : 'text-indigo-600 dark:text-indigo-400' }}">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <span class="ml-3 font-medium sidebar-text whitespace-nowrap">Meu Perfil</span>
                    </a>

                    <a href="{{ route('logout') }}"
                        class="sidebar-link flex items-center text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20"
                        title="Sair">
                        <div
                            class="w-8 h-8 flex items-center justify-center flex-shrink-0 text-red-600 dark:text-red-400">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span class="ml-3 font-medium sidebar-text whitespace-nowrap">Sair</span>
                    </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div id="mainContent" class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ml-64">
            <!-- Top Navigation -->
            <header
                class="bg-white dark:bg-gray-800 shadow-md dark:shadow-gray-900/50 z-10 transition-colors duration-300">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <!-- Logo e Empresa no Header (hidden por padrão, mostrado quando colapsado) -->
                        <div id="headerLogo" class="hidden items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-boxes text-white"></i>
                            </div>
                            <div>
                                <h1 class="text-base font-black text-gray-900 dark:text-white tracking-tight">Estoque
                                    Pro</h1>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Sistema de Gestão</p>
                            </div>
                        </div>

                        @php
                            $loggedCompany = Auth::guard('company')->user();
                        @endphp
                        @if ($loggedCompany)
                            <div id="headerCompany"
                                class="hidden items-center space-x-2 px-4 py-2 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-600 rounded-xl border border-indigo-100 dark:border-gray-600">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr($loggedCompany->nome_fantasia ?? $loggedCompany->razao_social, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-sm text-gray-900 dark:text-white">
                                        {{ $loggedCompany->nome_fantasia ?? $loggedCompany->razao_social }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $loggedCompany->formatted_cnpj }}</div>
                                </div>
                            </div>
                        @endif

                        <h2 id="pageTitle" class="text-xl font-semibold text-gray-800 dark:text-white">
                            @if (request()->routeIs('dashboard'))
                                Dashboard
                            @elseif(request()->routeIs('companies.*'))
                                Gerenciar Empresas
                            @elseif(request()->routeIs('products.*'))
                                Gerenciar Produtos
                            @elseif(request()->routeIs('movements.*'))
                                Movimentações de Estoque
                            @else
                                Sistema de Estoque
                            @endif
                        </h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button id="darkModeToggle"
                            class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-gray-600 transition-all duration-300 hover:scale-110">
                            <i id="darkModeIcon" class="fas fa-moon text-lg"></i>
                        </button>

                        @livewire('notifications')
                        <a href="{{ route('profile') }}"
                            class="h-10 w-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold hover:shadow-lg transition transform hover:scale-110 cursor-pointer">
                            {{ strtoupper(substr(Auth::guard('company')->user()->razao_social, 0, 1)) }}
                        </a>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main
                class="flex-1 overflow-y-auto bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        // Dark Mode Functionality
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeIcon = document.getElementById('darkModeIcon');
        const htmlElement = document.documentElement;

        // Load saved dark mode preference
        const isDarkMode = localStorage.getItem('darkMode') === 'true';

        function setDarkMode(isDark) {
            if (isDark) {
                htmlElement.classList.add('dark');
                darkModeIcon.classList.remove('fa-moon');
                darkModeIcon.classList.add('fa-sun');
            } else {
                htmlElement.classList.remove('dark');
                darkModeIcon.classList.remove('fa-sun');
                darkModeIcon.classList.add('fa-moon');
            }
            localStorage.setItem('darkMode', isDark);
        }

        // Set initial dark mode state
        setDarkMode(isDarkMode);

        // Toggle dark mode on button click
        darkModeToggle.addEventListener('click', () => {
            const isDark = htmlElement.classList.contains('dark');
            setDarkMode(!isDark);
        });

        // Sidebar Collapse Functionality
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('sidebarToggle');
        const toggleIcon = document.getElementById('toggleIcon');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        const headerLogo = document.getElementById('headerLogo');
        const headerCompany = document.getElementById('headerCompany');
        const sidebarLogo = document.getElementById('sidebarLogo');
        const sidebarCompany = document.getElementById('sidebarCompany');

        // Load saved state from localStorage
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

        function toggleSidebar() {
            const collapsed = sidebar.classList.toggle('collapsed');

            if (collapsed) {
                // Colapsar sidebar
                sidebar.style.width = '80px';
                mainContent.style.marginLeft = '80px';
                toggleIcon.style.transform = 'rotate(180deg)';

                // Ocultar textos na sidebar
                sidebarTexts.forEach(text => text.style.opacity = '0');
                setTimeout(() => {
                    sidebarTexts.forEach(text => text.style.display = 'none');
                    // Ocultar logo e empresa na sidebar
                    if (sidebarLogo) sidebarLogo.style.display = 'none';
                    if (sidebarCompany) sidebarCompany.style.display = 'none';
                    // Mostrar logo e empresa no header
                    if (headerLogo) headerLogo.style.display = 'flex';
                    if (headerCompany) headerCompany.style.display = 'flex';
                }, 300);
            } else {
                // Expandir sidebar
                sidebar.style.width = '260px';
                mainContent.style.marginLeft = '260px';
                toggleIcon.style.transform = 'rotate(0deg)';

                // Mostrar logo e empresa na sidebar
                if (sidebarLogo) sidebarLogo.style.display = 'flex';
                if (sidebarCompany) sidebarCompany.style.display = 'block';
                // Ocultar logo e empresa do header
                if (headerLogo) headerLogo.style.display = 'none';
                if (headerCompany) headerCompany.style.display = 'none';

                // Mostrar textos na sidebar
                sidebarTexts.forEach(text => {
                    text.style.display = 'block';
                    setTimeout(() => text.style.opacity = '1', 50);
                });
            }

            // Save state to localStorage
            localStorage.setItem('sidebarCollapsed', collapsed);
        }

        // Set initial state
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
            sidebar.style.width = '80px';
            mainContent.style.marginLeft = '80px';
            toggleIcon.style.transform = 'rotate(180deg)';
            sidebarTexts.forEach(text => {
                text.style.display = 'none';
                text.style.opacity = '0';
            });
            // Estado inicial colapsado
            if (sidebarLogo) sidebarLogo.style.display = 'none';
            if (sidebarCompany) sidebarCompany.style.display = 'none';
            if (headerLogo) headerLogo.style.display = 'flex';
            if (headerCompany) headerCompany.style.display = 'flex';
        }

        // Add click event to toggle button
        toggleBtn.addEventListener('click', toggleSidebar);

        // Add animation to sidebar texts
        sidebarTexts.forEach(text => {
            text.style.transition = 'opacity 0.3s ease';
        });
    </script>

    @livewireScripts

    <!-- DataTables Scripts -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
</body>

</html>
