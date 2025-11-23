<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sidebar -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full text-white text-4xl font-bold mb-4">
                        {{ strtoupper(substr($razao_social, 0, 1)) }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $nome_fantasia ?? $razao_social }}</h3>
                    <p class="text-gray-500 text-sm">{{ $cnpj }}</p>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-envelope w-8 text-blue-500"></i>
                        <span class="text-sm">{{ $email ?: 'Não informado' }}</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-phone w-8 text-blue-500"></i>
                        <span class="text-sm">{{ $telefone ?: 'Não informado' }}</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-map-marker-alt w-8 text-blue-500"></i>
                        <span class="text-sm">{{ $endereco ?: 'Não informado' }}</span>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-gray-600">Status da Conta</span>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                            <i class="fas fa-check-circle mr-1"></i>Ativa
                        </span>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Editar Informações -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-user-edit text-blue-500 mr-2"></i>
                        Editar Informações da Empresa
                    </h3>

                    @if (session()->has('message'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="updateProfile">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Razão Social *</label>
                                <input wire:model="razao_social" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('razao_social') border-red-500 @enderror">
                                @error('razao_social') 
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nome Fantasia</label>
                                <input wire:model="nome_fantasia" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">CNPJ</label>
                                <input value="{{ $cnpj }}" type="text" disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
                                <p class="text-xs text-gray-500 mt-1">O CNPJ não pode ser alterado</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                                <input wire:model="email" type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                                @error('email') 
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
                                <input wire:model="telefone" type="text" id="telefone_profile" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Endereço</label>
                                <input wire:model="endereco" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 font-semibold shadow-lg transition">
                                <i class="fas fa-save mr-2"></i>Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Alterar Senha -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-lock text-purple-500 mr-2"></i>
                        Alterar Senha
                    </h3>

                    @if (session()->has('password_message'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('password_message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="updatePassword">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Senha Atual *</label>
                                <input wire:model="current_password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 @error('current_password') border-red-500 @enderror">
                                @error('current_password') 
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nova Senha *</label>
                                <input wire:model="password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 @error('password') border-red-500 @enderror">
                                @error('password') 
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirmar Nova Senha *</label>
                                <input wire:model="password_confirmation" type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg hover:from-purple-700 hover:to-purple-800 font-semibold shadow-lg transition">
                                <i class="fas fa-key mr-2"></i>Atualizar Senha
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Informações de Segurança -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg shadow-lg p-6 border border-blue-200">
                    <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-shield-alt text-blue-600 mr-2"></i>
                        Dicas de Segurança
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                            <span>Use uma senha forte com no mínimo 8 caracteres</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                            <span>Combine letras maiúsculas, minúsculas, números e símbolos</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                            <span>Nunca compartilhe sua senha com outras pessoas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                            <span>Altere sua senha regularmente</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
                @this.set('telefone', val);
            }
        };

        $('#telefone_profile').mask(SPMaskBehavior, spOptions);
    });
</script>
