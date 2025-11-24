<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Sistema de Gestão</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modern-theme.css') }}">
    @livewireStyles
    @stack('styles')
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50" style="font-family: 'Inter', sans-serif;">
    <!-- Modern Navbar -->
    <nav class="modern-navbar fixed w-full top-0 z-50 h-16">
        <div class="max-w-full mx-auto px-6 h-full">
            <div class="flex justify-between items-center h-full">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-lg">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <div>
                        <span class="font-bold text-xl tracking-tight">Admin Dashboard</span>
                        <p class="text-xs text-white/80">Sistema de Gestão</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div
                        class="hidden md:flex items-center space-x-3 bg-white/10 px-4 py-2 rounded-xl backdrop-blur-lg">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}
                        </div>
                        <div class="text-sm">
                            <p class="font-semibold">{{ Auth::guard('admin')->user()->name }}</p>
                            <p class="text-xs text-white/80">Administrador</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-300 backdrop-blur-lg flex items-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="hidden md:inline">Sair</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex pt-16 min-h-screen">
        <!-- Modern Sidebar -->
        <aside class="modern-sidebar fixed left-0 w-64 h-[calc(100vh-4rem)] overflow-y-auto">
            <nav class="py-6">
                <div class="px-4 mb-6">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Menu Principal</p>

                    <a href="{{ route('admin.dashboard') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-gray-700' }}">
                        <div
                            class="w-8 h-8 flex items-center justify-center {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-indigo-600' }}">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <span class="ml-3 font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.companies') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('admin.companies*') && !request()->routeIs('admin.companies.create') && !request()->routeIs('admin.companies.edit') ? 'active' : 'text-gray-700' }}">
                        <div
                            class="w-8 h-8 flex items-center justify-center {{ request()->routeIs('admin.companies*') ? 'text-white' : 'text-indigo-600' }}">
                            <i class="fas fa-building"></i>
                        </div>
                        <span class="ml-3 font-medium">Empresas</span>
                    </a>

                    <a href="{{ route('admin.global-suppliers') }}"
                        class="sidebar-link flex items-center {{ request()->routeIs('admin.global-suppliers') ? 'active' : 'text-gray-700' }}">
                        <div
                            class="w-8 h-8 flex items-center justify-center {{ request()->routeIs('admin.global-suppliers') ? 'text-white' : 'text-indigo-600' }}">
                            <i class="fas fa-truck"></i>
                        </div>
                        <span class="ml-3 font-medium">Fornecedores Globais</span>
                    </a>
                </div>

                <div class="border-t border-gray-100 px-4 pt-6">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Sistema</p>

                    <a href="{{ route('welcome') }}" target="_blank"
                        class="sidebar-link flex items-center text-gray-700">
                        <div class="w-8 h-8 flex items-center justify-center text-indigo-600">
                            <i class="fas fa-external-link-alt"></i>
                        </div>
                        <span class="ml-3 font-medium">Site Principal</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8 animate-fadeInUp">
            @yield('content')
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>
