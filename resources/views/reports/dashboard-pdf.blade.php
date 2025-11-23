<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Geral - Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #3b82f6;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #1e40af;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .company-info {
            background: #f3f4f6;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .company-info h3 {
            color: #1e40af;
            margin-bottom: 10px;
        }

        .summary-cards {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .card {
            display: table-cell;
            width: 25%;
            padding: 15px;
            text-align: center;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .card h4 {
            color: #6b7280;
            font-size: 10px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .card .value {
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
        }

        .section {
            margin-bottom: 25px;
        }

        .section h3 {
            background: #3b82f6;
            color: white;
            padding: 8px 12px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table th {
            background: #f3f4f6;
            padding: 8px;
            text-align: left;
            font-size: 11px;
            border: 1px solid #e5e7eb;
        }

        table td {
            padding: 8px;
            border: 1px solid #e5e7eb;
            font-size: 10px;
        }

        .badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-entrada {
            background: #dcfce7;
            color: #166534;
        }

        .badge-saida {
            background: #fee2e2;
            color: #991b1b;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 10px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Relatório Geral - Dashboard</h1>
        <p>Gerado em {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="company-info">
        <h3>Informações da Empresa</h3>
        <p><strong>Razão Social:</strong> {{ $company->razao_social }}</p>
        @if ($company->nome_fantasia)
            <p><strong>Nome Fantasia:</strong> {{ $company->nome_fantasia }}</p>
        @endif
        <p><strong>CNPJ:</strong> {{ $company->cnpj }}</p>
        @if ($company->email)
            <p><strong>Email:</strong> {{ $company->email }}</p>
        @endif
    </div>

    <div class="summary-cards">
        <div class="card">
            <h4>Total de Produtos</h4>
            <div class="value">{{ $totalProducts }}</div>
        </div>
        <div class="card">
            <h4>Valor em Estoque</h4>
            <div class="value">R$ {{ number_format($totalValue, 2, ',', '.') }}</div>
        </div>
        <div class="card">
            <h4>Estoque Baixo</h4>
            <div class="value">{{ $lowStockProducts }}</div>
        </div>
        <div class="card">
            <h4>Ganhos Totais</h4>
            <div class="value">R$ {{ number_format($totalGanhos, 2, ',', '.') }}</div>
        </div>
    </div>

    <div class="section">
        <h3>Resumo Financeiro</h3>
        <table>
            <tr>
                <th>Descrição</th>
                <th style="text-align: right;">Valor</th>
            </tr>
            <tr>
                <td>Total de Entradas</td>
                <td style="text-align: right;">R$ {{ number_format($totalEntradas, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total de Saídas</td>
                <td style="text-align: right;">R$ {{ number_format($totalSaidas, 2, ',', '.') }}</td>
            </tr>
            <tr style="background: #f3f4f6; font-weight: bold;">
                <td>Lucro Bruto</td>
                <td style="text-align: right;">R$ {{ number_format($totalGanhos, 2, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>Top 5 Produtos Mais Vendidos (30 dias)</h3>
        @if ($topProducts->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Posição</th>
                        <th>Produto</th>
                        <th style="text-align: center;">Quantidade</th>
                        <th style="text-align: right;">Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topProducts as $index => $movement)
                        <tr>
                            <td style="text-align: center; font-weight: bold;">{{ $index + 1 }}º</td>
                            <td>{{ $movement->product->name }}</td>
                            <td style="text-align: center;">{{ $movement->total_quantity }}</td>
                            <td style="text-align: right;">R$ {{ number_format($movement->total_value, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Nenhuma venda registrada nos últimos 30 dias</div>
        @endif
    </div>

    <div class="section">
        <h3>Produtos com Estoque Baixo (≤ 10 unidades)</h3>
        @if ($lowStockList->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>SKU</th>
                        <th style="text-align: center;">Quantidade</th>
                        <th style="text-align: right;">Preço</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lowStockList as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td style="text-align: center;">
                                <span style="color: #dc2626; font-weight: bold;">{{ $product->quantity }}</span>
                            </td>
                            <td style="text-align: right;">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Nenhum produto com estoque baixo</div>
        @endif
    </div>

    <div class="section">
        <h3>Últimas Movimentações</h3>
        @if ($recentMovements->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Produto</th>
                        <th style="text-align: center;">Tipo</th>
                        <th style="text-align: center;">Quantidade</th>
                        <th style="text-align: right;">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentMovements as $movement)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($movement->movement_date)->format('d/m/Y H:i') }}</td>
                            <td>{{ $movement->product->name }}</td>
                            <td style="text-align: center;">
                                <span class="badge badge-{{ $movement->type }}">
                                    {{ strtoupper($movement->type) }}
                                </span>
                            </td>
                            <td style="text-align: center;">{{ $movement->quantity }}</td>
                            <td style="text-align: right;">R$ {{ number_format($movement->total_price, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Nenhuma movimentação registrada</div>
        @endif
    </div>

    <div class="footer">
        <p>Sistema de Gestão de Estoque - {{ $company->razao_social }}</p>
        <p>Relatório confidencial - Uso exclusivo da empresa</p>
    </div>
</body>

</html>
