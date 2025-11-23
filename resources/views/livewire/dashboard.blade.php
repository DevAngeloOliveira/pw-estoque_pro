<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Total de Produtos</p>
                        <p class="text-3xl font-bold">{{ $totalProducts }}</p>
                    </div>
                    <div class="bg-blue-400 rounded-full p-4">
                        <i class="fas fa-boxes text-3xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">Valor Total em Estoque</p>
                        <p class="text-2xl font-bold">R$ {{ number_format($totalValue, 2, ',', '.') }}</p>
                    </div>
                    <div class="bg-purple-400 rounded-full p-4">
                        <i class="fas fa-money-bill-wave text-3xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm">Produtos Estoque Baixo</p>
                        <p class="text-3xl font-bold">{{ $lowStockProducts }}</p>
                    </div>
                    <div class="bg-red-400 rounded-full p-4">
                        <i class="fas fa-exclamation-triangle text-3xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm">Ganhos Totais</p>
                        <p class="text-2xl font-bold">R$ {{ number_format($totalGanhos, 2, ',', '.') }}</p>
                    </div>
                    <div class="bg-green-400 rounded-full p-4">
                        <i class="fas fa-chart-line text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumo Financeiro -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 rounded-full p-3 mr-3">
                        <i class="fas fa-arrow-down text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Entradas</p>
                        <p class="text-xl font-bold text-blue-600">R$ {{ number_format($totalEntradas, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-red-100 rounded-full p-3 mr-3">
                        <i class="fas fa-arrow-up text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Saídas</p>
                        <p class="text-xl font-bold text-red-600">R$ {{ number_format($totalSaidas, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-green-100 rounded-full p-3 mr-3">
                        <i class="fas fa-chart-bar text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Lucro Bruto</p>
                        <p class="text-xl font-bold text-green-600">R$ {{ number_format($totalGanhos, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Gráfico de Movimentações -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-chart-area text-blue-500 mr-2"></i>
                        Movimentações (Últimos 7 dias)
                    </h3>
                    <a href="{{ route('reports.dashboard.pdf') }}" target="_blank"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm inline-flex items-center"
                        title="Exportar Relatório Geral">
                        <i class="fas fa-file-pdf mr-1"></i>Exportar Dashboard
                    </a>
                </div>
                <div style="height: 300px; position: relative;">
                    <canvas id="movimentacoesChart"></canvas>
                </div>
            </div>

            <!-- Gráfico de Tipos de Movimento -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-pie text-purple-500 mr-2"></i>
                    Entradas vs Saídas
                </h3>
                <div style="height: 300px; position: relative;">
                    <canvas id="tiposMovimentoChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Top Produtos Vendidos -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-fire text-orange-500 mr-2"></i>
                    Top 5 Produtos Mais Vendidos (30 dias)
                </h3>
                <div class="space-y-3">
                    @forelse($topProducts as $index => $movement)
                        <div
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center">
                                <div
                                    class="bg-gradient-to-br from-orange-400 to-orange-500 text-white rounded-full h-8 w-8 flex items-center justify-center font-bold mr-3">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $movement->product->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $movement->total_quantity }} unidades</p>
                                </div>
                            </div>
                            <p class="font-bold text-green-600">R$
                                {{ number_format($movement->total_value, 2, ',', '.') }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Nenhuma venda registrada</p>
                    @endforelse
                </div>
            </div>

            <!-- Alertas de Estoque Baixo -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    Alertas de Estoque Baixo
                </h3>
                <div class="space-y-3">
                    @forelse($lowStockList as $product)
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg border border-red-200">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500">SKU: {{ $product->sku }}</p>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded-full">
                                    {{ $product->quantity }} un.
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle text-green-500 text-3xl mb-2"></i>
                            <p class="text-gray-500">Todos os produtos com estoque adequado</p>
                        </div>
                    @endforelse
                </div>
                @if ($lowStockList->count() > 0)
                    <a href="{{ route('products.index') }}"
                        class="mt-4 block text-center text-blue-600 hover:text-blue-800 font-semibold">
                        Ver todos os produtos →
                    </a>
                @endif
            </div>
        </div>

        <!-- Últimas Movimentações -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center justify-between">
                <span><i class="fas fa-history mr-2"></i>Últimas Movimentações</span>
                <a href="{{ route('movements.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Ver todas
                    →</a>
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Qtd.</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Valor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentMovements as $movement)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    {{ $movement->movement_date->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="font-medium text-gray-900">{{ $movement->product->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $movement->product->sku }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full {{ $movement->type === 'entrada' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($movement->type) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $movement->quantity }}</td>
                                <td
                                    class="px-4 py-3 text-sm font-semibold {{ $movement->type === 'entrada' ? 'text-blue-600' : 'text-green-600' }}">
                                    R$ {{ number_format($movement->total_price, 2, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                    Nenhuma movimentação registrada ainda
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dados do gráfico vindos do backend
        const chartData = @json($chartData);

        // Extrair labels e dados
        const labels = chartData.map(item => item.date);
        const entradasData = chartData.map(item => item.entradas);
        const saidasData = chartData.map(item => item.saidas);

        // Calcular valor máximo para definir escala adequada
        const maxValue = Math.max(...entradasData, ...saidasData);
        const yAxisMax = maxValue > 0 ? Math.ceil(maxValue * 1.2) : 100;

        // Gráfico de Movimentações (Linha)
        const movCtx = document.getElementById('movimentacoesChart');
        if (movCtx) {
            new Chart(movCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Entradas (R$)',
                            data: entradasData,
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.4,
                            fill: true,
                            borderWidth: 2
                        },
                        {
                            label: 'Saídas (R$)',
                            data: saidasData,
                            borderColor: 'rgb(239, 68, 68)',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            tension: 0.4,
                            fill: true,
                            borderWidth: 2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += 'R$ ' + context.parsed.y.toLocaleString('pt-BR', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: yAxisMax,
                            ticks: {
                                stepSize: yAxisMax > 100 ? Math.ceil(yAxisMax / 5) : 20,
                                callback: function(value) {
                                    return 'R$ ' + value.toFixed(2);
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            }
                        }
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    elements: {
                        point: {
                            radius: 4,
                            hitRadius: 10,
                            hoverRadius: 6
                        }
                    }
                }
            });
        }

        // Gráfico de Pizza
        const tiposCtx = document.getElementById('tiposMovimentoChart');
        if (tiposCtx) {
            new Chart(tiposCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Entradas', 'Saídas'],
                    datasets: [{
                        data: [{{ $totalEntradas }}, {{ $totalSaidas }}],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(239, 68, 68, 0.8)'
                        ],
                        borderColor: [
                            'rgb(59, 130, 246)',
                            'rgb(239, 68, 68)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += 'R$ ' + context.parsed.toLocaleString('pt-BR', {
                                        minimumFractionDigits: 2
                                    });
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
