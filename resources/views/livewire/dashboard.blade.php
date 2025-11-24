<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Modern Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <div class="stat-card stat-card-blue relative overflow-hidden animate-fadeInUp">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-boxes text-3xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-semibold backdrop-blur-sm">
                            PRODUTOS
                        </span>
                    </div>
                    <h3 class="text-5xl font-black mb-2">{{ $totalProducts }}</h3>
                    <p class="text-white/90 font-medium">Total de Produtos</p>
                    <div class="mt-4 flex items-center text-sm">
                        <i class="fas fa-cube mr-2"></i>
                        <span>Cadastrados no sistema</span>
                    </div>
                </div>
            </div>

            <div class="stat-card stat-card-purple relative overflow-hidden animate-fadeInUp"
                style="animation-delay: 0.1s;">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-money-bill-wave text-3xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-semibold backdrop-blur-sm">
                            ESTOQUE
                        </span>
                    </div>
                    <h3 class="text-3xl font-black mb-2">R$ {{ number_format($totalValue, 2, ',', '.') }}</h3>
                    <p class="text-white/90 font-medium">Valor Total em Estoque</p>
                    <div class="mt-4 flex items-center text-sm">
                        <i class="fas fa-warehouse mr-2"></i>
                        <span>Inventário completo</span>
                    </div>
                </div>
            </div>

            <div class="stat-card stat-card-red relative overflow-hidden animate-fadeInUp"
                style="animation-delay: 0.2s;">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-exclamation-triangle text-3xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-semibold backdrop-blur-sm">
                            ALERTA
                        </span>
                    </div>
                    <h3 class="text-5xl font-black mb-2">{{ $lowStockProducts }}</h3>
                    <p class="text-white/90 font-medium">Produtos Estoque Baixo</p>
                    <div class="mt-4 flex items-center text-sm">
                        <i class="fas fa-bell mr-2"></i>
                        <span>Requer atenção</span>
                    </div>
                </div>
            </div>

            <div class="stat-card stat-card-green relative overflow-hidden animate-fadeInUp"
                style="animation-delay: 0.3s;">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-chart-line text-3xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-semibold backdrop-blur-sm">
                            LUCRO
                        </span>
                    </div>
                    <h3 class="text-3xl font-black mb-2">R$ {{ number_format($totalGanhos, 2, ',', '.') }}</h3>
                    <p class="text-white/90 font-medium">Ganhos Totais</p>
                    <div class="mt-4 flex items-center text-sm">
                        <i class="fas fa-trending-up mr-2"></i>
                        <span>Resultado acumulado</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modern Financial Summary -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div
                class="modern-card p-6 bg-gradient-to-br from-white to-blue-50 hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Entradas</p>
                        <p class="text-3xl font-black text-blue-600">R$ {{ number_format($totalEntradas, 2, ',', '.') }}
                        </p>
                        <div class="mt-3 flex items-center text-xs text-blue-600 font-semibold">
                            <div class="w-2 h-2 bg-blue-600 rounded-full mr-2 animate-pulse"></div>
                            Movimentações positivas
                        </div>
                    </div>
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-arrow-down text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="modern-card p-6 bg-gradient-to-br from-white to-red-50 hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Saídas</p>
                        <p class="text-3xl font-black text-red-600">R$ {{ number_format($totalSaidas, 2, ',', '.') }}
                        </p>
                        <div class="mt-3 flex items-center text-xs text-red-600 font-semibold">
                            <div class="w-2 h-2 bg-red-600 rounded-full mr-2 animate-pulse"></div>
                            Movimentações negativas
                        </div>
                    </div>
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-red-500 to-rose-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-arrow-up text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="modern-card p-6 bg-gradient-to-br from-white to-green-50 hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Lucro Bruto</p>
                        <p class="text-3xl font-black text-green-600">R$ {{ number_format($totalGanhos, 2, ',', '.') }}
                        </p>
                        <div class="mt-3 flex items-center text-xs text-green-600 font-semibold">
                            <div class="w-2 h-2 bg-green-600 rounded-full mr-2 animate-pulse"></div>
                            Resultado acumulado
                        </div>
                    </div>
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-chart-bar text-white text-2xl"></i>
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
