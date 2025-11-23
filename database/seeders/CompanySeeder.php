<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'cnpj' => '12345678000195',
                'razao_social' => 'Tech Solutions Ltda',
                'nome_fantasia' => 'TechSol',
                'email' => 'contato@techsol.com.br',
                'telefone' => '11987654321',
                'endereco' => 'Av. Paulista, 1000 - São Paulo, SP',
                'password' => 'senha123',
                'active' => true,
                'use_global_suppliers' => false,
            ],
            [
                'cnpj' => '98765432000110',
                'razao_social' => 'Comércio ABC Ltda',
                'nome_fantasia' => 'ABC Store',
                'email' => 'contato@abcstore.com.br',
                'telefone' => '21923456789',
                'endereco' => 'Rua das Flores, 500 - Rio de Janeiro, RJ',
                'password' => 'senha123',
                'active' => true,
                'use_global_suppliers' => true,
            ],
            [
                'cnpj' => '11222333000144',
                'razao_social' => 'Distribuidora XYZ ME',
                'nome_fantasia' => 'XYZ Distribuidora',
                'email' => 'contato@xyzdist.com.br',
                'telefone' => '31933334444',
                'endereco' => 'Av. Afonso Pena, 2500 - Belo Horizonte, MG',
                'password' => 'senha123',
                'active' => true,
                'use_global_suppliers' => false,
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }

        $this->command->info('Empresas criadas com sucesso!');
    }
}
