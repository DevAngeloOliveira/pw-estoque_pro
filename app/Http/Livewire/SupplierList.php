<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierList extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $supplierId = null;
    public $name;
    public $legal_name;
    public $cnpj;
    public $email;
    public $phone;
    public $whatsapp;
    public $website;
    public $address;
    public $address_number;
    public $complement;
    public $neighborhood;
    public $city;
    public $state;
    public $zip_code;
    public $notes;
    public $active = true;
    public $useGlobalSuppliers = false;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'legal_name' => 'nullable|max:255',
        'cnpj' => 'nullable|size:18',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|max:20',
        'whatsapp' => 'nullable|max:20',
        'website' => 'nullable|url|max:255',
        'address' => 'nullable|max:255',
        'address_number' => 'nullable|max:20',
        'complement' => 'nullable|max:255',
        'neighborhood' => 'nullable|max:255',
        'city' => 'nullable|max:255',
        'state' => 'nullable|size:2',
        'zip_code' => 'nullable|max:10',
        'notes' => 'nullable',
    ];

    protected $messages = [
        'name.required' => 'O nome é obrigatório',
        'name.min' => 'O nome deve ter no mínimo 3 caracteres',
        'email.email' => 'Digite um e-mail válido',
        'website.url' => 'Digite uma URL válida',
        'state.size' => 'Digite a sigla do estado (2 caracteres)',
    ];

    protected $listeners = ['refreshSuppliers' => '$refresh'];

    public function mount()
    {
        $companyId = auth()->guard('company')->id();
        $company = Company::find($companyId);
        $this->useGlobalSuppliers = $company->use_global_suppliers ?? false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleSupplierMode()
    {
        $companyId = auth()->guard('company')->id();
        $company = Company::find($companyId);
        $company->use_global_suppliers = !$company->use_global_suppliers;
        $company->save();

        $this->useGlobalSuppliers = $company->use_global_suppliers;

        $mode = $this->useGlobalSuppliers ? 'fornecedores do sistema' : 'fornecedores próprios';
        $this->emit('notifySuccess', "Modo alterado para: {$mode}");
    }

    public function openModal($id = null)
    {
        if ($this->useGlobalSuppliers) {
            $this->emit('notifyError', 'Você está usando fornecedores do sistema. Para criar fornecedores próprios, altere o modo.');
            return;
        }

        $this->resetValidation();
        $this->supplierId = $id;

        if ($id) {
            $companyId = auth()->guard('company')->id();
            $supplier = Supplier::where('company_id', $companyId)
                ->where('type', 'company')
                ->findOrFail($id);

            $this->name = $supplier->name;
            $this->legal_name = $supplier->legal_name;
            $this->cnpj = $supplier->cnpj;
            $this->email = $supplier->email;
            $this->phone = $supplier->phone;
            $this->whatsapp = $supplier->whatsapp;
            $this->website = $supplier->website;
            $this->address = $supplier->address;
            $this->address_number = $supplier->address_number;
            $this->complement = $supplier->complement;
            $this->neighborhood = $supplier->neighborhood;
            $this->city = $supplier->city;
            $this->state = $supplier->state;
            $this->zip_code = $supplier->zip_code;
            $this->notes = $supplier->notes;
            $this->active = $supplier->active;
        } else {
            $this->reset([
                'name',
                'legal_name',
                'cnpj',
                'email',
                'phone',
                'whatsapp',
                'website',
                'address',
                'address_number',
                'complement',
                'neighborhood',
                'city',
                'state',
                'zip_code',
                'notes'
            ]);
            $this->active = true;
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset([
            'supplierId',
            'name',
            'legal_name',
            'cnpj',
            'email',
            'phone',
            'whatsapp',
            'website',
            'address',
            'address_number',
            'complement',
            'neighborhood',
            'city',
            'state',
            'zip_code',
            'notes',
            'active'
        ]);
    }

    public function save()
    {
        $companyId = auth()->guard('company')->id();
        $this->validate();

        if ($this->supplierId) {
            $supplier = Supplier::where('company_id', $companyId)
                ->where('type', 'company')
                ->findOrFail($this->supplierId);

            $supplier->update([
                'name' => $this->name,
                'legal_name' => $this->legal_name,
                'cnpj' => $this->cnpj,
                'email' => $this->email,
                'phone' => $this->phone,
                'whatsapp' => $this->whatsapp,
                'website' => $this->website,
                'address' => $this->address,
                'address_number' => $this->address_number,
                'complement' => $this->complement,
                'neighborhood' => $this->neighborhood,
                'city' => $this->city,
                'state' => $this->state,
                'zip_code' => $this->zip_code,
                'notes' => $this->notes,
                'active' => $this->active,
            ]);

            $this->emit('notifySuccess', "Fornecedor '{$this->name}' atualizado com sucesso!");
        } else {
            Supplier::create([
                'company_id' => $companyId,
                'type' => 'company',
                'name' => $this->name,
                'legal_name' => $this->legal_name,
                'cnpj' => $this->cnpj,
                'email' => $this->email,
                'phone' => $this->phone,
                'whatsapp' => $this->whatsapp,
                'website' => $this->website,
                'address' => $this->address,
                'address_number' => $this->address_number,
                'complement' => $this->complement,
                'neighborhood' => $this->neighborhood,
                'city' => $this->city,
                'state' => $this->state,
                'zip_code' => $this->zip_code,
                'notes' => $this->notes,
                'active' => $this->active,
            ]);

            $this->emit('notifySuccess', "Fornecedor '{$this->name}' criado com sucesso!");
        }

        $this->closeModal();
        $this->emit('refreshSuppliers');
    }

    public function toggleActive($id)
    {
        if ($this->useGlobalSuppliers) {
            $this->emit('notifyError', 'Você não pode modificar fornecedores do sistema.');
            return;
        }

        $companyId = auth()->guard('company')->id();
        $supplier = Supplier::where('company_id', $companyId)
            ->where('type', 'company')
            ->findOrFail($id);

        $supplier->active = !$supplier->active;
        $supplier->save();

        $status = $supplier->active ? 'ativado' : 'desativado';
        $this->emit('notifySuccess', "Fornecedor '{$supplier->name}' {$status} com sucesso!");
    }

    public function delete($id)
    {
        if ($this->useGlobalSuppliers) {
            $this->emit('notifyError', 'Você não pode excluir fornecedores do sistema.');
            return;
        }

        $companyId = auth()->guard('company')->id();
        $supplier = Supplier::where('company_id', $companyId)
            ->where('type', 'company')
            ->findOrFail($id);

        if ($supplier->products_count > 0) {
            $this->emit('notifyError', 'Não é possível excluir um fornecedor com produtos associados.');
            return;
        }

        $name = $supplier->name;
        $supplier->delete();
        $this->emit('notifySuccess', "Fornecedor '{$name}' excluído com sucesso!");
    }

    public function render()
    {
        $companyId = auth()->guard('company')->id();
        $company = Company::find($companyId);

        if ($company->use_global_suppliers) {
            // Mostrar fornecedores globais
            $suppliers = Supplier::global()
                ->withCount('products')
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('legal_name', 'like', '%' . $this->search . '%')
                            ->orWhere('cnpj', 'like', '%' . $this->search . '%');
                    });
                })
                ->orderBy('name')
                ->paginate(10);
        } else {
            // Mostrar fornecedores próprios
            $suppliers = Supplier::where('company_id', $companyId)
                ->where('type', 'company')
                ->withCount('products')
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('legal_name', 'like', '%' . $this->search . '%')
                            ->orWhere('cnpj', 'like', '%' . $this->search . '%');
                    });
                })
                ->orderBy('name')
                ->paginate(10);
        }

        return view('livewire.supplier-list', [
            'suppliers' => $suppliers
        ]);
    }
}
