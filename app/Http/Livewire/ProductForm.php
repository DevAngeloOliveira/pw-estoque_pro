<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductForm extends Component
{
    use WithFileUploads;

    public $productId;
    public $name;
    public $description;
    public $category_id;
    public $supplier_id;
    public $price;
    public $quantity;
    public $image;
    public $existingImage;
    public $removeImage = false;
    public $categories;
    public $suppliers;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable',
        'category_id' => 'nullable|exists:categories,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'image' => 'nullable|image|max:2048', // Max 2MB
    ];

    protected $messages = [
        'name.required' => 'O nome é obrigatório',
        'name.min' => 'O nome deve ter no mínimo 3 caracteres',
        'price.required' => 'O preço é obrigatório',
        'price.numeric' => 'O preço deve ser um número',
        'price.min' => 'O preço deve ser maior ou igual a zero',
        'quantity.required' => 'A quantidade é obrigatória',
        'quantity.integer' => 'A quantidade deve ser um número inteiro',
        'quantity.min' => 'A quantidade deve ser maior ou igual a zero',
    ];

    public function mount($id = null)
    {
        // Tenant isolation
        $companyId = auth()->guard('company')->id();

        // Carregar categorias ativas da empresa
        $this->categories = Category::where('company_id', $companyId)
            ->where('active', true)
            ->orderBy('name')
            ->get();

        // Carregar fornecedores disponíveis para a empresa
        $this->suppliers = Supplier::availableForCompany($companyId);

        if ($id) {
            $this->productId = $id;
            // Verifica se o produto pertence à empresa logada
            $product = Product::where('company_id', $companyId)->findOrFail($id);
            $this->name = $product->name;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->quantity = $product->quantity;
            $this->category_id = $product->category_id;
            $this->supplier_id = $product->supplier_id;
            $this->existingImage = $product->image;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function removeImageAction()
    {
        $this->removeImage = true;
        $this->existingImage = null;
        $this->image = null;
    }

    public function save()
    {
        // Tenant isolation
        $companyId = auth()->guard('company')->id();

        $this->validate();

        $imagePath = null;

        // Processar upload de nova imagem
        if ($this->image) {
            // Remover imagem antiga se existir
            if ($this->existingImage && Storage::disk('public')->exists($this->existingImage)) {
                Storage::disk('public')->delete($this->existingImage);
            }

            // Salvar nova imagem
            $imagePath = $this->image->store('products', 'public');
        } elseif ($this->removeImage && $this->existingImage) {
            // Remover imagem existente se solicitado
            if (Storage::disk('public')->exists($this->existingImage)) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $imagePath = null;
        } elseif ($this->existingImage && !$this->removeImage) {
            // Manter imagem existente
            $imagePath = $this->existingImage;
        }

        if ($this->productId) {
            // Verifica se o produto pertence à empresa logada
            $product = Product::where('company_id', $companyId)->findOrFail($this->productId);
            $product->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'category_id' => $this->category_id ?: null,
                'supplier_id' => $this->supplier_id ?: null,
                'image' => $imagePath,
            ]);
            session()->flash('message', 'Produto atualizado com sucesso!');
            $this->emit('notifySuccess', "Produto '{$this->name}' atualizado com sucesso!");
        } else {
            Product::create([
                'company_id' => $companyId,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'category_id' => $this->category_id ?: null,
                'supplier_id' => $this->supplier_id ?: null,
                'image' => $imagePath,
            ]);
            session()->flash('message', 'Produto cadastrado com sucesso!');
            $this->emit('notifySuccess', "Produto '{$this->name}' cadastrado com sucesso!");
        }

        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}
