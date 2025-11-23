<?php

namespace App\Http\Livewire\Admin;

use App\Models\Supplier;
use App\Models\Product;
use Livewire\Component;

class GlobalSupplierManager extends Component
{
    protected $listeners = ['createSupplier', 'updateSupplier', 'loadSupplier', 'refreshSuppliers' => '$refresh'];

    public function mount()
    {
        $this->updateStats();
    }

    public function updateStats()
    {
        $globalSuppliers = Supplier::where('is_global', true)->get();
        $activeCount = $globalSuppliers->where('active', true)->count();

        // Contar fornecedores em uso (que têm produtos vinculados)
        $inUseCount = $globalSuppliers->filter(function ($supplier) {
            return Product::where('supplier_id', $supplier->id)->exists();
        })->count();

        $this->dispatchBrowserEvent('stats-updated', [
            'total' => $globalSuppliers->count(),
            'active' => $activeCount,
            'inUse' => $inUseCount
        ]);
    }

    public function loadSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);

        // Formatar CNPJ se existir
        $formattedCnpj = '';
        if ($supplier->cnpj && strlen($supplier->cnpj) == 14) {
            $formattedCnpj = substr($supplier->cnpj, 0, 2) . '.' .
                substr($supplier->cnpj, 2, 3) . '.' .
                substr($supplier->cnpj, 5, 3) . '/' .
                substr($supplier->cnpj, 8, 4) . '-' .
                substr($supplier->cnpj, 12, 2);
        }

        // Formatar CEP se existir
        $formattedZip = '';
        if ($supplier->zip_code && strlen($supplier->zip_code) == 8) {
            $formattedZip = substr($supplier->zip_code, 0, 5) . '-' . substr($supplier->zip_code, 5, 3);
        }

        $this->dispatchBrowserEvent('supplier-loaded', [
            'id' => $supplier->id,
            'name' => $supplier->name,
            'legal_name' => $supplier->legal_name,
            'cnpj' => $supplier->cnpj,
            'formatted_cnpj' => $formattedCnpj,
            'email' => $supplier->email,
            'phone' => $supplier->phone,
            'whatsapp' => $supplier->whatsapp,
            'website' => $supplier->website,
            'address' => $supplier->address,
            'address_number' => $supplier->address_number,
            'neighborhood' => $supplier->neighborhood,
            'complement' => $supplier->complement,
            'city' => $supplier->city,
            'state' => $supplier->state,
            'zip_code' => $supplier->zip_code,
            'formatted_zip' => $formattedZip,
            'notes' => $supplier->notes,
            'active' => $supplier->active,
        ]);
    }

    public function createSupplier($data)
    {
        try {
            $supplier = Supplier::create([
                'name' => $data['name'],
                'legal_name' => $data['legal_name'] ?? null,
                'cnpj' => $data['cnpj'] ?? null,
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'whatsapp' => $data['whatsapp'] ?? null,
                'website' => $data['website'] ?? null,
                'address' => $data['address'] ?? null,
                'address_number' => $data['address_number'] ?? null,
                'neighborhood' => $data['neighborhood'] ?? null,
                'complement' => $data['complement'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'zip_code' => $data['zip_code'] ?? null,
                'notes' => $data['notes'] ?? null,
                'active' => $data['active'] ?? true,
                'is_global' => true,
                'company_id' => null,
            ]);

            $this->updateStats();
            $this->dispatchBrowserEvent('supplier-saved', [
                'message' => 'Fornecedor global criado com sucesso!'
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('supplier-error', [
                'message' => 'Erro ao criar fornecedor: ' . $e->getMessage()
            ]);
        }
    }

    public function updateSupplier($id, $data)
    {
        try {
            $supplier = Supplier::findOrFail($id);

            $supplier->update([
                'name' => $data['name'],
                'legal_name' => $data['legal_name'] ?? null,
                'cnpj' => $data['cnpj'] ?? null,
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'whatsapp' => $data['whatsapp'] ?? null,
                'website' => $data['website'] ?? null,
                'address' => $data['address'] ?? null,
                'address_number' => $data['address_number'] ?? null,
                'neighborhood' => $data['neighborhood'] ?? null,
                'complement' => $data['complement'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'zip_code' => $data['zip_code'] ?? null,
                'notes' => $data['notes'] ?? null,
                'active' => $data['active'] ?? true,
            ]);

            $this->updateStats();
            $this->dispatchBrowserEvent('supplier-saved', [
                'message' => 'Fornecedor atualizado com sucesso!'
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('supplier-error', [
                'message' => 'Erro ao atualizar fornecedor: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteSupplier($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);

            // Verificar se tem produtos vinculados
            if (Product::where('supplier_id', $id)->exists()) {
                $this->dispatchBrowserEvent('supplier-error', [
                    'message' => 'Não é possível excluir um fornecedor com produtos vinculados.'
                ]);
                return;
            }

            $supplier->delete();
            $this->updateStats();

            $this->dispatchBrowserEvent('supplier-deleted', [
                'message' => 'Fornecedor excluído com sucesso!'
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('supplier-error', [
                'message' => 'Erro ao excluir fornecedor: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        $suppliers = Supplier::where('is_global', true)
            ->orderBy('name')
            ->get()
            ->map(function ($supplier) {
                // Formatar CNPJ
                $formattedCnpj = '';
                if ($supplier->cnpj && strlen($supplier->cnpj) == 14) {
                    $formattedCnpj = substr($supplier->cnpj, 0, 2) . '.' .
                        substr($supplier->cnpj, 2, 3) . '.' .
                        substr($supplier->cnpj, 5, 3) . '/' .
                        substr($supplier->cnpj, 8, 4) . '-' .
                        substr($supplier->cnpj, 12, 2);
                }

                // Contar produtos
                $productsCount = Product::where('supplier_id', $supplier->id)->count();

                return [
                    'id' => $supplier->id,
                    'name' => $supplier->name,
                    'cnpj' => $formattedCnpj ?: 'N/A',
                    'email' => $supplier->email ?: 'N/A',
                    'phone' => $supplier->phone ?: 'N/A',
                    'city' => $supplier->city ?: 'N/A',
                    'state' => $supplier->state ?: '',
                    'active' => $supplier->active,
                    'products_count' => $productsCount,
                ];
            });

        return view('livewire.admin.global-supplier-manager', [
            'suppliers' => $suppliers
        ]);
    }
}
