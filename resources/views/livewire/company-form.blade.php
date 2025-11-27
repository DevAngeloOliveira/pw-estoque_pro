<div class="py-12 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{ $companyId ? 'Editar Empresa' : 'Nova Empresa' }}
                    </h2>
                    <a href="{{ route('companies.index') }}"
                        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        ← Voltar
                    </a>
                </div>

                <form wire:submit.prevent="save">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="cnpj"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                CNPJ *
                            </label>
                            <input wire:model="cnpj" type="text" id="cnpj" maxlength="18"
                                placeholder="00.000.000/0000-00"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 @error('cnpj') border-red-500 @enderror">
                            @error('cnpj')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="razao_social"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Razão Social *
                            </label>
                            <input wire:model="razao_social" type="text" id="razao_social"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('razao_social') border-red-500 @enderror">
                            @error('razao_social')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nome_fantasia"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nome Fantasia
                            </label>
                            <input wire:model="nome_fantasia" type="text" id="nome_fantasia"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                E-mail
                            </label>
                            <input wire:model="email" type="email" id="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="telefone" class="block text-sm font-medium text-gray-700 mb-2">
                                Telefone
                            </label>
                            <input wire:model="telefone" type="text" id="telefone" placeholder="(00) 0000-0000"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>

                        <div class="mb-4 flex items-center">
                            <label for="active" class="flex items-center cursor-pointer">
                                <input wire:model="active" type="checkbox" id="active"
                                    class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-sm font-medium text-gray-700">Empresa Ativa</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="endereco" class="block text-sm font-medium text-gray-700 mb-2">
                            Endereço
                        </label>
                        <textarea wire:model="endereco" id="endereco" rows="3" placeholder="Rua, número, bairro, cidade, estado"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('companies.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            {{ $companyId ? 'Atualizar' : 'Cadastrar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        // Máscara para CNPJ
        $('#cnpj').mask('00.000.000/0000-00', {
            onKeyPress: function(val, e, field, options) {
                @this.set('cnpj', val);
            }
        });

        // Máscara para Telefone com suporte a celular
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
