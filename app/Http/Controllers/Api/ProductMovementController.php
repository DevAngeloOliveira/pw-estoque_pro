<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductMovementResource;
use App\Models\ProductMovement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductMovementController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductMovement::with(['product', 'user']);

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $perPage = $request->get('per_page', 15);
        $movements = $query->latest()->paginate($perPage);

        return ProductMovementResource::collection($movements);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:entrada,saida',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        return DB::transaction(function () use ($validated, $product, $request) {
            // Cria a movimentação
            $movement = ProductMovement::create([
                'product_id' => $validated['product_id'],
                'user_id' => $request->user()->id,
                'company_id' => $product->company_id,
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'price' => $validated['price'],
                'notes' => $validated['notes'] ?? null,
            ]);

            // Atualiza quantidade do produto
            if ($validated['type'] === 'entrada') {
                $product->increment('quantity', $validated['quantity']);
            } else {
                if ($product->quantity < $validated['quantity']) {
                    throw new \Exception('Quantidade insuficiente em estoque.');
                }
                $product->decrement('quantity', $validated['quantity']);
            }

            $movement->load(['product', 'user']);

            return new ProductMovementResource($movement);
        });
    }

    public function show(ProductMovement $productMovement)
    {
        $productMovement->load(['product', 'user']);
        return new ProductMovementResource($productMovement);
    }

    public function destroy(ProductMovement $productMovement)
    {
        return DB::transaction(function () use ($productMovement) {
            $product = $productMovement->product;

            // Reverte a movimentação
            if ($productMovement->type === 'entrada') {
                $product->decrement('quantity', $productMovement->quantity);
            } else {
                $product->increment('quantity', $productMovement->quantity);
            }

            $productMovement->delete();

            return response()->json(['message' => 'Movimentação excluída e estoque ajustado com sucesso.']);
        });
    }
}
