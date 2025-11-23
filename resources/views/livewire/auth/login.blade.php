<div class="bg-white rounded-lg shadow-2xl overflow-hidden">
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-8 text-center">
        <i class="fas fa-boxes text-white text-5xl mb-3"></i>
        <h1 class="text-3xl font-bold text-white">Estoque Pro</h1>
        <p class="text-blue-100 mt-2">Sistema de Gestão Multi-Empresas</p>
    </div>

    <div class="p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h2>

        @if (session()->has('message'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="login">
            <div class="mb-4">
                <label for="cnpj" class="block text-sm font-medium text-gray-700 mb-2">
                    CNPJ da Empresa
                </label>
                <div class="relative">
                    <i class="fas fa-building absolute left-3 top-3 text-gray-400"></i>
                    <input wire:model="cnpj" 
                           type="text" 
                           id="cnpj"
                           maxlength="18"
                           placeholder="00.000.000/0000-00"
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('cnpj') border-red-500 @enderror">
                </div>
                @error('cnpj') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Senha
                </label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    <input wire:model="password" 
                           type="password" 
                           id="password"
                           placeholder="••••••••"
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('password') border-red-500 @enderror">
                </div>
                @error('password') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6 flex items-center">
                <input wire:model="remember" 
                       type="checkbox" 
                       id="remember"
                       class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="remember" class="ml-2 text-sm text-gray-700">Lembrar-me</label>
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-200">
                <i class="fas fa-sign-in-alt mr-2"></i>Entrar
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600">
                Não tem uma conta? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                    Cadastre sua empresa
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        $('#cnpj').mask('00.000.000/0000-00', {
            onKeyPress: function(val, e, field, options) {
                @this.set('cnpj', val);
            }
        });
    });
</script>
