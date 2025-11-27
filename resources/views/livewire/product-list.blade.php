<div class="py-12 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (isset($noCompanySelected) && $noCompanySelected)
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-400 p-6 rounded-lg shadow-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-yellow-800">Nenhuma empresa selecionada</h3>
                        <p class="mt-2 text-yellow-700">Para gerenciar produtos, você precisa selecionar uma empresa
                            primeiro.</p>
                        <a href="{{ route('dashboard') }}"
                            class="mt-4 inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Selecionar Empresa
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    @if (session()->has('message'))
                        <div
                            class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded mb-4">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Gerenciamento de Estoque</h2>
                        <div class="flex gap-2">
                            <!-- Botões de Exportação -->
                            <div class="flex gap-1 mr-2">
                                <a href="{{ route('reports.products.pdf') }}" target="_blank"
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded inline-flex items-center"
                                    title="Exportar para PDF">
                                    <i class="fas fa-file-pdf mr-1"></i>PDF
                                </a>
                                <a href="{{ route('reports.products.excel') }}"
                                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-3 rounded inline-flex items-center"
                                    title="Exportar para Excel">
                                    <i class="fas fa-file-excel mr-1"></i>Excel
                                </a>
                            </div>
                            <a href="{{ route('products.create') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-plus mr-2"></i>Novo Produto
                            </a>
                        </div>
                    </div>

                    <div class="mb-4">
                        <input wire:model="search" type="text" placeholder="Buscar por nome ou SKU..."
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <div class="overflow-x-auto">
                        <table id="productsTable" class="min-w-full divide-y divide-gray-200 display stripe hover">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Imagem</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        SKU</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nome</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Categoria</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descrição</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Preço</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Quantidade</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($products as $product)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="h-12 w-12 object-cover rounded border dark:border-gray-600">
                                            @else
                                                <div
                                                    class="h-12 w-12 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                                                    <i class="fas fa-box text-gray-400"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                            {{ $product->sku }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $product->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($product->category)
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                    style="background-color: {{ $product->category->color }}20; color: {{ $product->category->color }};">
                                                    {{ $product->category->name }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ Str::limit($product->description, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200"
                                            data-order="{{ $product->price }}">R$
                                            {{ number_format($product->price, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200"
                                            data-order="{{ $product->quantity }}">{{ $product->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->quantity > 10 ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : ($product->quantity > 0 ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300') }}">
                                                {{ $product->quantity > 10 ? 'Em Estoque' : ($product->quantity > 0 ? 'Estoque Baixo' : 'Sem Estoque') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('products.show', $product->id) }}"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3"
                                                title="Ver detalhes">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3"
                                                title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button wire:click="confirmDelete({{ $product->id }})"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                title="Excluir">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                            Nenhum produto encontrado.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if ($showDeleteModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div
                    class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-80 transition-opacity">
                </div>
                <div
                    class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Confirmar Exclusão</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tem certeza que deseja excluir este produto?
                        </p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="deleteProduct"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                            Excluir
                        </button>
                        <button wire:click="$set('showDeleteModal', false)"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (jQuery().DataTable) {
                    $('#productsTable').DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json"
                        },
                        "pageLength": 25,
                        "order": [
                            [0, "asc"]
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
                                className: 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2'
                            },
                            {
                                extend: 'pdf',
                                text: '<i class="fas fa-file-pdf"></i> PDF',
                                className: 'bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2'
                            },
                            {
                                extend: 'print',
                                text: '<i class="fas fa-print"></i> Imprimir',
                                className: 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'
                            }
                        ],
                        "columnDefs": [{
                            "orderable": false,
                            "targets": -1
                        }]
                    });
                }
            });

            // Reinitialize DataTable on Livewire updates
            Livewire.hook('message.processed', (message, component) => {
                if (jQuery().DataTable && $('#productsTable').length) {
                    if ($.fn.DataTable.isDataTable('#productsTable')) {
                        $('#productsTable').DataTable().destroy();
                    }
                    $('#productsTable').DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json"
                        },
                        "pageLength": 25,
                        "order": [
                            [0, "asc"]
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
                                className: 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2'
                            },
                            {
                                extend: 'pdf',
                                text: '<i class="fas fa-file-pdf"></i> PDF',
                                className: 'bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2'
                            },
                            {
                                extend: 'print',
                                text: '<i class="fas fa-print"></i> Imprimir',
                                className: 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'
                            }
                        ],
                        "columnDefs": [{
                            "orderable": false,
                            "targets": -1
                        }]
                    });
                }
            });
        </script>
    @endif
</div>
