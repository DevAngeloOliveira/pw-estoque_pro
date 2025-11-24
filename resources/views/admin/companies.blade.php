@extends('admin.layout')

@section('title', 'Empresas')

@section('content')
    <div class="space-y-8">
        <!-- Mensagens de Sucesso/Erro -->
        @if (session('success'))
            <div class="modern-card p-5 bg-gradient-to-r from-green-500 to-emerald-600 text-white animate-fadeInUp">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div>
                        <p class="font-bold text-lg">Sucesso!</p>
                        <p class="text-white/90">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="modern-card p-5 bg-gradient-to-r from-red-500 to-rose-600 text-white animate-fadeInUp">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <i class="fas fa-exclamation-circle text-2xl"></i>
                    </div>
                    <div>
                        <p class="font-bold text-lg">Atenção!</p>
                        <p class="text-white/90">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Modern Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Empresas Cadastradas</h1>
                <p class="text-gray-500 mt-2 flex items-center">
                    <i class="fas fa-building mr-2 text-indigo-600"></i>
                    Gerenciar todas as empresas do sistema
                </p>
            </div>
            <a href="{{ route('admin.companies.create') }}"
                class="btn-modern bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:from-indigo-700 hover:to-purple-700 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Nova Empresa</span>
            </a>
        </div>

        <!-- Modern Companies List -->
        <div class="modern-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Empresa</th>
                            <th>CNPJ</th>
                            <th>Contato</th>
                            <th>Produtos</th>
                            <th>Movimentações</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($companies as $company)
                            <tr>
                                <td>
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold shadow-md">
                                            {{ strtoupper(substr($company->nome_fantasia, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900">{{ $company->nome_fantasia }}</div>
                                            <div class="text-sm text-gray-500">{{ $company->razao_social }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-mono text-sm text-gray-700">
                                        {{ substr($company->cnpj, 0, 2) }}.{{ substr($company->cnpj, 2, 3) }}.{{ substr($company->cnpj, 5, 3) }}/{{ substr($company->cnpj, 8, 4) }}-{{ substr($company->cnpj, 12, 2) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-sm">
                                        <div class="text-gray-700 font-medium flex items-center">
                                            <i class="fas fa-envelope text-indigo-600 mr-2 text-xs"></i>
                                            {{ $company->email }}
                                        </div>
                                        <div class="text-gray-500 flex items-center mt-1">
                                            <i class="fas fa-phone text-indigo-600 mr-2 text-xs"></i>
                                            {{ $company->telefone }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="badge-modern bg-gradient-to-r from-blue-500 to-cyan-600 text-white">
                                        <i class="fas fa-box"></i>
                                        <span>{{ $company->products_count }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="badge-modern bg-gradient-to-r from-purple-500 to-pink-600 text-white">
                                        <i class="fas fa-exchange-alt"></i>
                                        <span>{{ $company->movements_count }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if ($company->active)
                                        <span
                                            class="badge-modern bg-gradient-to-r from-green-500 to-emerald-600 text-white">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Ativa</span>
                                        </span>
                                    @else
                                        <span class="badge-modern bg-gradient-to-r from-red-500 to-rose-600 text-white">
                                            <i class="fas fa-times-circle"></i>
                                            <span>Inativa</span>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.company-details', $company->id) }}"
                                            class="w-9 h-9 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110"
                                            title="Ver detalhes">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.companies.edit', $company->id) }}"
                                            class="w-9 h-9 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.companies.toggle-status', $company->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja {{ $company->active ? 'bloquear' : 'liberar' }} o acesso desta empresa?')"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="w-9 h-9 {{ $company->active ? 'bg-red-100 hover:bg-red-200 text-red-700' : 'bg-green-100 hover:bg-green-200 text-green-700' }} rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110"
                                                title="{{ $company->active ? 'Bloquear acesso' : 'Liberar acesso' }}">
                                                <i class="fas fa-{{ $company->active ? 'lock' : 'unlock' }}"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">Nenhuma empresa cadastrada
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($companies->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $companies->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
