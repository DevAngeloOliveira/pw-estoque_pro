<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductMovement;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->error('Nenhum produto encontrado. Execute o ProductSeeder primeiro!');
            return;
        }

        $totalMovements = 0;

        // Criar movimentações históricas para cada produto
        foreach ($products as $product) {
            // Entradas (compras) - últimos 45 dias
            $numEntradas = rand(2, 3);
            for ($i = 0; $i < $numEntradas; $i++) {
                $quantity = rand(20, 100);
                $unitPrice = $product->price * 0.65; // Custo = 65% do preço de venda

                ProductMovement::create([
                    'product_id' => $product->id,
                    'company_id' => $product->company_id,
                    'type' => 'entrada',
                    'quantity' => $quantity,
                    'unit_price' => round($unitPrice, 2),
                    'total_price' => round($quantity * $unitPrice, 2),
                    'description' => 'Compra de mercadoria - ' . $product->supplier?->name ?? 'Fornecedor',
                    'movement_date' => Carbon::now()->subDays(rand(15, 45)),
                ]);
                $totalMovements++;
            }

            // Saídas (vendas) - últimos 30 dias
            $numSaidas = rand(1, 3);
            for ($i = 0; $i < $numSaidas; $i++) {
                $quantity = rand(5, 30);

                ProductMovement::create([
                    'product_id' => $product->id,
                    'company_id' => $product->company_id,
                    'type' => 'saida',
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'total_price' => round($quantity * $product->price, 2),
                    'description' => 'Venda - Cliente ' . chr(rand(65, 90)) . rand(1000, 9999),
                    'movement_date' => Carbon::now()->subDays(rand(1, 30)),
                ]);
                $totalMovements++;
            }
        }

        // Criar movimentações recentes (últimas 48 horas) para 8 produtos aleatórios
        $recentProducts = $products->random(min(8, $products->count()));

        foreach ($recentProducts as $product) {
            // Entrada recente
            $quantity = rand(15, 50);
            $unitPrice = $product->price * 0.65;

            ProductMovement::create([
                'product_id' => $product->id,
                'company_id' => $product->company_id,
                'type' => 'entrada',
                'quantity' => $quantity,
                'unit_price' => round($unitPrice, 2),
                'total_price' => round($quantity * $unitPrice, 2),
                'description' => 'Reposição urgente - Estoque baixo',
                'movement_date' => Carbon::now()->subHours(rand(12, 48)),
            ]);
            $totalMovements++;

            // Saída recente
            $quantitySaida = rand(3, 10);
            ProductMovement::create([
                'product_id' => $product->id,
                'company_id' => $product->company_id,
                'type' => 'saida',
                'quantity' => $quantitySaida,
                'unit_price' => $product->price,
                'total_price' => round($quantitySaida * $product->price, 2),
                'description' => 'Venda expressa - Pedido urgente',
                'movement_date' => Carbon::now()->subHours(rand(1, 24)),
            ]);
            $totalMovements++;
        }

        $this->command->info("$totalMovements movimentações criadas com sucesso!");
    }
}
