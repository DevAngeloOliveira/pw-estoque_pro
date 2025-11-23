<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $showDeleteModal = false;
    public $productToDelete = null;
    public $perPage = 25;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = ['search', 'sortField', 'sortDirection'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function confirmDelete($productId)
    {
        $this->productToDelete = $productId;
        $this->showDeleteModal = true;
    }

    public function deleteProduct()
    {
        if ($this->productToDelete) {
            $product = Product::find($this->productToDelete);
            $productName = $product->name;
            $product->delete();
            $this->showDeleteModal = false;
            $this->productToDelete = null;
            session()->flash('message', 'Produto excluído com sucesso!');
            $this->emit('notifySuccess', "Produto '{$productName}' excluído com sucesso!");
        }
    }

    public function render()
    {
        // Tenant isolation
        $companyId = auth()->guard('company')->id();

        if (!$companyId) {
            return view('livewire.product-list', [
                'products' => collect(),
                'noCompanySelected' => true
            ]);
        }

        $products = Product::with(['category', 'supplier'])
            ->where('company_id', $companyId)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('sku', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.product-list', [
            'products' => $products,
            'noCompanySelected' => false
        ]);
    }
}
