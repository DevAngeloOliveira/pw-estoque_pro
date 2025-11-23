<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistema de Gestão</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-500 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <div
                    class="bg-gradient-to-r from-purple-600 to-indigo-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Admin Dashboard</h2>
                <p class="text-gray-500 mt-2">Acesso restrito ao sistema</p>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                        <p class="text-red-700 text-sm">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">
                        <i class="fas fa-envelope mr-2"></i>E-mail
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                        placeholder="admin@exemplo.com" required autofocus>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">
                        <i class="fas fa-lock mr-2"></i>Senha
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                        placeholder="••••••••" required>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500">
                        <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition duration-200 shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>Entrar
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <a href="{{ route('welcome') }}" class="text-purple-600 hover:text-purple-800 text-sm">
                    <i class="fas fa-arrow-left mr-2"></i>Voltar ao site
                </a>
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 mt-4 text-white text-center">
            <p class="text-sm">
                <i class="fas fa-info-circle mr-2"></i>
                Apenas administradores autorizados podem acessar esta área
            </p>
        </div>
    </div>
</body>

</html>
