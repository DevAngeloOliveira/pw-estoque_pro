<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Estoque Multi-Empresas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

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

<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 bg-gradient-to-b from-blue-900 to-blue-800 text-white flex-shrink-0 overflow-y-auto shadow-2xl">
            <div class="p-6 border-b border-blue-700">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-boxes mr-3"></i>
                    Estoque Pro
                </h1>
                @php
                    $loggedCompany = Auth::guard('company')->user();
                @endphp
                @if ($loggedCompany)
                    <div class="mt-3 text-xs bg-blue-700 rounded-lg p-2">
                        <div class="font-semibold">{{ $loggedCompany->nome_fantasia ?? $loggedCompany->razao_social }}
                        </div>
                        <div class="text-blue-300">{{ $loggedCompany->formatted_cnpj }}</div>
                    </div>
                @endif
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 {{ request()->routeIs('dashboard') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-th-large w-6"></i>
                    <span class="ml-3">Dashboard</span>
                </a>

                <div class="border-t border-blue-700 my-2"></div>

                <a href="{{ route('products.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 {{ request()->routeIs('products.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-box w-6"></i>
                    <span class="ml-3">Produtos</span>
                </a>

                <a href="{{ route('categories.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 {{ request()->routeIs('categories.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-tags w-6"></i>
                    <span class="ml-3">Categorias</span>
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
