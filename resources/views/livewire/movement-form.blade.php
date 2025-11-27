<div class="py-12 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                        <i class="fas fa-exchange-alt mr-2"></i>Nova Movimentação
                    </h2>
                    <a href="{{ route('movements.index') }}"
                        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        ← Voltar
                    </a>
                </div>

                <form wire:submit.prevent="save">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="product_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Produto *
                            </label>
                            <select wire:model="product_id" id="product_id"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('product_id') border-red-500 @enderror">
                                <option value="">Selecione um produto</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }} ({{ $product->sku }}) - Estoque: {{ $product->quantity }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="type"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tipo de Movimentação *
                            </label>
                            <select wire:model="type" id="type"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="entrada">Entrada</option>
                                <option value="saida">Saída</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="quantity"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Quantidade *
                            </label>
                            <input wire:model="quantity" type="number" id="quantity" min="1"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white @error('quantity') border-red-500 @enderror">
                            @error('quantity')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="unit_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Preço Unitário (R$) *
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">R$</span>
                                <input wire:model="unit_price" type="text" id="unit_price" placeholder="0,00"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('unit_price') border-red-500 @enderror">
                            </div>
                            @error('unit_price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if ($quantity && $unit_price)
                        <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-blue-800">Valor Total:</span>
                                <span class="text-2xl font-bold text-blue-900">R$
                                    {{ number_format($quantity * $unit_price, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Descrição / Observações
                        </label>
                        <textarea wire:model="description" id="description" rows="3"
                            placeholder="Informações adicionais sobre a movimentação..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('movements.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            <i class="fas fa-save mr-2"></i>Registrar Movimentação
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        // Máscara para preço unitário
        $('#unit_price').mask('#.##0,00', {
            reverse: true,
            onKeyPress: function(val, e, field, options) {
                var cleanValue = val.replace(/\./g, '').replace(',', '.');
                @this.set('unit_price', cleanValue);
            }
        });
    });
</script>
