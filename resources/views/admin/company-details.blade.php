@extends('admin.layout')

@section('title', 'Detalhes da Empresa')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('admin.companies') }}"
                    class="text-purple-600 hover:text-purple-800 text-sm mb-2 inline-block">
                    <i class="fas fa-arrow-left mr-2"></i>Voltar para empresas
                </a>
                <h1 class="text-3xl font-bold text-gray-800">{{ $company->nome_fantasia }}</h1>
                <p class="text-gray-600 mt-1">{{ $company->razao_social }}</p>
            </div>
            <div>
                @if ($company->active)
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg text-sm font-semibold">
                        <i class="fas fa-check-circle mr-2"></i>Ativa
                    </span>
                @else
                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-lg text-sm font-semibold">
                        <i class="fas fa-times-circle mr-2"></i>Inativa
                    </span>
                @endif
            </div>
        </div>

        <!-- Company Info -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Informações</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">CNPJ</p>
                        <p class="font-semibold text-gray-800">
                            {{ substr($company->cnpj, 0, 2) }}.{{ substr($company->cnpj, 2, 3) }}.{{ substr($company->cnpj, 5, 3) }}/{{ substr($company->cnpj, 8, 4) }}-{{ substr($company->cnpj, 12, 2) }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">E-mail</p>
                        <p class="font-semibold text-gray-800">{{ $company->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Telefone</p>
                        <p class="font-semibold text-gray-800">{{ $company->telefone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Endereço</p>
                        <p class="font-semibold text-gray-800">{{ $company->endereco }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Cadastro</p>
                        <p class="font-semibold text-gray-800">{{ $company->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Stats -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-blue-100 text-sm">Produtos</p>
                                <h3 class="text-3xl font-bold mt-2">{{ $companyStats['total_products'] }}</h3>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg">
                                <i class="fas fa-box text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-green-100 text-sm">Valor Estoque</p>
                                <h3 class="text-2xl font-bold mt-2">R$
                                    {{ number_format($companyStats['total_stock_value'], 2, ',', '.') }}</h3>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg">
                                <i class="fas fa-dollar-sign text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-red-100 text-sm">Estoque Baixo</p>
                                <h3 class="text-3xl font-bold mt-2">{{ $companyStats['low_stock_products'] }}</h3>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg">
                                <i class="fas fa-exclamation-triangle text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-purple-100 text-sm">Movimentações (7d)</p>
                                <h3 class="text-3xl font-bold mt-2">{{ $companyStats['recent_movements'] }}</h3>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg">
                                <i class="fas fa-exchange-alt text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Products -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-bold text-gray-800">Produtos Cadastrados</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantidade</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($company->products->take(10) as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $product->sku }}</div>
                                </td>
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
                                    <span
                                        class="px-3 py-1 {{ $product->quantity <= 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} rounded-full text-sm font-semibold">
                                        {{ $product->quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">R$
                                    {{ number_format($product->price, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Nenhum produto cadastrado
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($company->products->count() > 10)
                <div class="p-4 bg-gray-50 text-center">
                    <p class="text-sm text-gray-600">Mostrando 10 de {{ $company->products->count() }} produtos</p>
                </div>
            @endif
        </div>

        <!-- Recent Movements -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-bold text-gray-800">Movimentações Recentes</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantidade</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Valor Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($company->movements()->with('product')->latest('movement_date')->take(10)->get() as $movement)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($movement->movement_date)->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    @if ($movement->type === 'entrada')
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                            <i class="fas fa-arrow-down mr-1"></i>Entrada
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                                            <i class="fas fa-arrow-up mr-1"></i>Saída
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800">{{ $movement->product->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $movement->description }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $movement->quantity }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">R$
                                    {{ number_format($movement->total_price, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Nenhuma movimentação
                                    registrada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
