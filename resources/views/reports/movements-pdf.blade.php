<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Movimentações</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #4F46E5;
            padding-bottom: 15px;
        }

        .header h1 {
            color: #4F46E5;
            margin: 0;
            font-size: 22px;
        }

        .company-info {
            margin: 15px 0;
            padding: 10px;
            background-color: #F3F4F6;
            border-radius: 5px;
        }

        .summary-cards {
            display: table;
            width: 100%;
            margin: 20px 0;
        }

        .summary-card {
            display: table-cell;
            width: 33%;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin: 0 5px;
        }

        .card-entrada {
            background-color: #DBEAFE;
            border-left: 4px solid #3B82F6;
        }

        .card-saida {
            background-color: #FEE2E2;
            border-left: 4px solid #EF4444;
        }

        .card-ganho {
            background-color: #D1FAE5;
            border-left: 4px solid #10B981;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background-color: #4F46E5;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }

        table td {
            padding: 6px;
            border-bottom: 1px solid #E5E7EB;
            font-size: 10px;
        }

        table tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        .type-entrada {
            color: #3B82F6;
            font-weight: bold;
        }

        .type-saida {
            color: #EF4444;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #6B7280;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🔄 Relatório de Movimentações</h1>
        <p>{{ $company->razao_social }}</p>
        <p>CNPJ: {{ $company->formatted_cnpj }}</p>
        <p>Gerado em: {{ $date }}</p>
    </div>

    @if (!empty($filters))
        <div class="company-info">
            <strong>Filtros Aplicados:</strong><br>
            @if (isset($filters['type']))
                Tipo: {{ ucfirst($filters['type']) }}<br>
            @endif
            @if (isset($filters['date_from']))
                Data Inicial: {{ \Carbon\Carbon::parse($filters['date_from'])->format('d/m/Y') }}<br>
            @endif
            @if (isset($filters['date_to']))
                Data Final: {{ \Carbon\Carbon::parse($filters['date_to'])->format('d/m/Y') }}<br>
            @endif
        </div>
    @endif

    <div class="summary-cards">
        <div class="summary-card card-entrada">
            <strong>Total Entradas</strong><br>
            <span style="font-size: 16px;">R$ {{ number_format($totalEntradas, 2, ',', '.') }}</span>
        </div>
        <div class="summary-card card-saida">
            <strong>Total Saídas</strong><br>
            <span style="font-size: 16px;">R$ {{ number_format($totalSaidas, 2, ',', '.') }}</span>
        </div>
        <div class="summary-card card-ganho">
            <strong>Ganhos</strong><br>
            <span style="font-size: 16px;">R$ {{ number_format($totalGanhos, 2, ',', '.') }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Qtd</th>
                <th>Preço Unit.</th>
                <th>Total</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movements as $movement)
                <tr>
                    <td>{{ $movement->movement_date->format('d/m/Y H:i') }}</td>
                    <td>{{ $movement->product->name }}</td>
                    <td class="{{ $movement->type === 'entrada' ? 'type-entrada' : 'type-saida' }}">
                        {{ ucfirst($movement->type) }}
                    </td>
                    <td>{{ $movement->quantity }}</td>
                    <td>R$ {{ number_format($movement->unit_price, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($movement->total_price, 2, ',', '.') }}</td>
                    <td>{{ $movement->description ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 20px;">Nenhuma movimentação encontrada</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Relatório gerado automaticamente pelo Sistema de Estoque Pro</p>
        <p>{{ $date }} | Total de Movimentações: {{ $movements->count() }}</p>
    </div>
</body>

</html>
