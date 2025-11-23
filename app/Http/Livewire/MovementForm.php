<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductMovement;
use Livewire\Component;

class MovementForm extends Component
{
    public $product_id;
    public $type = 'entrada';
    public $quantity;
    public $unit_price;
    public $description;
    public $products;

    protected $rules = [
        'product_id' => 'required|exists:products,id',
        'type' => 'required|in:entrada,saida',
        'quantity' => 'required|integer|min:1',
        'unit_price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
    ];

    protected $messages = [
        'product_id.required' => 'Selecione um produto',
        'product_id.exists' => 'Produto não encontrado',
        'type.required' => 'Selecione o tipo de movimentação',
        'quantity.required' => 'A quantidade é obrigatória',
        'quantity.min' => 'A quantidade deve ser maior que zero',
        'unit_price.required' => 'O preço unitário é obrigatório',
        'unit_price.min' => 'O preço deve ser maior ou igual a zero',
    ];

    public function mount()
    {
        // Tenant isolation
        $companyId = auth()->guard('company')->id();
        $this->products = Product::where('company_id', $companyId)->get();

        if ($this->product_id) {
            // Apenas produtos da própria empresa
            $product = Product::where('company_id', $companyId)->find($this->product_id);
            if ($product) {
                $this->unit_price = $product->price;
            }
        }
    }

    public function updatedProductId($value)
    {
        if ($value) {
            $product = Product::find($value);
            if ($product) {
                $this->unit_price = $product->price;
            }
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        // Tenant isolation
        $companyId = auth()->guard('company')->id();

        $this->validate();

        if ($this->type === 'saida') {
            // Verifica estoque apenas de produtos da própria empresa
            $product = Product::where('company_id', $companyId)->findOrFail($this->product_id);
            if ($product->quantity < $this->quantity) {
                $this->addError('quantity', 'Quantidade em estoque insuficiente. Disponível: ' . $product->quantity);
                return;
            }
        }

        $totalPrice = $this->quantity * $this->unit_price;

        ProductMovement::create([
            'product_id' => $this->product_id,
            'company_id' => $companyId,
            'type' => $this->type,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'total_price' => $totalPrice,
            'description' => $this->description,
            'movement_date' => now(),
        ]);

        session()->flash('message', 'Movimentação registrada com sucesso!');
        return redirect()->route('movements.index');
    }

    public function render()
    {
        return view('livewire.movement-form');
    }
}
