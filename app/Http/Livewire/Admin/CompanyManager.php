<?php

namespace App\Http\Livewire\Admin;

use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CompanyManager extends Component
{
    protected $listeners = ['createCompany', 'updateCompany'];

    public function createCompany($data)
    {
        try {
            // Validar dados
            $validated = $this->validate([
                'data.cnpj' => 'required|unique:companies,cnpj|size:14',
                'data.razao_social' => 'required|string|max:255',
                'data.nome_fantasia' => 'required|string|max:255',
                'data.email' => 'required|email|unique:companies,email',
                'data.telefone' => 'required|string',
                'data.endereco' => 'required|string',
                'data.password' => 'required|string|min:6',
            ], [
                'data.cnpj.required' => 'O CNPJ é obrigatório',
                'data.cnpj.unique' => 'Este CNPJ já está cadastrado',
                'data.cnpj.size' => 'CNPJ deve ter 14 dígitos',
                'data.email.unique' => 'Este e-mail já está cadastrado',
                'data.email.required' => 'O e-mail é obrigatório',
                'data.password.required' => 'A senha é obrigatória',
                'data.password.min' => 'A senha deve ter no mínimo 6 caracteres',
            ]);

            // Criar empresa
            $company = Company::create([
                'cnpj' => $data['cnpj'],
                'razao_social' => $data['razao_social'],
                'nome_fantasia' => $data['nome_fantasia'],
                'email' => $data['email'],
                'telefone' => $data['telefone'],
                'endereco' => $data['endereco'],
                'password' => Hash::make($data['password']),
                'use_global_suppliers' => $data['use_global_suppliers'] ?? false,
                'active' => $data['active'] ?? true,
            ]);

            $this->dispatchBrowserEvent('company-saved', [
                'message' => 'Empresa cadastrada com sucesso!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = collect($e->errors())->flatten()->first();
            $this->dispatchBrowserEvent('company-error', [
                'message' => $errors
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('company-error', [
                'message' => 'Erro ao cadastrar empresa: ' . $e->getMessage()
            ]);
        }
    }

    public function updateCompany($id, $data)
    {
        try {
            $company = Company::findOrFail($id);

            // Validar dados (excluindo o CNPJ e email da empresa atual)
            $this->validate([
                'data.razao_social' => 'required|string|max:255',
                'data.nome_fantasia' => 'required|string|max:255',
                'data.telefone' => 'required|string',
                'data.endereco' => 'required|string',
            ]);

            // Atualizar empresa
            $updateData = [
                'razao_social' => $data['razao_social'],
                'nome_fantasia' => $data['nome_fantasia'],
                'telefone' => $data['telefone'],
                'endereco' => $data['endereco'],
                'use_global_suppliers' => $data['use_global_suppliers'] ?? false,
                'active' => $data['active'] ?? true,
            ];

            $company->update($updateData);

            $this->dispatchBrowserEvent('company-saved', [
                'message' => 'Empresa atualizada com sucesso!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = collect($e->errors())->flatten()->first();
            $this->dispatchBrowserEvent('company-error', [
                'message' => $errors
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('company-error', [
                'message' => 'Erro ao atualizar empresa: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.company-manager');
    }
}
