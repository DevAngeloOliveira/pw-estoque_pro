<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::withCount('products');

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('cnpj', 'like', "%{$request->search}%");
            });
        }

        $perPage = $request->get('per_page', 15);
        $suppliers = $query->latest()->paginate($perPage);

        return SupplierResource::collection($suppliers);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'cnpj' => 'nullable|string|max:18',
        ]);

        $supplier = Supplier::create($validated);

        return new SupplierResource($supplier);
    }

    public function show(Supplier $supplier)
    {
        $supplier->loadCount('products');
        return new SupplierResource($supplier);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'cnpj' => 'nullable|string|max:18',
        ]);

        $supplier->update($validated);

        return new SupplierResource($supplier);
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->products()->count() > 0) {
            return response()->json([
                'message' => 'Não é possível excluir um fornecedor com produtos associados.'
            ], 422);
        }

        $supplier->delete();

        return response()->json(['message' => 'Fornecedor excluído com sucesso.']);
    }
}
