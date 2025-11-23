<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Sistema de Gestão</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @livewireStyles
    @stack('styles')
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-2xl mr-3"></i>
                    <span class="font-bold text-xl">Admin Dashboard</span>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-sm">{{ Auth::guard('admin')->user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar + Content -->
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg min-h-screen">
            <nav class="mt-5 px-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg mb-2 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-50 text-purple-600' : '' }}">
                    <i class="fas fa-chart-line mr-3"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.companies') }}"
                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg mb-2 {{ request()->routeIs('admin.companies*') && !request()->routeIs('admin.companies.create') && !request()->routeIs('admin.companies.edit') ? 'bg-purple-50 text-purple-600' : '' }}">
                    <i class="fas fa-building mr-3"></i>
                    Empresas
                </a>

                <a href="{{ route('admin.global-suppliers') }}"
                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg mb-2 {{ request()->routeIs('admin.global-suppliers') ? 'bg-purple-50 text-purple-600' : '' }}">
                    <i class="fas fa-truck mr-3"></i>
                    Fornecedores Globais
                </a>

                <div class="border-t mt-4 pt-4">
                    <p class="text-xs text-gray-500 px-4 mb-2">SISTEMA</p>

                    <a href="{{ route('welcome') }}" target="_blank"
                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg mb-2">
                        <i class="fas fa-external-link-alt mr-3"></i>
                        Site Principal
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>
