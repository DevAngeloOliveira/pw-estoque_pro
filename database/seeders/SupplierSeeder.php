<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fornecedores Globais (do Sistema)
        $globalSuppliers = [
            [
                'company_id' => null,
                'is_global' => true,
                'name' => 'Atacadão Distribuidora',
                'legal_name' => 'Atacadão Distribuidora Nacional S.A.',
                'cnpj' => '12.345.678/0001-90',
                'email' => 'vendas@atacadao.com.br',
                'phone' => '(11) 3000-1000',
                'whatsapp' => '(11) 99000-1000',
                'website' => 'https://atacadao.com.br',
                'address' => 'Av. Industrial',
                'address_number' => '1500',
                'neighborhood' => 'Distrito Industrial',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01000-000',
                'notes' => 'Fornecedor nacional com grande variedade de produtos',
                'active' => true,
            ],
            [
                'company_id' => null,
                'is_global' => true,
                'name' => 'Makro Atacadista',
                'legal_name' => 'Makro Atacadista S.A.',
                'cnpj' => '23.456.789/0001-01',
                'email' => 'contato@makro.com.br',
                'phone' => '(11) 4000-2000',
                'whatsapp' => '(11) 94000-2000',
                'website' => 'https://makro.com.br',
                'address' => 'Rodovia Anhanguera',
                'address_number' => 'Km 15',
                'neighborhood' => 'Vila Maria',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '02000-000',
                'notes' => 'Especializado em produtos alimentícios e bebidas',
                'active' => true,
            ],
            [
                'company_id' => null,
                'is_global' => true,
                'name' => 'Martins Atacado',
                'legal_name' => 'Martins Comércio e Serviços de Distribuição S.A.',
                'cnpj' => '34.567.890/0001-12',
                'email' => 'vendas@martinssupply.com.br',
                'phone' => '(31) 2100-3000',
                'whatsapp' => '(31) 92100-3000',
                'website' => 'https://martins.com.br',
                'address' => 'Av. do Contorno',
                'address_number' => '8000',
                'neighborhood' => 'Centro',
                'city' => 'Uberlândia',
                'state' => 'MG',
                'zip_code' => '38000-000',
                'notes' => 'Um dos maiores distribuidores do Brasil',
                'active' => true,
            ],
            [
                'company_id' => null,
                'is_global' => true,
                'name' => 'Assaí Atacadista',
                'legal_name' => 'Assaí Atacadista Ltda',
                'cnpj' => '45.678.901/0001-23',
                'email' => 'b2b@assai.com.br',
                'phone' => '(11) 5000-4000',
                'whatsapp' => '(11) 95000-4000',
                'website' => 'https://assai.com.br',
                'address' => 'Av. Mutinga',
                'address_number' => '3000',
                'neighborhood' => 'Pirituba',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05000-000',
                'notes' => 'Foco em varejo e atacado',
                'active' => true,
            ],
            [
                'company_id' => null,
                'is_global' => true,
                'name' => 'Roldão Atacadista',
                'legal_name' => 'Roldão Comércio Ltda',
                'cnpj' => '56.789.012/0001-34',
                'email' => 'vendas@roldao.com.br',
                'phone' => '(11) 6000-5000',
                'whatsapp' => '(11) 96000-5000',
                'website' => 'https://roldao.com.br',
                'address' => 'Rua Tuiuti',
                'address_number' => '2100',
                'neighborhood' => 'Tatuapé',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '03000-000',
                'notes' => 'Rede regional com ótimos preços',
                'active' => true,
            ],
        ];

        foreach ($globalSuppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Fornecedores da Empresa 1 (TechSol)
        $company1Suppliers = [
            [
                'company_id' => 1,
                'is_global' => false,
                'name' => 'Eletrônicos Silva',
                'legal_name' => 'Silva Eletrônicos ME',
                'cnpj' => '67.890.123/0001-45',
                'email' => 'contato@eletronicossilva.com.br',
                'phone' => '(11) 3200-1500',
                'whatsapp' => '(11) 93200-1500',
                'address' => 'Rua da Consolação',
                'address_number' => '850',
                'neighborhood' => 'Centro',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01300-000',
                'notes' => 'Especializado em componentes eletrônicos',
                'active' => true,
            ],
            [
                'company_id' => 1,
                'is_global' => false,
                'name' => 'Tech Import',
                'legal_name' => 'Tech Import Comércio Ltda',
                'cnpj' => '78.901.234/0001-56',
                'email' => 'vendas@techimport.com.br',
                'phone' => '(11) 4100-2600',
                'whatsapp' => '(11) 94100-2600',
                'address' => 'Av. Faria Lima',
                'address_number' => '3500',
                'neighborhood' => 'Itaim Bibi',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '04500-000',
                'notes' => 'Importador de tecnologia',
                'active' => true,
            ],
        ];

        foreach ($company1Suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Fornecedores da Empresa 3 (XYZ Distribuidora)
        $company3Suppliers = [
            [
                'company_id' => 3,
                'is_global' => false,
                'name' => 'Fornecedor Local MG',
                'legal_name' => 'Comércio Mineiro Ltda',
                'cnpj' => '89.012.345/0001-67',
                'email' => 'contato@fornecedorlocalmg.com.br',
                'phone' => '(31) 3500-7000',
                'whatsapp' => '(31) 93500-7000',
                'address' => 'Rua dos Carijós',
                'address_number' => '120',
                'neighborhood' => 'Centro',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30000-000',
                'notes' => 'Fornecedor regional confiável',
                'active' => true,
            ],
        ];

        foreach ($company3Suppliers as $supplier) {
            Supplier::create($supplier);
        }

        $this->command->info('Suppliers seeded successfully!');
    }
}
