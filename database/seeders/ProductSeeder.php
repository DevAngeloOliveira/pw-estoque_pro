<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->error('Nenhuma empresa encontrada. Execute o CompanySeeder primeiro!');
            return;
        }

        // TechSol - Empresa 1 (Tecnologia)
        $company1 = $companies->where('nome_fantasia', 'TechSol')->first();
        if ($company1) {
            $categories1 = Category::where('company_id', $company1->id)->get();
            $suppliers1 = Supplier::availableForCompany($company1->id);

            $products1 = [
                [
                    'name' => 'Notebook Dell Inspiron 15',
                    'description' => 'Notebook Intel Core i5, 8GB RAM, SSD 256GB, Tela 15.6" Full HD',
                    'price' => 3299.99,
                    'quantity' => 8,
                    'category_name' => 'Eletrônicos',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Notebook Lenovo IdeaPad',
                    'description' => 'Notebook Intel Core i7, 16GB RAM, SSD 512GB, Tela 15.6"',
                    'price' => 4599.00,
                    'quantity' => 12,
                    'category_name' => 'Eletrônicos',
                    'supplier_index' => 1,
                ],
                [
                    'name' => 'Desktop HP ProDesk',
                    'description' => 'Desktop Intel Core i5, 8GB RAM, HD 1TB, Windows 11 Pro',
                    'price' => 2899.90,
                    'quantity' => 15,
                    'category_name' => 'Informática',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Monitor LG 24" Full HD',
                    'description' => 'Monitor IPS 24 polegadas, Resolução 1920x1080, HDMI',
                    'price' => 799.99,
                    'quantity' => 4,
                    'category_name' => 'Informática',
                    'supplier_index' => 1,
                ],
                [
                    'name' => 'Teclado Mecânico Redragon',
                    'description' => 'Teclado Mecânico RGB, Switch Outemu Blue, ABNT2',
                    'price' => 289.90,
                    'quantity' => 22,
                    'category_name' => 'Acessórios',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Mouse Gamer Logitech G403',
                    'description' => 'Mouse Gamer RGB, 12000 DPI, 6 Botões Programáveis',
                    'price' => 199.99,
                    'quantity' => 30,
                    'category_name' => 'Acessórios',
                    'supplier_index' => 1,
                ],
                [
                    'name' => 'iPhone 13 128GB',
                    'description' => 'Apple iPhone 13, 128GB, Tela 6.1", Câmera Dupla 12MP',
                    'price' => 4299.00,
                    'quantity' => 6,
                    'category_name' => 'Smartphones',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Samsung Galaxy S23',
                    'description' => 'Samsung Galaxy S23, 256GB, Tela 6.1", Câmera Tripla 50MP',
                    'price' => 3899.99,
                    'quantity' => 10,
                    'category_name' => 'Smartphones',
                    'supplier_index' => 1,
                ],
                [
                    'name' => 'Fone Bluetooth JBL Tune 510BT',
                    'description' => 'Fone de Ouvido Bluetooth, 40 Horas de Bateria, Dobrável',
                    'price' => 199.90,
                    'quantity' => 35,
                    'category_name' => 'Acessórios',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'SSD Kingston 480GB',
                    'description' => 'SSD Interno 480GB, SATA III, Leitura 500MB/s',
                    'price' => 279.99,
                    'quantity' => 18,
                    'category_name' => 'Informática',
                    'supplier_index' => 1,
                ],
            ];

            foreach ($products1 as $productData) {
                $category = $categories1->where('name', $productData['category_name'])->first();
                $supplier = $suppliers1->get($productData['supplier_index']);

                Product::create([
                    'company_id' => $company1->id,
                    'category_id' => $category?->id,
                    'supplier_id' => $supplier?->id,
                    'name' => $productData['name'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'quantity' => $productData['quantity'],
                ]);
            }

            $this->command->info('10 produtos criados para TechSol');
        }

        // ABC Store - Empresa 2 (Alimentos e Bebidas) - USA FORNECEDORES GLOBAIS
        $company2 = $companies->where('nome_fantasia', 'ABC Store')->first();
        if ($company2) {
            $categories2 = Category::where('company_id', $company2->id)->get();
            $suppliers2 = Supplier::availableForCompany($company2->id);

            $products2 = [
                [
                    'name' => 'Arroz Tio João 5kg',
                    'description' => 'Arroz Branco Tipo 1, Pacote 5kg',
                    'price' => 24.90,
                    'quantity' => 80,
                    'category_name' => 'Alimentos',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Feijão Carioca Camil 1kg',
                    'description' => 'Feijão Carioca Tipo 1, Pacote 1kg',
                    'price' => 7.99,
                    'quantity' => 120,
                    'category_name' => 'Alimentos',
                    'supplier_index' => 1,
                ],
                [
                    'name' => 'Óleo de Soja Liza 900ml',
                    'description' => 'Óleo de Soja Refinado, Garrafa 900ml',
                    'price' => 6.49,
                    'quantity' => 3,
                    'category_name' => 'Alimentos',
                    'supplier_index' => 2,
                ],
                [
                    'name' => 'Açúcar Cristal União 1kg',
                    'description' => 'Açúcar Cristal Refinado, Pacote 1kg',
                    'price' => 4.29,
                    'quantity' => 150,
                    'category_name' => 'Alimentos',
                    'supplier_index' => 3,
                ],
                [
                    'name' => 'Macarrão Galo Espaguete 500g',
                    'description' => 'Macarrão de Sêmola com Ovos, Pacote 500g',
                    'price' => 3.79,
                    'quantity' => 200,
                    'category_name' => 'Alimentos',
                    'supplier_index' => 4,
                ],
                [
                    'name' => 'Refrigerante Coca-Cola 2L',
                    'description' => 'Refrigerante Coca-Cola, Garrafa 2 Litros',
                    'price' => 8.99,
                    'quantity' => 90,
                    'category_name' => 'Bebidas',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Suco Del Valle Laranja 1L',
                    'description' => 'Suco de Laranja Integral, Caixa 1 Litro',
                    'price' => 6.99,
                    'quantity' => 75,
                    'category_name' => 'Bebidas',
                    'supplier_index' => 1,
                ],
                [
                    'name' => 'Sabonete Dove 90g',
                    'description' => 'Sabonete em Barra Original, Unidade 90g',
                    'price' => 2.99,
                    'quantity' => 180,
                    'category_name' => 'Higiene',
                    'supplier_index' => 2,
                ],
                [
                    'name' => 'Shampoo Clear 400ml',
                    'description' => 'Shampoo Anticaspa Men, Frasco 400ml',
                    'price' => 14.90,
                    'quantity' => 50,
                    'category_name' => 'Higiene',
                    'supplier_index' => 3,
                ],
                [
                    'name' => 'Detergente Ypê Neutro 500ml',
                    'description' => 'Detergente Líquido Neutro, Frasco 500ml',
                    'price' => 2.49,
                    'quantity' => 4,
                    'category_name' => 'Limpeza',
                    'supplier_index' => 4,
                ],
            ];

            foreach ($products2 as $productData) {
                $category = $categories2->where('name', $productData['category_name'])->first();
                $supplier = $suppliers2->get($productData['supplier_index']);

                Product::create([
                    'company_id' => $company2->id,
                    'category_id' => $category?->id,
                    'supplier_id' => $supplier?->id,
                    'name' => $productData['name'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'quantity' => $productData['quantity'],
                ]);
            }

            $this->command->info('10 produtos criados para ABC Store');
        }

        // XYZ Distribuidora - Empresa 3 (Construção)
        $company3 = $companies->where('nome_fantasia', 'XYZ Distribuidora')->first();
        if ($company3) {
            $categories3 = Category::where('company_id', $company3->id)->get();
            $suppliers3 = Supplier::availableForCompany($company3->id);

            $products3 = [
                [
                    'name' => 'Furadeira Bosch GSB 450 RE',
                    'description' => 'Furadeira de Impacto 450W, 110V, Mandril 10mm',
                    'price' => 249.90,
                    'quantity' => 15,
                    'category_name' => 'Ferramentas',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Parafusadeira Makita 12V',
                    'description' => 'Parafusadeira a Bateria 12V, 2 Baterias, Maleta',
                    'price' => 399.00,
                    'quantity' => 12,
                    'category_name' => 'Ferramentas',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Cimento CP II 50kg',
                    'description' => 'Cimento Portland CP II-E-32, Saco 50kg',
                    'price' => 32.90,
                    'quantity' => 3,
                    'category_name' => 'Construção',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Areia Média m³',
                    'description' => 'Areia Média Lavada para Construção, Metro Cúbico',
                    'price' => 85.00,
                    'quantity' => 40,
                    'category_name' => 'Construção',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Tijolo Baiano 8 Furos',
                    'description' => 'Tijolo Cerâmico 8 Furos 9x14x19cm, Milheiro',
                    'price' => 620.00,
                    'quantity' => 25,
                    'category_name' => 'Construção',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Fio Elétrico 2,5mm 100m',
                    'description' => 'Fio de Cobre Flexível 2,5mm², Rolo 100 metros',
                    'price' => 189.90,
                    'quantity' => 18,
                    'category_name' => 'Elétrica',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Disjuntor Bipolar 32A',
                    'description' => 'Disjuntor Termomagnético 32A, Curva C, 2 Polos',
                    'price' => 28.90,
                    'quantity' => 35,
                    'category_name' => 'Elétrica',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Tubo PVC Esgoto 100mm 6m',
                    'description' => 'Tubo PVC Esgoto Série Normal 100mm, Barra 6 metros',
                    'price' => 45.90,
                    'quantity' => 50,
                    'category_name' => 'Hidráulica',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Registro Esfera 3/4"',
                    'description' => 'Registro Esfera em Latão 3/4", Rosca BSP',
                    'price' => 24.90,
                    'quantity' => 45,
                    'category_name' => 'Hidráulica',
                    'supplier_index' => 0,
                ],
                [
                    'name' => 'Caixa D\'Água 500L',
                    'description' => 'Caixa D\'Água Polietileno 500 Litros com Tampa',
                    'price' => 289.00,
                    'quantity' => 8,
                    'category_name' => 'Hidráulica',
                    'supplier_index' => 0,
                ],
            ];

            foreach ($products3 as $productData) {
                $category = $categories3->where('name', $productData['category_name'])->first();
                $supplier = $suppliers3->get($productData['supplier_index']);

                Product::create([
                    'company_id' => $company3->id,
                    'category_id' => $category?->id,
                    'supplier_id' => $supplier?->id,
                    'name' => $productData['name'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'quantity' => $productData['quantity'],
                ]);
            }

            $this->command->info('10 produtos criados para XYZ Distribuidora');
        }

        $this->command->info('Total: 30 produtos criados com sucesso!');
    }
}
