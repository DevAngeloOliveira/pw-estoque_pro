<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $categoryId = null;
    public $name;
    public $description;
    public $color = '#3b82f6';
    public $active = true;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'nullable|max:500',
        'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
    ];

    protected $messages = [
        'name.required' => 'O nome é obrigatório',
        'name.min' => 'O nome deve ter no mínimo 3 caracteres',
        'name.max' => 'O nome deve ter no máximo 255 caracteres',
        'color.required' => 'A cor é obrigatória',
        'color.regex' => 'A cor deve estar no formato hexadecimal (#RRGGBB)',
    ];

    protected $listeners = ['refreshCategories' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->categoryId = $id;

        if ($id) {
            $companyId = auth()->guard('company')->id();
            $category = Category::where('company_id', $companyId)->findOrFail($id);
            $this->name = $category->name;
            $this->description = $category->description;
            $this->color = $category->color;
            $this->active = $category->active;
        } else {
            $this->reset(['name', 'description', 'active']);
            $this->color = '#3b82f6';
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['categoryId', 'name', 'description', 'color', 'active']);
    }

    public function save()
    {
        $companyId = auth()->guard('company')->id();
        $this->validate();

        if ($this->categoryId) {
            $category = Category::where('company_id', $companyId)->findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'description' => $this->description,
                'color' => $this->color,
                'active' => $this->active,
            ]);
            $this->emit('notifySuccess', "Categoria '{$this->name}' atualizada com sucesso!");
        } else {
            Category::create([
                'company_id' => $companyId,
                'name' => $this->name,
                'description' => $this->description,
                'color' => $this->color,
                'active' => $this->active,
            ]);
            $this->emit('notifySuccess', "Categoria '{$this->name}' criada com sucesso!");
        }

        $this->closeModal();
        $this->emit('refreshCategories');
    }

    public function toggleActive($id)
    {
        $companyId = auth()->guard('company')->id();
        $category = Category::where('company_id', $companyId)->findOrFail($id);
        $category->active = !$category->active;
        $category->save();

        $status = $category->active ? 'ativada' : 'desativada';
        $this->emit('notifySuccess', "Categoria '{$category->name}' {$status} com sucesso!");
    }

    public function delete($id)
    {
        $companyId = auth()->guard('company')->id();
        $category = Category::where('company_id', $companyId)->findOrFail($id);

        if ($category->products_count > 0) {
            $this->emit('notifyError', 'Não é possível excluir uma categoria com produtos associados.');
            return;
        }

        $name = $category->name;
        $category->delete();
        $this->emit('notifySuccess', "Categoria '{$name}' excluída com sucesso!");
    }

    public function render()
    {
        $companyId = auth()->guard('company')->id();

        $categories = Category::where('company_id', $companyId)
            ->withCount('products')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.category-list', [
            'categories' => $categories
        ]);
    }
}
