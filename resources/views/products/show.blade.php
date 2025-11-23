<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Voltar para Produtos
            </a>
        </div>

        @livewire('product-details', ['productId' => $id])
    </div>
</x-app-layout>
