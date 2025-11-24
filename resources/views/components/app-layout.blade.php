<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Estoque Multi-Empresas</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50" style="font-family: 'Inter', sans-serif;">
    <div class="flex h-screen overflow-hidden">
        <!-- Modern Sidebar -->
        <aside id="sidebar" class="modern-sidebar fixed left-0 top-0 h-screen overflow-y-auto z-40">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3 mb-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-boxes text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-gray-900 tracking-tight">Estoque Pro</h1>
                        <p class="text-xs text-gray-500">Sistema de Gestão</p>
                    </div>
                </div>
                @php
                    $loggedCompany = Auth::guard('company')->user();
                @endphp
                @if ($loggedCompany)
                    <div
                        class="mt-4 p-3 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100">
                        <div class="flex items-center space-x-2 mb-2">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr($loggedCompany->nome_fantasia ?? $loggedCompany->razao_social, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <div class="font-bold text-sm text-gray-900 truncate">
                                    {{ $loggedCompany->nome_fantasia ?? $loggedCompany->razao_social }}</div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 font-mono">{{ $loggedCompany->formatted_cnpj }}</div>
                    </div>
                @endif
            </div>

            <nav class="py-6">
                <div class="px-4 mb-4">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Menu Principal</p>

                    <a href="{{ route('dashboard') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-700' }}">
                        <div
                            class="w-8 h-8 flex items-center justify-center {{ request()->routeIs('dashboard') ? 'text-white' : 'text-indigo-600' }}">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <span class="ml-3 font-medium">Dashboard</span>
                    </a>
                </div>

                <div class="border-t border-gray-100 my-4"></div>

                <div class="px-4 mb-4">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Gestão</p>

                    <a href="{{ route('products.index') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('products.*') ? 'active' : 'text-gray-700' }}">
                        <div
                            class="w-8 h-8 flex items-center justify-center {{ request()->routeIs('products.*') ? 'text-white' : 'text-indigo-600' }}">
                            <i class="fas fa-box"></i>
                        </div>
                        <span class="ml-3 font-medium">Produtos</span>
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('categories.*') ? 'active' : 'text-gray-700' }}">
                        <div
                            class="w-8 h-8 flex items-center justify-center {{ request()->routeIs('categories.*') ? 'text-white' : 'text-indigo-600' }}">
                            <i class="fas fa-tags"></i>
                        </div>
                        <span class="ml-3 font-medium">Categorias</span>
                    </a>

                    <a href="{{ route('suppliers.index') }}"
                        class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 {{ request()->routeIs('suppliers.*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-truck w-6"></i>
                        <span class="ml-3">Fornecedores</span>
                    </a>

                    <a href="{{ route('movements.index') }}"
                        class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 {{ request()->routeIs('movements.*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-exchange-alt w-6"></i>
                        <span class="ml-3">Movimentações</span>
                    </a>

                    <a href="{{ route('audit.index') }}"
                        class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 {{ request()->routeIs('audit.*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-history w-6"></i>
                        <span class="ml-3">Auditoria</span>
                    </a>

                    <div class="border-t border-blue-700 my-2"></div>

                    <a href="{{ route('profile') }}"
                        class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 {{ request()->routeIs('profile') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-user-circle w-6"></i>
                        <span class="ml-3">Meu Perfil</span>
                    </a>

                    <a href="{{ route('logout') }}"
                        class="flex items-center px-4 py-3 rounded-lg hover:bg-red-600 transition transform hover:scale-105">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span class="ml-3">Sair</span>
                    </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-md z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button onclick="toggleSidebar()" class="md:hidden mr-4 text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800">
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
                        @livewire('notifications')
                        <a href="{{ route('profile') }}"
                            class="h-10 w-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold hover:shadow-lg transition transform hover:scale-110 cursor-pointer">
                            {{ strtoupper(substr(Auth::guard('company')->user()->razao_social, 0, 1)) }}
                        </a>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        }
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
