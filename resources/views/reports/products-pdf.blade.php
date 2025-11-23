<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4F46E5;
            padding-bottom: 15px;
        }

        .header h1 {
            color: #4F46E5;
            margin: 0;
            font-size: 24px;
        }

        .company-info {
            margin: 20px 0;
            padding: 10px;
            background-color: #F3F4F6;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background-color: #4F46E5;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
        }

        table td {
            padding: 8px;
            border-bottom: 1px solid #E5E7EB;
        }

        table tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        .summary {
            margin-top: 30px;
            padding: 15px;
            background-color: #DBEAFE;
            border-left: 4px solid #3B82F6;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6B7280;
        }

        .status-good {
            color: #10B981;
            font-weight: bold;
        }

        .status-warning {
            color: #F59E0B;
            font-weight: bold;
        }

        .status-danger {
            color: #EF4444;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>📦 Relatório de Produtos</h1>
        <p>{{ $company->razao_social }}</p>
        <p>CNPJ: {{ $company->formatted_cnpj }}</p>
        <p>Gerado em: {{ $date }}</p>
    </div>

    <div class="company-info">
        <strong>Empresa:</strong> {{ $company->nome_fantasia ?? $company->razao_social }}<br>
        <strong>Total de Produtos:</strong> {{ $products->count() }}<br>
        <strong>Valor Total em Estoque:</strong> R$ {{ number_format($totalValue, 2, ',', '.') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Qtd</th>
                <th>Valor Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>R$ {{ number_format($product->price * $product->quantity, 2, ',', '.') }}</td>
                    <td
                        class="{{ $product->quantity > 10 ? 'status-good' : ($product->quantity > 0 ? 'status-warning' : 'status-danger') }}">
                        {{ $product->quantity > 10 ? 'Em Estoque' : ($product->quantity > 0 ? 'Estoque Baixo' : 'Sem Estoque') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">Nenhum produto cadastrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <h3>Resumo Geral</h3>
        <p><strong>Total de Produtos:</strong> {{ $products->count() }}</p>
        <p><strong>Produtos em Estoque:</strong> {{ $products->where('quantity', '>', 10)->count() }}</p>
        <p><strong>Produtos com Estoque Baixo:</strong>
            {{ $products->where('quantity', '>', 0)->where('quantity', '<=', 10)->count() }}</p>
        <p><strong>Produtos Sem Estoque:</strong> {{ $products->where('quantity', 0)->count() }}</p>
        <p><strong>Valor Total:</strong> R$ {{ number_format($totalValue, 2, ',', '.') }}</p>
    </div>

    <div class="footer">
        <p>Relatório gerado automaticamente pelo Sistema de Estoque Pro</p>
        <p>{{ $date }}</p>
    </div>
</body>

</html>
