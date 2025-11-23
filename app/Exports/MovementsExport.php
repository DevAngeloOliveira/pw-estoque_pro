<?php

namespace App\Exports;

use App\Models\ProductMovement;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MovementsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $companyId = Auth::guard('company')->user()->id;

        $query = ProductMovement::with('product')
            ->where('company_id', $companyId);

        if (isset($this->filters['type'])) {
            $query->where('type', $this->filters['type']);
        }

        if (isset($this->filters['date_from'])) {
            $query->whereDate('movement_date', '>=', $this->filters['date_from']);
        }

        if (isset($this->filters['date_to'])) {
            $query->whereDate('movement_date', '<=', $this->filters['date_to']);
        }

        return $query->orderBy('movement_date', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Data',
            'Produto',
            'SKU',
            'Tipo',
            'Quantidade',
            'Preço Unitário (R$)',
            'Valor Total (R$)',
            'Descrição'
        ];
    }

    public function map($movement): array
    {
        return [
            $movement->movement_date->format('d/m/Y H:i'),
            $movement->product->name,
            $movement->product->sku,
            ucfirst($movement->type),
            $movement->quantity,
            number_format($movement->unit_price, 2, ',', '.'),
            number_format($movement->total_price, 2, ',', '.'),
            $movement->description ?? '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
