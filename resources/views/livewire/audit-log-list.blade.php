<div class="py-12 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Cards de Resumo -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Total de Registros</p>
                        <p class="text-3xl font-bold">{{ $totalLogs }}</p>
                    </div>
                    <div class="bg-blue-400 rounded-full p-4">
                        <i class="fas fa-clipboard-list text-3xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm">Hoje</p>
                        <p class="text-3xl font-bold">{{ $todayLogs }}</p>
                    </div>
                    <div class="bg-green-400 rounded-full p-4">
                        <i class="fas fa-calendar-day text-3xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">Últimos 7 Dias</p>
                        <p class="text-3xl font-bold">{{ $weekLogs }}</p>
                    </div>
                    <div class="bg-purple-400 rounded-full p-4">
                        <i class="fas fa-chart-line text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                        <i class="fas fa-history mr-2"></i>Auditoria do Sistema
                    </h2>
                </div>

                <!-- Filtros -->
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                    <input wire:model="search" type="text" placeholder="Buscar por ID do registro..."
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">

                    <select wire:model="actionFilter"
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">Todas as Ações</option>
                        <option value="created">Criado</option>
                        <option value="updated">Atualizado</option>
                        <option value="deleted">Excluído</option>
                    </select>

                    <select wire:model="modelFilter"
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">Todos os Módulos</option>
                        <option value="App\Models\Product">Produtos</option>
                        <option value="App\Models\ProductMovement">Movimentações</option>
                    </select>

                    <input wire:model="dateFrom" type="date"
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">

                    <input wire:model="dateTo" type="date"
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="mb-4 flex justify-between items-center">
                    <button wire:click="clearFilters"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-times mr-2"></i>Limpar Filtros
                    </button>
                </div>

                <!-- Tabela de Logs -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Data/Hora</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ação</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Módulo</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID Registro</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Usuário</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    IP</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Detalhes</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($auditLogs as $log)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $log->created_at->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($log->action === 'created')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-plus mr-1"></i>{{ $log->action_label }}
                                            </span>
                                        @elseif($log->action === 'updated')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                <i class="fas fa-edit mr-1"></i>{{ $log->action_label }}
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                <i class="fas fa-trash mr-1"></i>{{ $log->action_label }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $log->model_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        #{{ $log->auditable_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $log->company->razao_social ?? 'Sistema' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $log->ip_address }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @if ($log->action === 'updated' && $log->old_values)
                                            <details class="cursor-pointer">
                                                <summary class="text-blue-600 hover:text-blue-800">
                                                    Ver mudanças
                                                </summary>
                                                <div class="mt-2 p-2 bg-gray-50 rounded text-xs">
                                                    @foreach ($log->new_values as $key => $value)
                                                        <div class="mb-1">
                                                            <strong>{{ ucfirst($key) }}:</strong><br>
                                                            <span class="text-red-600">-
                                                                {{ $log->old_values[$key] ?? 'N/A' }}</span><br>
                                                            <span class="text-green-600">+ {{ $value }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </details>
                                        @elseif($log->action === 'created' && $log->new_values)
                                            <details class="cursor-pointer">
                                                <summary class="text-blue-600 hover:text-blue-800">
                                                    Ver dados
                                                </summary>
                                                <div class="mt-2 p-2 bg-gray-50 rounded text-xs">
                                                    @foreach ($log->new_values as $key => $value)
                                                        <div><strong>{{ ucfirst($key) }}:</strong> {{ $value }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </details>
                                        @elseif($log->action === 'deleted' && $log->old_values)
                                            <details class="cursor-pointer">
                                                <summary class="text-blue-600 hover:text-blue-800">
                                                    Ver dados removidos
                                                </summary>
                                                <div class="mt-2 p-2 bg-gray-50 rounded text-xs">
                                                    @foreach ($log->old_values as $key => $value)
                                                        <div><strong>{{ ucfirst($key) }}:</strong> {{ $value }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </details>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                        Nenhum registro de auditoria encontrado
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="mt-4">
                    {{ $auditLogs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
