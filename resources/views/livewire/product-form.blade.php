<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $productId ? 'Editar Produto' : 'Novo Produto' }}
                    </h2>
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">
                        ← Voltar
                    </a>
                </div>

                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome do Produto *
                        </label>
                        <input wire:model="name" type="text" id="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Descrição
                        </label>
                        <textarea wire:model="description" id="description" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Categoria
                            </label>
                            <select wire:model="category_id" id="category_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">Selecione uma categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Fornecedor
                            </label>
                            <select wire:model="supplier_id" id="supplier_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                <option value="">Selecione um fornecedor</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">
                                        {{ $supplier->name }}{{ $supplier->isGlobal() ? ' (Sistema)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Imagem do Produto
                        </label>

                        @if ($existingImage && !$removeImage)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $existingImage) }}" alt="Imagem atual"
                                    class="h-32 w-32 object-cover rounded-lg border border-gray-300">
                                <button type="button" wire:click="removeImageAction"
                                    class="mt-2 text-sm text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i> Remover imagem
                                </button>
                            </div>
                        @endif

                        @if ($image)
                            <div class="mb-3">
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                    class="h-32 w-32 object-cover rounded-lg border border-gray-300">
                                <p class="mt-1 text-sm text-gray-500">Nova imagem selecionada</p>
                            </div>
                        @endif

                        <input wire:model="image" type="file" id="image" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('image') border-red-500 @enderror">
                        <p class="mt-1 text-sm text-gray-500">Tamanho máximo: 2MB</p>
                        @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <div wire:loading wire:target="image" class="text-blue-500 text-sm mt-2">
                            <i class="fas fa-spinner fa-spin"></i> Carregando imagem...
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                Preço (R$) *
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">R$</span>
                                <input wire:model="price" type="text" id="price" placeholder="0,00"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('price') border-red-500 @enderror">
                            </div>
                            @error('price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                Quantidade *
                            </label>
                            <input wire:model="quantity" type="number" id="quantity" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('quantity') border-red-500 @enderror">
                            @error('quantity')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('products.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            {{ $productId ? 'Atualizar' : 'Cadastrar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        // Máscara para preço em reais
        $('#price').mask('#.##0,00', {
            reverse: true,
            onKeyPress: function(val, e, field, options) {
                // Remove a formatação para enviar ao Livewire
                var cleanValue = val.replace(/\./g, '').replace(',', '.');
                @this.set('price', cleanValue);
            }
        });
    });
</script>
