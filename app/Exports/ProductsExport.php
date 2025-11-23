<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        $companyId = Auth::guard('company')->user()->id;

        return Product::where('company_id', $companyId)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Nome',
            'Descrição',
            'Preço (R$)',
            'Quantidade',
            'Valor Total (R$)',
            'Status',
            'Data de Cadastro'
        ];
    }

    public function map($product): array
    {
        $status = $product->quantity > 10 ? 'Em Estoque' : ($product->quantity > 0 ? 'Estoque Baixo' : 'Sem Estoque');

        return [
            $product->sku,
            $product->name,
            $product->description,
            number_format($product->price, 2, ',', '.'),
            $product->quantity,
            number_format($product->price * $product->quantity, 2, ',', '.'),
            $status,
            $product->created_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
