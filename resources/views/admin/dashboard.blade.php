@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Geral</h1>
                <p class="text-gray-600 mt-1">Visão consolidada do sistema</p>
            </div>
            <div class="text-right text-sm text-gray-500">
                <i class="fas fa-calendar mr-2"></i>{{ now()->format('d/m/Y H:i') }}
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Companies -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Empresas</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $stats['total_companies'] }}</h3>
                        <p class="text-blue-100 text-xs mt-2">{{ $stats['active_companies'] }} ativas</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-lg">
                        <i class="fas fa-building text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Produtos</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $stats['total_products'] }}</h3>
                        <p class="text-green-100 text-xs mt-2">Total cadastrados</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-lg">
                        <i class="fas fa-box text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Suppliers -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Fornecedores</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $stats['total_suppliers'] }}</h3>
                        <p class="text-purple-100 text-xs mt-2">{{ $stats['global_suppliers'] }} globais</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-lg">
                        <i class="fas fa-truck text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Stock Value -->
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Valor Estoque</p>
                        <h3 class="text-3xl font-bold mt-2">R$ {{ number_format($stats['total_stock_value'], 2, ',', '.') }}
                        </h3>
                        <p class="text-orange-100 text-xs mt-2">Total geral</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-lg">
                        <i class="fas fa-dollar-sign text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="bg-indigo-100 p-3 rounded-lg">
                        <i class="fas fa-tags text-indigo-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Categorias</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['total_categories'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="bg-cyan-100 p-3 rounded-lg">
                        <i class="fas fa-exchange-alt text-cyan-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Movimentações (7 dias)</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['recent_movements'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="bg-pink-100 p-3 rounded-lg">
                        <i class="fas fa-chart-line text-pink-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Movimentações</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['total_movements'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Companies -->
            <div class="bg-white rounded-xl shadow">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-bold text-gray-800">
                        <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                        Empresas Mais Ativas (30 dias)
                    </h3>
                </div>
                <div class="p-6">
                    @forelse($topCompanies as $company)
                        <div class="flex justify-between items-center py-3 border-b last:border-0">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $company->nome_fantasia }}</p>
                                <p class="text-sm text-gray-500">{{ $company->razao_social }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-purple-600">{{ $company->movements_count }}</p>
                                <p class="text-xs text-gray-500">movimentações</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Nenhuma movimentação registrada</p>
                    @endforelse
                </div>
            </div>

            <!-- Movement Stats -->
            <div class="bg-white rounded-xl shadow">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-bold text-gray-800">
                        <i class="fas fa-chart-pie mr-2"></i>
                        Movimentações (30 dias)
                    </h3>
                </div>
                <div class="p-6">
                    @if ($movementsByType->isNotEmpty())
                        <div class="space-y-4">
                            @if ($movementsByType->has('entrada'))
                                <div class="flex justify-between items-center p-4 bg-green-50 rounded-lg">
                                    <div>
                                        <p class="text-sm text-gray-600">Entradas</p>
                                        <p class="text-2xl font-bold text-green-600">
                                            {{ $movementsByType['entrada']->count }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">Valor</p>
                                        <p class="text-lg font-bold text-green-600">R$
                                            {{ number_format($movementsByType['entrada']->total_value, 2, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($movementsByType->has('saida'))
                                <div class="flex justify-between items-center p-4 bg-red-50 rounded-lg">
                                    <div>
                                        <p class="text-sm text-gray-600">Saídas</p>
                                        <p class="text-2xl font-bold text-red-600">{{ $movementsByType['saida']->count }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">Valor</p>
                                        <p class="text-lg font-bold text-red-600">R$
                                            {{ number_format($movementsByType['saida']->total_value, 2, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Nenhuma movimentação registrada</p>
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
