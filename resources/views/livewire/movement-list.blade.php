<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (isset($noCompanySelected) && $noCompanySelected)
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-lg shadow-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-yellow-800">Nenhuma empresa selecionada</h3>
                        <p class="mt-2 text-yellow-700">Para ver as movimentações, você precisa selecionar uma empresa
                            primeiro.</p>
                        <a href="{{ route('dashboard') }}"
                            class="mt-4 inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Selecionar Empresa
                        </a>
                    </div>
                </div>
            </div>
        @else
            @if (session()->has('message'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Cards de Resumo -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">Total em Entradas</p>
                            <p class="text-3xl font-bold">R$ {{ number_format($totalEntradas, 2, ',', '.') }}</p>
                        </div>
                        <div class="bg-blue-400 rounded-full p-4">
                            <i class="fas fa-arrow-down text-3xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-100 text-sm">Total em Saídas</p>
                            <p class="text-3xl font-bold">R$ {{ number_format($totalSaidas, 2, ',', '.') }}</p>
                        </div>
                        <div class="bg-red-400 rounded-full p-4">
                            <i class="fas fa-arrow-up text-3xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm">Ganhos (Saídas - Entradas)</p>
                            <p class="text-3xl font-bold">R$ {{ number_format($totalGanhos, 2, ',', '.') }}</p>
                        </div>
                        <div class="bg-green-400 rounded-full p-4">
                            <i class="fas fa-chart-line text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">
                            <i class="fas fa-list mr-2"></i>Histórico de Movimentações
                        </h2>
                        <div class="flex gap-2">
                            <!-- Botões de Exportação -->
                            <div class="flex gap-1 mr-2">
                                <a href="{{ route('reports.movements.pdf', ['search' => $search, 'filterType' => $filterType, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]) }}"
                                    target="_blank"
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded inline-flex items-center"
                                    title="Exportar para PDF">
                                    <i class="fas fa-file-pdf mr-1"></i>PDF
                                </a>
                                <a href="{{ route('reports.movements.excel', ['search' => $search, 'filterType' => $filterType, 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]) }}"
                                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-3 rounded inline-flex items-center"
                                    title="Exportar para Excel">
                                    <i class="fas fa-file-excel mr-1"></i>Excel
                                </a>
                            </div>
                            <a href="{{ route('movements.create') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-plus mr-2"></i>Nova Movimentação
                            </a>
                        </div>
                    </div>

                    <!-- Filtros -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <input wire:model="search" type="text" placeholder="Buscar produto..."
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">

                        <select wire:model="filterType"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <option value="">Todos os tipos</option>
                            <option value="entrada">Entradas</option>
                            <option value="saida">Saídas</option>
                        </select>

                        <input wire:model="dateFrom" type="date" placeholder="Data inicial"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">

                        <input wire:model="dateTo" type="date" placeholder="Data final"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>

                    <button wire:click="clearFilters"
                        class="mb-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-times mr-2"></i>Limpar Filtros
                    </button>

                    <div class="overflow-x-auto">
                        <table id="movementsTable" class="min-w-full divide-y divide-gray-200 display stripe hover">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qtd.
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço
                                        Unit.</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Descrição</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($movements as $movement)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $movement->movement_date->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="font-medium">{{ $movement->product->name }}</div>
                                            <div class="text-gray-500 text-xs">{{ $movement->product->sku }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $movement->type === 'entrada' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                                                <i
                                                    class="fas fa-arrow-{{ $movement->type === 'entrada' ? 'down' : 'up' }} mr-1"></i>
                                                {{ ucfirst($movement->type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $movement->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            R$ {{ number_format($movement->unit_price, 2, ',', '.') }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $movement->type === 'entrada' ? 'text-blue-600' : 'text-green-600' }}">
                                            R$ {{ number_format($movement->total_price, 2, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $movement->description ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            Nenhuma movimentação encontrada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $movements->links() }}
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    if (jQuery().DataTable) {
                        $('#movementsTable').DataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json"
                            },
                            "pageLength": 25,
                            "order": [
                                [0, "desc"]
                            ],
                            "dom": 'Bfrtip',
                            "buttons": [{
                                    extend: 'copy',
                                    text: '<i class="fas fa-copy"></i> Copiar',
                                    className: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2'
                                },
                                {
                                    extend: 'excel',
                                    text: '<i class="fas fa-file-excel"></i> Excel',
                                    className: 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    text: '<i class="fas fa-file-pdf"></i> PDF',
                                    className: 'bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    }
                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fas fa-print"></i> Imprimir',
                                    className: 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'
                                }
                            ]
                        });
                    }
                });
            </script>
        @endif
    </div>
</div>
