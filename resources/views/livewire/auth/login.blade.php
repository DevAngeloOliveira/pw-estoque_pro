<div class="modern-card overflow-hidden max-w-md mx-auto animate-fadeInUp">
    <!-- Modern Header with Gradient -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600"></div>
        <div class="absolute inset-0 opacity-20"
            style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;0.4&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>
        <div class="relative p-8 text-center">
            <div
                class="w-20 h-20 bg-white/20 backdrop-blur-lg rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-2xl">
                <i class="fas fa-boxes text-white text-4xl"></i>
            </div>
            <h1 class="text-4xl font-black text-white tracking-tight">Estoque Pro</h1>
            <p class="text-white/90 mt-2 font-medium">Sistema de Gestão Multi-Empresas</p>
        </div>
    </div>

    <!-- Modern Form -->
    <div class="p-8 dark:bg-gray-800">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-black text-gray-900 dark:text-white">Bem-vindo!</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Faça login para continuar</p>
        </div>

        @if (session()->has('message'))
            <div
                class="mb-6 p-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow-lg animate-fadeInUp">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-2xl mr-3"></i>
                    <span class="font-semibold">{{ session('message') }}</span>
                </div>
            </div>
        @endif

        <form wire:submit.prevent="login" class="space-y-6">
            <div>
                <label for="cnpj" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    CNPJ da Empresa
                </label>
                <div class="relative">
                    <div
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-building text-white"></i>
                    </div>
                    <input wire:model.defer="cnpj" type="text" id="cnpj" maxlength="18"
                        placeholder="00.000.000/0000-00"
                        class="input-modern w-full pl-20 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('cnpj') border-red-500 @enderror"
                        autocomplete="username">
                </div>
                @error('cnpj')
                    <div class="mt-2 text-red-600 text-sm font-semibold flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    Senha
                </label>
                <div class="relative">
                    <div
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-lock text-white"></i>
                    </div>
                    <input wire:model.defer="password" type="password" id="password" placeholder="••••••••"
                        class="input-modern w-full pl-20 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('password') border-red-500 @enderror"
                        autocomplete="current-password">
                </div>
                @error('password')
                    <div class="mt-2 text-red-600 text-sm font-semibold flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex items-center">
                <input wire:model.defer="remember" type="checkbox" id="remember"
                    class="w-5 h-5 text-indigo-600 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-4 focus:ring-indigo-200 dark:bg-gray-700">
                <label for="remember"
                    class="ml-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Lembrar-me</label>
            </div>

            <button type="submit"
                class="btn-modern w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-lg">
                <i class="fas fa-sign-in-alt mr-2"></i>Entrar
            </button>
        </form>

        <div class="mt-8 text-center">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-medium">Não tem
                        uma conta?</span>
                </div>
            </div>
            <a href="{{ route('register') }}"
                class="mt-4 inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 border-2 border-gray-200 dark:border-gray-600 hover:border-indigo-600 dark:hover:border-indigo-400 text-gray-700 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 font-bold rounded-xl transition-all duration-300 hover:scale-105">
                <i class="fas fa-user-plus mr-2"></i>
                Cadastre sua empresa
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        $('#cnpj').mask('00.000.000/0000-00', {
            onKeyPress: function(val, e, field, options) {
                @this.set('cnpj', val);
            }
        });
    });
</script>
