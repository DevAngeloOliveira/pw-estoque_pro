<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Categorias para Empresa 1 (TechSol)
        $company1Categories = [
            [
                'company_id' => 1,
                'name' => 'Eletrônicos',
                'description' => 'Produtos eletrônicos diversos',
                'color' => '#3b82f6',
                'active' => true,
            ],
            [
                'company_id' => 1,
                'name' => 'Informática',
                'description' => 'Computadores, notebooks e periféricos',
                'color' => '#8b5cf6',
                'active' => true,
            ],
            [
                'company_id' => 1,
                'name' => 'Smartphones',
                'description' => 'Celulares e tablets',
                'color' => '#ec4899',
                'active' => true,
            ],
            [
                'company_id' => 1,
                'name' => 'Acessórios',
                'description' => 'Cabos, capas e outros acessórios',
                'color' => '#10b981',
                'active' => true,
            ],
        ];

        // Categorias para Empresa 2 (ABC Store)
        $company2Categories = [
            [
                'company_id' => 2,
                'name' => 'Alimentos',
                'description' => 'Produtos alimentícios',
                'color' => '#f59e0b',
                'active' => true,
            ],
            [
                'company_id' => 2,
                'name' => 'Bebidas',
                'description' => 'Bebidas em geral',
                'color' => '#06b6d4',
                'active' => true,
            ],
            [
                'company_id' => 2,
                'name' => 'Higiene',
                'description' => 'Produtos de higiene pessoal',
                'color' => '#84cc16',
                'active' => true,
            ],
            [
                'company_id' => 2,
                'name' => 'Limpeza',
                'description' => 'Produtos de limpeza',
                'color' => '#6366f1',
                'active' => true,
            ],
        ];

        // Categorias para Empresa 3 (XYZ Distribuidora)
        $company3Categories = [
            [
                'company_id' => 3,
                'name' => 'Ferramentas',
                'description' => 'Ferramentas manuais e elétricas',
                'color' => '#ef4444',
                'active' => true,
            ],
            [
                'company_id' => 3,
                'name' => 'Construção',
                'description' => 'Materiais de construção',
                'color' => '#f97316',
                'active' => true,
            ],
            [
                'company_id' => 3,
                'name' => 'Elétrica',
                'description' => 'Material elétrico',
                'color' => '#eab308',
                'active' => true,
            ],
            [
                'company_id' => 3,
                'name' => 'Hidráulica',
                'description' => 'Material hidráulico',
                'color' => '#0ea5e9',
                'active' => true,
            ],
        ];

        $allCategories = array_merge($company1Categories, $company2Categories, $company3Categories);

        foreach ($allCategories as $category) {
            Category::create($category);
        }

        $this->command->info('Categories seeded successfully!');
    }
}
