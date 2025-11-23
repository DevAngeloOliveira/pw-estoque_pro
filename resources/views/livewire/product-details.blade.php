<div class="space-y-6">
    <!-- Header com Informações Principais -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-white">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                    <p class="text-blue-100">SKU: {{ $product->sku }}</p>
                    @if ($product->description)
                        <p class="mt-2 text-blue-50">{{ $product->description }}</p>
                    @endif
                </div>
                @if ($product->image)
                    <div class="ml-6">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-32 h-32 object-cover rounded-lg border-4 border-white shadow-lg">
                    </div>
                @else
                    <div class="ml-6">
                        <div class="w-32 h-32 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-white text-5xl"></i>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Preço -->
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Preço Unitário</p>
                    <p class="text-3xl font-bold text-green-600">R$ {{ number_format($product->price, 2, ',', '.') }}
                    </p>
                </div>

                <!-- Quantidade -->
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Quantidade</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $product->quantity }}</p>
                    <p class="text-xs text-gray-500 mt-1">unidades</p>
                </div>

                <!-- Valor Total -->
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Valor em Estoque</p>
                    <p class="text-2xl font-bold text-purple-600">R$
                        {{ number_format($stats['stock_value'], 2, ',', '.') }}</p>
                </div>

                <!-- Status -->
                <div
                    class="text-center p-4 bg-{{ $stats['stock_status']['status'] === 'success' ? 'green' : ($stats['stock_status']['status'] === 'warning' ? 'yellow' : 'red') }}-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Status</p>
                    <p
                        class="text-xl font-bold text-{{ $stats['stock_status']['status'] === 'success' ? 'green' : ($stats['stock_status']['status'] === 'warning' ? 'yellow' : 'red') }}-600">
                        <i class="fas {{ $stats['stock_status']['icon'] }} mr-1"></i>
                        {{ $stats['stock_status']['text'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Informações Adicionais -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Detalhes do Produto -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                Informações do Produto
            </h2>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Categoria:</span>
                    <span class="font-semibold">
                        @if ($product->category)
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                {{ $product->category->name }}
                            </span>
                        @else
                            <span class="text-gray-400">Sem categoria</span>
                        @endif
                    </span>
                </div>

                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Fornecedor:</span>
                    <span class="font-semibold">
                        @if ($product->supplier)
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                                {{ $product->supplier->name }}
                            </span>
                        @else
                            <span class="text-gray-400">Sem fornecedor</span>
                        @endif
                    </span>
                </div>

                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">SKU:</span>
                    <span class="font-mono font-semibold">{{ $product->sku }}</span>
                </div>

                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Cadastrado em:</span>
                    <span class="font-semibold">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <div class="flex justify-between py-2">
                    <span class="text-gray-600">Última atualização:</span>
                    <span class="font-semibold">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <div class="mt-6 flex space-x-3">
                <a href="{{ route('products.edit', $product->id) }}"
                    class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-center">
                    <i class="fas fa-edit mr-2"></i>Editar Produto
                </a>
                <button wire:click="$emit('openMovementModal', {{ $product->id }})"
                    class="flex-1 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-center">
                    <i class="fas fa-plus mr-2"></i>Nova Movimentação
                </button>
            </div>
        </div>

        <!-- Estatísticas (Últimos 30 dias) -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chart-line mr-2 text-green-600"></i>
                Estatísticas (30 dias)
            </h2>

            <div class="space-y-4">
                <!-- Total de Movimentações -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total de Movimentações</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_movements'] }}</p>
                        </div>
                        <div class="text-3xl text-gray-400">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                    </div>
                </div>

                <!-- Entradas -->
                <div class="bg-green-50 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <p class="text-sm text-gray-600">Entradas</p>
                            <p class="text-2xl font-bold text-green-600">{{ $stats['entradas_qty'] }}</p>
                            <p class="text-xs text-gray-500">unidades</p>
                        </div>
                        <div class="text-3xl text-green-400">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">
                        Valor: <span class="font-semibold">R$
                            {{ number_format($stats['entradas_value'], 2, ',', '.') }}</span>
                    </p>
                </div>

                <!-- Saídas -->
                <div class="bg-red-50 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <p class="text-sm text-gray-600">Saídas</p>
                            <p class="text-2xl font-bold text-red-600">{{ $stats['saidas_qty'] }}</p>
                            <p class="text-xs text-gray-500">unidades</p>
                        </div>
                        <div class="text-3xl text-red-400">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">
                        Valor: <span class="font-semibold">R$
                            {{ number_format($stats['saidas_value'], 2, ',', '.') }}</span>
                    </p>
                </div>

                <!-- Média Diária e Última Movimentação -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 rounded-lg p-3 text-center">
                        <p class="text-xs text-gray-600 mb-1">Média Diária</p>
                        <p class="text-xl font-bold text-blue-600">{{ $stats['daily_avg'] }}</p>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-3 text-center">
                        <p class="text-xs text-gray-600 mb-1">Última Mov.</p>
                        <p class="text-sm font-bold text-purple-600">
                            @if ($stats['last_movement_date'])
                                {{ \Carbon\Carbon::parse($stats['last_movement_date'])->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Movimentações -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-chart-area mr-2 text-indigo-600"></i>
            Histórico de Movimentações (30 dias)
        </h2>
        <div class="h-80">
            <canvas id="movementChart"></canvas>
        </div>
    </div>

    <!-- Movimentações Recentes -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-history mr-2 text-gray-600"></i>
                Movimentações Recentes
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantidade</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço Unit.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Observação</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($recentMovements as $movement)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($movement->movement_date)->format('d/m/Y') }}
                            </td>
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
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                                {{ $movement->quantity }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                R$ {{ number_format($movement->unit_price, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                                R$ {{ number_format($movement->total_price, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $movement->observation ?: '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <p>Nenhuma movimentação registrada</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (count($recentMovements) > 0)
            <div class="p-4 bg-gray-50 text-center">
                <a href="{{ route('movements.index') }}" class="text-blue-600 hover:text-blue-800">
                    Ver todas as movimentações <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('movementChart');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                            label: 'Entradas',
                            data: @json($chartData['entradas']),
                            borderColor: 'rgb(34, 197, 94)',
                            backgroundColor: 'rgba(34, 197, 94, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Saídas',
                            data: @json($chartData['saidas']),
                            borderColor: 'rgb(239, 68, 68)',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        });
    </script>
@endpush
