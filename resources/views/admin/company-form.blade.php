@extends('admin.layout')

@section('title', 'Gerenciar Empresa')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('admin.companies') }}"
                    class="text-purple-600 hover:text-purple-800 text-sm mb-2 inline-block">
                    <i class="fas fa-arrow-left mr-2"></i>Voltar para empresas
                </a>
                <h1 class="text-3xl font-bold text-gray-800">{{ isset($company) ? 'Editar Empresa' : 'Nova Empresa' }}</h1>
                <p class="text-gray-600 mt-1">
                    {{ isset($company) ? 'Atualizar informações da empresa' : 'Cadastrar nova empresa no sistema' }}</p>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow p-6">
            <form id="companyForm" class="space-y-6">
                @csrf
                @if (isset($company))
                    @method('PUT')
                    <input type="hidden" id="company_id" value="{{ $company->id }}">
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- CNPJ -->
                    <div>
                        <label for="cnpj" class="block text-sm font-medium text-gray-700 mb-2">
                            CNPJ <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="cnpj" name="cnpj"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="00.000.000/0000-00" maxlength="18" required>
                        <span class="text-red-500 text-sm hidden" id="cnpj-error"></span>
                    </div>

                    <!-- Razão Social -->
                    <div>
                        <label for="razao_social" class="block text-sm font-medium text-gray-700 mb-2">
                            Razão Social <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="razao_social" name="razao_social"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Empresa Exemplo Ltda" required>
                    </div>

                    <!-- Nome Fantasia -->
                    <div>
                        <label for="nome_fantasia" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome Fantasia <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nome_fantasia" name="nome_fantasia"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Empresa Exemplo" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            E-mail <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="contato@empresa.com" required>
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label for="telefone" class="block text-sm font-medium text-gray-700 mb-2">
                            Telefone <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="telefone" name="telefone"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="(00) 00000-0000" maxlength="15" required>
                    </div>

                    <!-- Senha (apenas para nova empresa) -->
                    @if (!isset($company))
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Senha <span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="Senha de acesso" minlength="6" required>
                        </div>
                    @endif
                </div>

                <!-- Endereço -->
                <div>
                    <label for="endereco" class="block text-sm font-medium text-gray-700 mb-2">
                        Endereço <span class="text-red-500">*</span>
                    </label>
                    <textarea id="endereco" name="endereco" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="Rua, número, bairro, cidade - UF" required></textarea>
                </div>

                <!-- Configurações -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Configurações</h3>

                    <div class="space-y-4">
                        <!-- Usar Fornecedores Globais -->
                        <div class="flex items-center">
                            <input type="checkbox" id="use_global_suppliers" name="use_global_suppliers"
                                class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500 h-4 w-4">
                            <label for="use_global_suppliers" class="ml-3 text-sm text-gray-700">
                                Usar fornecedores globais do sistema
                            </label>
                        </div>

                        <!-- Empresa Ativa -->
                        <div class="flex items-center">
                            <input type="checkbox" id="active" name="active"
                                class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500 h-4 w-4"
                                {{ !isset($company) ? 'checked' : '' }}>
                            <label for="active" class="ml-3 text-sm text-gray-700">
                                Empresa ativa
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <a href="{{ route('admin.companies') }}"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancelar
                    </a>
                    <button type="submit" id="submitBtn"
                        class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition">
                        <i class="fas fa-save mr-2"></i>{{ isset($company) ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                </div>

                <!-- Loading/Success Messages -->
                <div id="message" class="hidden"></div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('companyForm');
                const cnpjInput = document.getElementById('cnpj');
                const telefoneInput = document.getElementById('telefone');
                const submitBtn = document.getElementById('submitBtn');
                const messageDiv = document.getElementById('message');

                // Máscara CNPJ
                cnpjInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length <= 14) {
                        value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                        value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                        value = value.replace(/(\d{4})(\d)/, '$1-$2');
                    }
                    e.target.value = value;
                });

                // Máscara Telefone
                telefoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length <= 11) {
                        value = value.replace(/^(\d{2})(\d)/, '($1) $2');
                        value = value.replace(/(\d{5})(\d)/, '$1-$2');
                    }
                    e.target.value = value;
                });

                // Carregar dados se estiver editando
                @if (isset($company))
                    cnpjInput.value =
                        '{{ substr($company->cnpj, 0, 2) }}.{{ substr($company->cnpj, 2, 3) }}.{{ substr($company->cnpj, 5, 3) }}/{{ substr($company->cnpj, 8, 4) }}-{{ substr($company->cnpj, 12, 2) }}';
                    document.getElementById('razao_social').value = '{{ $company->razao_social }}';
                    document.getElementById('nome_fantasia').value = '{{ $company->nome_fantasia }}';
                    document.getElementById('email').value = '{{ $company->email }}';
                    document.getElementById('telefone').value = '{{ $company->telefone }}';
                    document.getElementById('endereco').value = '{{ $company->endereco }}';
                    document.getElementById('use_global_suppliers').checked =
                        {{ $company->use_global_suppliers ? 'true' : 'false' }};
                    document.getElementById('active').checked = {{ $company->active ? 'true' : 'false' }};
                @endif

                // Submit form via Livewire
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Salvando...';

                    const formData = {
                        cnpj: cnpjInput.value.replace(/\D/g, ''),
                        razao_social: document.getElementById('razao_social').value,
                        nome_fantasia: document.getElementById('nome_fantasia').value,
                        email: document.getElementById('email').value,
                        telefone: document.getElementById('telefone').value,
                        endereco: document.getElementById('endereco').value,
                        use_global_suppliers: document.getElementById('use_global_suppliers').checked,
                        active: document.getElementById('active').checked,
                        @if (!isset($company))
                            password: document.getElementById('password').value,
                        @endif
                    };

                    @if (isset($company))
                        window.Livewire.emit('updateCompany', {{ $company->id }}, formData);
                    @else
                        window.Livewire.emit('createCompany', formData);
                    @endif
                });

                // Listen for Livewire events
                window.addEventListener('company-saved', event => {
                    messageDiv.className = 'bg-green-50 border-l-4 border-green-500 p-4 mb-4';
                    messageDiv.innerHTML =
                        '<div class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i><p class="text-green-700">' +
                        event.detail.message + '</p></div>';
                    messageDiv.classList.remove('hidden');

                    setTimeout(() => {
                        window.location.href = '{{ route('admin.companies') }}';
                    }, 1500);
                });

                window.addEventListener('company-error', event => {
                    messageDiv.className = 'bg-red-50 border-l-4 border-red-500 p-4 mb-4';
                    messageDiv.innerHTML =
                        '<div class="flex items-center"><i class="fas fa-exclamation-circle text-red-500 mr-2"></i><p class="text-red-700">' +
                        event.detail.message + '</p></div>';
                    messageDiv.classList.remove('hidden');

                    submitBtn.disabled = false;
                    submitBtn.innerHTML =
                        '<i class="fas fa-save mr-2"></i>{{ isset($company) ? 'Atualizar' : 'Cadastrar' }}';
                });
            });
        </script>
    @endpush
@endsection
