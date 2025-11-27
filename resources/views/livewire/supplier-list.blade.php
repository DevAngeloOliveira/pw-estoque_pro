<div>
    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <!-- Header com Toggle de Modo -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                                <i class="fas fa-truck text-blue-500"></i> Fornecedores
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                @if ($useGlobalSuppliers)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                                        <i class="fas fa-globe mr-1"></i> Usando fornecedores do sistema
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                        <i class="fas fa-building mr-1"></i> Usando fornecedores próprios
                                    </span>
                                @endif
                            </p>
                        </div>
                        <div class="flex gap-3">
                            <button wire:click="toggleSupplierMode"
                                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded flex items-center"
                                title="Alternar entre fornecedores do sistema e próprios">
                                <i class="fas fa-sync-alt mr-2"></i>
                                {{ $useGlobalSuppliers ? 'Usar Próprios' : 'Usar do Sistema' }}
                            </button>
                            @if (!$useGlobalSuppliers)
                                <button wire:click="openModal"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fas fa-plus"></i> Novo Fornecedor
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div
                        class="mb-4 p-4 rounded-lg {{ $useGlobalSuppliers ? 'bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800' : 'bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800' }}">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i
                                    class="fas fa-info-circle text-lg {{ $useGlobalSuppliers ? 'text-purple-600 dark:text-purple-400' : 'text-blue-600 dark:text-blue-400' }}"></i>
                            </div>
                            <div class="ml-3">
                                <h3
                                    class="text-sm font-medium {{ $useGlobalSuppliers ? 'text-purple-800 dark:text-purple-300' : 'text-blue-800 dark:text-blue-300' }}">
                                    {{ $useGlobalSuppliers ? 'Modo: Fornecedores do Sistema' : 'Modo: Fornecedores Próprios' }}
                                </h3>
                                <div
                                    class="mt-2 text-sm {{ $useGlobalSuppliers ? 'text-purple-700 dark:text-purple-400' : 'text-blue-700 dark:text-blue-400' }}">
                                    @if ($useGlobalSuppliers)
                                        <p>Você está utilizando a base de fornecedores pré-cadastrados do sistema. Não é
                                            possível editar ou excluir estes fornecedores.</p>
                                    @else
                                        <p>Você está gerenciando seus próprios fornecedores. Você tem controle total
                                            para criar, editar e excluir fornecedores.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="mb-4">
                        <input wire:model.debounce.300ms="search" type="text"
                            placeholder="Buscar por nome, razão social ou CNPJ..."
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                    </div>

                    <!-- Suppliers Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fornecedor
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        CNPJ
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contato
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Localização
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Produtos
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    @if (!$useGlobalSuppliers)
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ações
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($suppliers as $supplier)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="text-sm">
                                                <div class="font-medium text-gray-900">{{ $supplier->name }}</div>
                                                @if ($supplier->legal_name)
                                                    <div class="text-gray-500">{{ $supplier->legal_name }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $supplier->formatted_cnpj ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                @if ($supplier->email)
                                                    <div><i
                                                            class="fas fa-envelope text-gray-400 mr-1"></i>{{ $supplier->email }}
                                                    </div>
                                                @endif
                                                @if ($supplier->phone)
                                                    <div><i
                                                            class="fas fa-phone text-gray-400 mr-1"></i>{{ $supplier->formatted_phone }}
                                                    </div>
                                                @endif
                                                @if ($supplier->whatsapp)
                                                    <div><i
                                                            class="fab fa-whatsapp text-green-500 mr-1"></i>{{ $supplier->whatsapp }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if ($supplier->city && $supplier->state)
                                                {{ $supplier->city }}/{{ $supplier->state }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $supplier->products_count }} produto(s)
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($supplier->active)
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Ativo
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Inativo
                                                </span>
                                            @endif
                                            @if ($supplier->isGlobal())
                                                <span
                                                    class="ml-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                    <i class="fas fa-globe mr-1"></i>Sistema
                                                </span>
                                            @endif
                                        </td>
                                        @if (!$useGlobalSuppliers)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button wire:click="openModal({{ $supplier->id }})"
                                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button wire:click="toggleActive({{ $supplier->id }})"
                                                    class="text-yellow-600 hover:text-yellow-900 mr-3"
                                                    title="{{ $supplier->active ? 'Desativar' : 'Ativar' }}">
                                                    <i
                                                        class="fas fa-{{ $supplier->active ? 'eye-slash' : 'eye' }}"></i>
                                                </button>
                                                @if ($supplier->products_count == 0)
                                                    <button wire:click="delete({{ $supplier->id }})"
                                                        onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')"
                                                        class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $useGlobalSuppliers ? '6' : '7' }}"
                                            class="px-6 py-4 text-center text-gray-500">
                                            Nenhum fornecedor encontrado.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed z-10 inset-0 overflow-y-auto" style="display: block;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-80 transition-opacity"
                    wire:click="closeModal"></div>

                <div
                    class="relative bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="bg-white dark:bg-gray-800 px-6 pt-5 pb-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                {{ $supplierId ? 'Editar Fornecedor' : 'Novo Fornecedor' }}
                            </h3>
                            <button wire:click="closeModal"
                                class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form wire:submit.prevent="save">
                            <!-- Dados Principais -->
                            <div class="mb-6">
                                <h4
                                    class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-3 border-b dark:border-gray-600 pb-2">
                                    <i class="fas fa-building text-blue-500 mr-2"></i>Dados Principais
                                </h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="col-span-2">
                                        <label for="name"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Nome Fantasia *
                                        </label>
                                        <input wire:model="name" type="text" id="name"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('name') border-red-500 @enderror">
                                        @error('name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-span-2">
                                        <label for="legal_name"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Razão Social
                                        </label>
                                        <input wire:model="legal_name" type="text" id="legal_name"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    </div>

                                    <div>
                                        <label for="cnpj"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            CNPJ
                                        </label>
                                        <input wire:model="cnpj" type="text" id="cnpj"
                                            placeholder="00.000.000/0000-00" maxlength="18"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 @error('cnpj') border-red-500 @enderror">
                                        @error('cnpj')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="website"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Website
                                        </label>
                                        <input wire:model="website" type="url" id="website"
                                            placeholder="https://example.com"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Contato -->
                            <div class="mb-6">
                                <h4 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">
                                    <i class="fas fa-phone text-blue-500 mr-2"></i>Contato
                                </h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                            E-mail
                                        </label>
                                        <input wire:model="email" type="email" id="email"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                            Telefone
                                        </label>
                                        <input wire:model="phone" type="text" id="phone"
                                            placeholder="(00) 0000-0000"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    </div>

                                    <div class="col-span-2">
                                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                                            WhatsApp
                                        </label>
                                        <input wire:model="whatsapp" type="text" id="whatsapp"
                                            placeholder="(00) 00000-0000"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Endereço -->
                            <div class="mb-6">
                                <h4 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">
                                    <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>Endereço
                                </h4>
                                <div class="grid grid-cols-4 gap-4">
                                    <div class="col-span-2">
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                            Logradouro
                                        </label>
                                        <input wire:model="address" type="text" id="address"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="address_number"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            Número
                                        </label>
                                        <input wire:model="address_number" type="text" id="address_number"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="complement" class="block text-sm font-medium text-gray-700 mb-2">
                                            Complemento
                                        </label>
                                        <input wire:model="complement" type="text" id="complement"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    </div>

                                    <div class="col-span-2">
                                        <label for="neighborhood"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            Bairro
                                        </label>
                                        <input wire:model="neighborhood" type="text" id="neighborhood"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                            Cidade
                                        </label>
                                        <input wire:model="city" type="text" id="city"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="state" class="block text-sm font-medium text-gray-700 mb-2">
                                            UF
                                        </label>
                                        <input wire:model="state" type="text" id="state" maxlength="2"
                                            placeholder="SP"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 uppercase">
                                    </div>

                                    <div class="col-span-2">
                                        <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-2">
                                            CEP
                                        </label>
                                        <input wire:model="zip_code" type="text" id="zip_code"
                                            placeholder="00000-000"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Observações -->
                            <div class="mb-6">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                    Observações
                                </label>
                                <textarea wire:model="notes" id="notes" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"></textarea>
                            </div>

                            <!-- Status -->
                            <div class="mb-6">
                                <label class="flex items-center">
                                    <input wire:model="active" type="checkbox"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Fornecedor ativo</span>
                                </label>
                            </div>

                            <!-- Botões -->
                            <div class="flex justify-end space-x-3 pt-4 border-t">
                                <button type="button" wire:click="closeModal"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                    {{ $supplierId ? 'Atualizar' : 'Cadastrar' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
