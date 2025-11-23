@extends('admin.layout')

@section('title', 'Empresas')

@section('content')
    <div class="space-y-6">
        <!-- Mensagens de Sucesso/Erro -->
        @if (session('success'))
            <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Empresas Cadastradas</h1>
                <p class="text-gray-600 mt-1">Gerenciar todas as empresas do sistema</p>
            </div>
            <a href="{{ route('admin.companies.create') }}"
                class="px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition">
                <i class="fas fa-plus mr-2"></i>Nova Empresa
            </a>
        </div>

        <!-- Companies List -->
        <div class="bg-white rounded-xl shadow">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Empresa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">CNPJ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contato</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produtos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Movimentações</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($companies as $company)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800">{{ $company->nome_fantasia }}</div>
                                    <div class="text-sm text-gray-500">{{ $company->razao_social }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ substr($company->cnpj, 0, 2) }}.{{ substr($company->cnpj, 2, 3) }}.{{ substr($company->cnpj, 5, 3) }}/{{ substr($company->cnpj, 8, 4) }}-{{ substr($company->cnpj, 12, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ $company->email }}</div>
                                    <div class="text-sm text-gray-500">{{ $company->telefone }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                        {{ $company->products_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">
                                        {{ $company->movements_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($company->active)
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                            <i class="fas fa-check-circle mr-1"></i>Ativa
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                                            <i class="fas fa-times-circle mr-1"></i>Inativa
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.company-details', $company->id) }}"
                                            class="text-purple-600 hover:text-purple-800" title="Ver detalhes">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.companies.edit', $company->id) }}"
                                            class="text-blue-600 hover:text-blue-800" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.companies.toggle-status', $company->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja {{ $company->active ? 'bloquear' : 'liberar' }} o acesso desta empresa?')"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="{{ $company->active ? 'text-red-600 hover:text-red-800' : 'text-green-600 hover:text-green-800' }}"
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
