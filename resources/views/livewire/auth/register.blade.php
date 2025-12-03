<div class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl overflow-hidden">
    <div class="bg-gradient-to-r from-green-600 to-green-800 p-8 text-center">
        <i class="fas fa-building text-white text-5xl mb-3"></i>
        <h1 class="text-3xl font-bold text-white">Estoque Pro</h1>
        <p class="text-green-100 mt-2">Cadastro de Nova Empresa</p>
    </div>

    <div class="p-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Cadastro</h2>

        @if (session()->has('message'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="register">
            <div class="mb-4">
                <label for="razao_social" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Razão Social *
                </label>
                <input wire:model.lazy="razao_social" type="text" id="razao_social"
                    placeholder="Nome da Empresa Ltda"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-green-500 dark:bg-gray-700 dark:text-white @error('razao_social') border-red-500 @enderror">
                @error('razao_social')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nome_fantasia" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Nome Fantasia
                </label>
                <input wire:model.lazy="nome_fantasia" type="text" id="nome_fantasia" placeholder="Nome comercial"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-green-500 dark:bg-gray-700 dark:text-white @error('nome_fantasia') border-red-500 @enderror">
                @error('nome_fantasia')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cnpj" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    CNPJ *
                </label>
                <input type="text" id="cnpj" name="cnpj" maxlength="18" placeholder="00.000.000/0000-00"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-green-500 dark:bg-gray-700 dark:text-white @error('cnpj') border-red-500 @enderror">
                @error('cnpj')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        E-mail
                    </label>
                    <input wire:model.lazy="email" type="email" id="email" placeholder="contato@empresa.com"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-green-500 dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="telefone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Telefone
                    </label>
                    <input type="text" id="telefone" name="telefone" placeholder="(00) 00000-0000"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-green-500 dark:bg-gray-700 dark:text-white @error('telefone') border-red-500 @enderror">
                    @error('telefone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="endereco" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Endereço
                </label>
                <input wire:model.lazy="endereco" type="text" id="endereco"
                    placeholder="Rua, Número, Bairro - Cidade/UF"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-green-500 dark:bg-gray-700 dark:text-white @error('endereco') border-red-500 @enderror">
                @error('endereco')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Senha *
                    </label>
                    <input wire:model.defer="password" type="password" id="password" placeholder="Mínimo 6 caracteres"
                        autocomplete="new-password"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-green-500 dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Confirmar Senha *
                    </label>
                    <input wire:model.defer="password_confirmation" type="password" id="password_confirmation"
                        placeholder="Digite a senha novamente" autocomplete="new-password"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-green-500 dark:bg-gray-700 dark:text-white">
                </div>
            </div>

            <div class="mb-6 flex items-start">
                <input wire:model="active" type="checkbox" id="active"
                    class="h-4 w-4 mt-1 text-green-600 border-gray-300 dark:border-gray-600 rounded focus:ring-green-500 dark:bg-gray-700">
                <label for="active" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                    Ativar empresa imediatamente
                </label>
            </div>

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition duration-200">
                <i class="fas fa-check mr-2"></i>Cadastrar Empresa
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600 dark:text-gray-400">
                Já tem uma conta?
                <a href="{{ route('login') }}"
                    class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-bold">
                    Faça Login
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cnpjInput = document.getElementById('cnpj');
        const telefoneInput = document.getElementById('telefone');

        if (cnpjInput) {
            cnpjInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 14) value = value.slice(0, 14);

                if (value.length > 12) {
                    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2}).*/, '$1.$2.$3/$4-$5');
                } else if (value.length > 8) {
                    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{0,4}).*/, '$1.$2.$3/$4');
                } else if (value.length > 5) {
                    value = value.replace(/^(\d{2})(\d{3})(\d{0,3}).*/, '$1.$2.$3');
                } else if (value.length > 2) {
                    value = value.replace(/^(\d{2})(\d{0,3}).*/, '$1.$2');
                }

                e.target.value = value;
                @this.set('cnpj', value);
            });
        }

        if (telefoneInput) {
            telefoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.slice(0, 11);

                if (value.length > 10) {
                    value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
                } else if (value.length > 6) {
                    value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
                } else if (value.length > 2) {
                    value = value.replace(/^(\d{2})(\d{0,5}).*/, '($1) $2');
                }

                e.target.value = value;
                @this.set('telefone', value);
            });
        }
    });
</script>

<script>
    document.addEventListener('livewire:load', function() {
        $('#cnpj').mask('00.000.000/0000-00', {
            onKeyPress: function(val, e, field, options) {
                @this.set('cnpj', val);
            }
        });

        var SPMaskBehavior = function(val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                    @this.set('telefone', val);
                }
            };

        $('#telefone').mask(SPMaskBehavior, spOptions);
    });
</script>
