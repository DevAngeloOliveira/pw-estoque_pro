@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <!-- Modern Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white tracking-tight">Dashboard Geral</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 flex items-center">
                    <i class="fas fa-chart-bar mr-2 text-indigo-600"></i>
                    Visão consolidada do sistema
                </p>
            </div>
            <div
                class="flex items-center space-x-3 bg-white dark:bg-gray-800 px-5 py-3 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <i class="fas fa-calendar text-indigo-600"></i>
                <div class="text-sm">
                    <p class="font-semibold text-gray-900 dark:text-white">{{ now()->format('d/m/Y') }}</p>
                    <p class="text-gray-500 dark:text-gray-400">{{ now()->format('H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Modern Stats Cards with Gradients -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <!-- Total Companies -->
            <div class="stat-card stat-card-blue relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-building text-3xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-semibold backdrop-blur-sm">
                            {{ $stats['active_companies'] }}/{{ $stats['total_companies'] }}
                        </span>
                    </div>
                    <h3 class="text-4xl font-black mb-2">{{ $stats['total_companies'] }}</h3>
                    <p class="text-white/90 font-medium">Empresas Cadastradas</p>
                    <div class="mt-4 flex items-center text-sm">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>{{ $stats['active_companies'] }} ativas</span>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="stat-card stat-card-green relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-box text-3xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-semibold backdrop-blur-sm">
                            PRODUTOS
                        </span>
                    </div>
                    <h3 class="text-4xl font-black mb-2">{{ $stats['total_products'] }}</h3>
                    <p class="text-white/90 font-medium">Total de Produtos</p>
                    <div class="mt-4 flex items-center text-sm">
                        <i class="fas fa-cubes mr-2"></i>
                        <span>Cadastrados no sistema</span>
                    </div>
                </div>
            </div>

            <!-- Total Suppliers -->
            <div class="stat-card stat-card-purple relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-truck text-3xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-semibold backdrop-blur-sm">
                            {{ $stats['global_suppliers'] }} GLOBAIS
                        </span>
                    </div>
                    <h3 class="text-4xl font-black mb-2">{{ $stats['total_suppliers'] }}</h3>
                    <p class="text-white/90 font-medium">Fornecedores</p>
                    <div class="mt-4 flex items-center text-sm">
                        <i class="fas fa-globe mr-2"></i>
                        <span>{{ $stats['global_suppliers'] }} fornecedores globais</span>
                    </div>
                </div>
            </div>

            <!-- Stock Value -->
            <div class="stat-card stat-card-orange relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-dollar-sign text-3xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-semibold backdrop-blur-sm">
                            TOTAL
                        </span>
                    </div>
                    <h3 class="text-3xl font-black mb-2">R$ {{ number_format($stats['total_stock_value'], 2, ',', '.') }}
                    </h3>
                    <p class="text-white/90 font-medium">Valor em Estoque</p>
                    <div class="mt-4 flex items-center text-sm">
                        <i class="fas fa-chart-line mr-2"></i>
                        <span>Valor total geral</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats with Modern Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="modern-card p-6 bg-gradient-to-br from-white to-indigo-50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Categorias</p>
                        <p class="text-4xl font-black text-gray-900">{{ $stats['total_categories'] }}</p>
                        <div class="mt-3 flex items-center text-xs text-indigo-600 font-semibold">
                            <div class="w-2 h-2 bg-indigo-600 rounded-full mr-2 animate-pulse"></div>
                            Cadastradas
                        </div>
                    </div>
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-tags text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="modern-card p-6 bg-gradient-to-br from-white to-cyan-50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Movimentações (7 dias)</p>
                        <p class="text-4xl font-black text-gray-900">{{ $stats['recent_movements'] }}</p>
                        <div class="mt-3 flex items-center text-xs text-cyan-600 font-semibold">
                            <div class="w-2 h-2 bg-cyan-600 rounded-full mr-2 animate-pulse"></div>
                            Última semana
                        </div>
                    </div>
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-exchange-alt text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="modern-card p-6 bg-gradient-to-br from-white to-pink-50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Movimentações</p>
                        <p class="text-4xl font-black text-gray-900">{{ $stats['total_movements'] }}</p>
                        <div class="mt-3 flex items-center text-xs text-pink-600 font-semibold">
                            <div class="w-2 h-2 bg-pink-600 rounded-full mr-2 animate-pulse"></div>
                            Histórico completo
                        </div>
                    </div>
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-pink-500 to-red-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Companies -->
            <div class="modern-card overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-yellow-50 to-orange-50">
                    <h3 class="text-xl font-black text-gray-900 flex items-center">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center mr-3 shadow-md">
                            <i class="fas fa-trophy text-white"></i>
                        </div>
                        Empresas Mais Ativas
                    </h3>
                    <p class="text-sm text-gray-500 mt-1 ml-13">Últimos 30 dias</p>
                </div>
                <div class="p-6">
                    @forelse($topCompanies as $index => $company)
                        <div
                            class="flex justify-between items-center py-4 border-b border-gray-50 last:border-0 hover:bg-gradient-to-r hover:from-purple-50 hover:to-indigo-50 rounded-lg px-3 -mx-3 transition-all duration-300">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold shadow-md">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $company->nome_fantasia }}</p>
                                    <p class="text-sm text-gray-500">{{ $company->razao_social }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p
                                    class="text-2xl font-black bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                                    {{ $company->movements_count }}
                                </p>
                                <p class="text-xs text-gray-500 font-semibold">movimentações</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-gray-400 text-3xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Nenhuma movimentação registrada</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Movement Stats -->
            <div class="modern-card overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-cyan-50">
                    <h3 class="text-xl font-black text-gray-900 flex items-center">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center mr-3 shadow-md">
                            <i class="fas fa-chart-pie text-white"></i>
                        </div>
                        Movimentações
                    </h3>
                    <p class="text-sm text-gray-500 mt-1 ml-13">Últimos 30 dias</p>
                </div>
                <div class="p-6">
                    @if ($movementsByType->isNotEmpty())
                        <div class="space-y-4">
                            @if ($movementsByType->has('entrada'))
                                <div
                                    class="modern-card bg-gradient-to-br from-green-500 to-emerald-600 p-6 text-white hover:scale-105 transition-transform duration-300">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="flex items-center mb-2">
                                                <div
                                                    class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mr-3 backdrop-blur-sm">
                                                    <i class="fas fa-arrow-down"></i>
                                                </div>
                                                <p class="text-white/90 font-semibold">Entradas</p>
                                            </div>
                                            <p class="text-4xl font-black">{{ $movementsByType['entrada']->count }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-white/90 mb-1">Valor Total</p>
                                            <p class="text-2xl font-black">R$
                                                {{ number_format($movementsByType['entrada']->total_value, 2, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($movementsByType->has('saida'))
                                <div
                                    class="modern-card bg-gradient-to-br from-red-500 to-rose-600 p-6 text-white hover:scale-105 transition-transform duration-300">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="flex items-center mb-2">
                                                <div
                                                    class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mr-3 backdrop-blur-sm">
                                                    <i class="fas fa-arrow-up"></i>
                                                </div>
                                                <p class="text-white/90 font-semibold">Saídas</p>
                                            </div>
                                            <p class="text-4xl font-black">{{ $movementsByType['saida']->count }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-white/90 mb-1">Valor Total</p>
                                            <p class="text-2xl font-black">R$
                                                {{ number_format($movementsByType['saida']->total_value, 2, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-exchange-alt text-gray-400 text-3xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Nenhuma movimentação registrada</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-bold text-gray-800">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    Produtos com Estoque Baixo
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Empresa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantidade</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Valor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($lowStockProducts as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $product->sku }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $product->company->nome_fantasia }}</td>
                                <td class="px-6 py-4">
                                    @if ($product->category)
                                        <span class="px-2 py-1 text-xs rounded-full"
                                            style="background-color: {{ $product->category->color }}20; color: {{ $product->category->color }}">
                                            {{ $product->category->name }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">Sem categoria</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                                        {{ $product->quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">R$
                                    {{ number_format($product->price, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-check-circle text-green-500 text-3xl mb-2"></i>
                                    <p>Nenhum produto com estoque baixo</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-bold text-gray-800">
                    <i class="fas fa-fire text-orange-500 mr-2"></i>
                    Produtos Mais Movimentados (30 dias)
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Empresa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qtd. Movimentada
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($topProducts as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $product->sku }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $product->company->nome_fantasia }}</td>
                                <td class="px-6 py-4">
                                    @if ($product->category)
                                        <span class="px-2 py-1 text-xs rounded-full"
                                            style="background-color: {{ $product->category->color }}20; color: {{ $product->category->color }}">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">
                                        {{ $product->total_quantity }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Nenhuma movimentação
                                    registrada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
