@extends('admin.layout')

@section('title', 'Fornecedores Globais')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Fornecedores Globais</h1>
                <p class="text-gray-600 mt-1">Gerenciar fornecedores disponíveis para todas as empresas</p>
            </div>
            <button onclick="openModal()"
                class="px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition">
                <i class="fas fa-plus mr-2"></i>Novo Fornecedor Global
            </button>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <i class="fas fa-truck text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Global</p>
                        <p class="text-2xl font-bold text-gray-800" id="totalSuppliers">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Ativos</p>
                        <p class="text-2xl font-bold text-gray-800" id="activeSuppliers">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fas fa-building text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Em Uso</p>
                        <p class="text-2xl font-bold text-gray-800" id="suppliersInUse">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Suppliers List -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Lista de Fornecedores</h3>
                    <div class="flex space-x-2">
                        <input type="text" id="searchInput" placeholder="Buscar fornecedor..."
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fornecedor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">CNPJ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contato</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cidade/UF</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="suppliersTableBody" class="divide-y">
                        <!-- Preenchido via Livewire -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="supplierModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Novo Fornecedor Global</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <form id="supplierForm" class="p-6">
                @csrf
                <input type="hidden" id="supplier_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nome -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome do Fornecedor <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            required>
                    </div>

                    <!-- Razão Social -->
                    <div class="md:col-span-2">
                        <label for="legal_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Razão Social
                        </label>
                        <input type="text" id="legal_name" name="legal_name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <!-- CNPJ -->
                    <div>
                        <label for="cnpj" class="block text-sm font-medium text-gray-700 mb-2">
                            CNPJ
                        </label>
                        <input type="text" id="cnpj" name="cnpj"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            maxlength="18">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            E-mail
                        </label>
                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Telefone
                        </label>
                        <input type="text" id="phone" name="phone"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            maxlength="15">
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                            WhatsApp
                        </label>
                        <input type="text" id="whatsapp" name="whatsapp"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            maxlength="15">
                    </div>

                    <!-- Website -->
                    <div class="md:col-span-2">
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-2">
                            Website
                        </label>
                        <input type="url" id="website" name="website"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="https://">
                    </div>

                    <!-- Endereço -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Logradouro
                        </label>
                        <input type="text" id="address" name="address"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <!-- Número -->
                    <div>
                        <label for="address_number" class="block text-sm font-medium text-gray-700 mb-2">
                            Número
                        </label>
                        <input type="text" id="address_number" name="address_number"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <!-- Bairro -->
                    <div>
                        <label for="neighborhood" class="block text-sm font-medium text-gray-700 mb-2">
                            Bairro
                        </label>
                        <input type="text" id="neighborhood" name="neighborhood"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <!-- Complemento -->
                    <div>
                        <label for="complement" class="block text-sm font-medium text-gray-700 mb-2">
                            Complemento
                        </label>
                        <input type="text" id="complement" name="complement"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <!-- Cidade -->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                            Cidade
                        </label>
                        <input type="text" id="city" name="city"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <!-- Estado -->
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-2">
                            Estado
                        </label>
                        <input type="text" id="state" name="state"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            maxlength="2" placeholder="SP">
                    </div>

                    <!-- CEP -->
                    <div>
                        <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-2">
                            CEP
                        </label>
                        <input type="text" id="zip_code" name="zip_code"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            maxlength="9">
                    </div>

                    <!-- Observações -->
                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Observações
                        </label>
                        <textarea id="notes" name="notes" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"></textarea>
                    </div>

                    <!-- Ativo -->
                    <div class="md:col-span-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="active" name="active"
                                class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500" checked>
                            <span class="ml-2 text-sm text-gray-700">Fornecedor ativo</span>
                        </label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 mt-6 pt-6 border-t">
                    <button type="button" onclick="closeModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancelar
                    </button>
                    <button type="submit" id="submitBtn"
                        class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition">
                        <i class="fas fa-save mr-2"></i>Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    @livewire('admin.global-supplier-manager')

    @push('scripts')
        <script>
            function openModal(supplierId = null) {
                document.getElementById('supplierModal').classList.remove('hidden');
                document.getElementById('supplierForm').reset();
                document.getElementById('supplier_id').value = '';
                document.getElementById('modalTitle').textContent = 'Novo Fornecedor Global';

                if (supplierId) {
                    window.Livewire.emit('loadSupplier', supplierId);
                    document.getElementById('modalTitle').textContent = 'Editar Fornecedor Global';
                }
            }

            function closeModal() {
                document.getElementById('supplierModal').classList.add('hidden');
            }

            // Máscaras
            document.getElementById('cnpj').addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length <= 14) {
                    value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                    value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                    value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                    value = value.replace(/(\d{4})(\d)/, '$1-$2');
                }
                e.target.value = value;
            });

            ['phone', 'whatsapp'].forEach(id => {
                document.getElementById(id).addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length <= 11) {
                        value = value.replace(/^(\d{2})(\d)/, '($1) $2');
                        value = value.replace(/(\d{5})(\d)/, '$1-$2');
                    }
                    e.target.value = value;
                });
            });

            document.getElementById('zip_code').addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = value.replace(/^(\d{5})(\d)/, '$1-$2');
                e.target.value = value;
            });

            // Submit
            document.getElementById('supplierForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = {
                    name: document.getElementById('name').value,
                    legal_name: document.getElementById('legal_name').value,
                    cnpj: document.getElementById('cnpj').value.replace(/\D/g, ''),
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value,
                    whatsapp: document.getElementById('whatsapp').value,
                    website: document.getElementById('website').value,
                    address: document.getElementById('address').value,
                    address_number: document.getElementById('address_number').value,
                    neighborhood: document.getElementById('neighborhood').value,
                    complement: document.getElementById('complement').value,
                    city: document.getElementById('city').value,
                    state: document.getElementById('state').value,
                    zip_code: document.getElementById('zip_code').value.replace(/\D/g, ''),
                    notes: document.getElementById('notes').value,
                    active: document.getElementById('active').checked,
                };

                const supplierId = document.getElementById('supplier_id').value;

                if (supplierId) {
                    window.Livewire.emit('updateSupplier', supplierId, formData);
                } else {
                    window.Livewire.emit('createSupplier', formData);
                }
            });

            // Livewire events
            window.addEventListener('supplier-loaded', event => {
                const supplier = event.detail;
                document.getElementById('supplier_id').value = supplier.id;
                document.getElementById('name').value = supplier.name || '';
                document.getElementById('legal_name').value = supplier.legal_name || '';
                document.getElementById('cnpj').value = supplier.formatted_cnpj || '';
                document.getElementById('email').value = supplier.email || '';
                document.getElementById('phone').value = supplier.phone || '';
                document.getElementById('whatsapp').value = supplier.whatsapp || '';
                document.getElementById('website').value = supplier.website || '';
                document.getElementById('address').value = supplier.address || '';
                document.getElementById('address_number').value = supplier.address_number || '';
                document.getElementById('neighborhood').value = supplier.neighborhood || '';
                document.getElementById('complement').value = supplier.complement || '';
                document.getElementById('city').value = supplier.city || '';
                document.getElementById('state').value = supplier.state || '';
                document.getElementById('zip_code').value = supplier.formatted_zip || '';
                document.getElementById('notes').value = supplier.notes || '';
                document.getElementById('active').checked = supplier.active;
            });

            window.addEventListener('supplier-saved', event => {
                closeModal();
                window.Livewire.emit('refreshSuppliers');
            });

            // Close modal on escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        </script>
    @endpush
@endsection
