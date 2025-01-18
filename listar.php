<?php
require_once 'conexao.php'; 

// Chama a função getConexao para obter a conexão com o banco de dados
$connection = getConexao();

// Consulta para listar os dados da tabela
$sql = "SELECT Nome_live, Foguete, Data, Partiu, Scrub, Explodiu, Elon_Musk, Outros, Alcantara FROM `lancamentos`;";
$result = $connection->query($sql);

// Consulta para somar os totais das colunas
$sqlTotais = "
    SELECT 
        COUNT(CASE WHEN Partiu = 'Sim' THEN 1 END) AS total_partiu,
        COUNT(CASE WHEN Scrub = 'Sim' THEN 1 END) AS total_scrub,
        COUNT(CASE WHEN Explodiu = 'Sim' THEN 1 END) AS total_explodiu,
        COUNT(CASE WHEN Elon_Musk = 'Sim' THEN 1 END) AS total_elonmusk,
        COUNT(CASE WHEN Outros = 'Sim' THEN 1 END) AS total_outros,
        COUNT(CASE WHEN Alcantara = 'Sim' THEN 1 END) AS total_alcantara
    FROM `lancamentos`;
";
$resultTotais = $connection->query($sqlTotais);

if ($resultTotais->num_rows > 0) {
    $totais = $resultTotais->fetch_assoc();
    $totalPartiu = $totais['total_partiu'] ?? 0;
    $totalScrub = $totais['total_scrub'] ?? 0;
    $totalExplodiu = $totais['total_explodiu'] ?? 0;
    $totalElon_musk = $totais['total_elonmusk'] ?? 0;
    $totalOutros = $totais['total_outros'] ?? 0;
    $totalAlcantara = $totais['total_alcantara'] ?? 0;
} else {
    $totalPartiu = $totalScrub = $totalExplodiu = 0;
}

// Fecha a conexão com o banco de dados
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela Lançamentos Today</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #f4f4f4;
            text-align: left;
        }

        #grafico1 {
            display: block;
            margin: 20px auto; /* Centraliza o gráfico */
            width: 600px; /* Largura ajustada */
            height: 400px; /* Altura ajustada */
        }

        #grafico2 {
            display: block;
            margin: 20px auto; /* Centraliza o gráfico */
            width: 500px; /* Largura ajustada */
            height: 300px; /* Altura ajustada */
        }

        .titulo-centralizado {
        text-align: center;
        font-size: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
    }   
    </style>
</head>
<body>
    <h1>Tabela Lançamentos Space Today</h1>

    <!-- Tabela de dados -->
    <table>
        <thead>
            <tr>
                <th>Nome_live</th>
                <th>Foguete</th>
                <th>Data</th>
                <th>Partiu</th>
                <th>Scrub</th>
                <th>Explodiu</th>
                <th>Elon_Musk</th>
                <th>Outros</th>
                <th>Alcântara</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['Nome_live']) ?></td>
                        <td><?= htmlspecialchars($row['Foguete']) ?></td>
                        <td>
                           <?php 
                                $dataOriginal = $row['Data'];
                                $dataFormatada = (new DateTime($dataOriginal))->format('d/m/Y');
                                echo htmlspecialchars($dataFormatada);
                            ?>
                        </td>
                        <td><?= $row['Partiu'] ?></td>
                        <td><?= $row['Scrub'] ?></td>
                        <td><?= $row['Explodiu'] ?></td>
                        <td><?= $row['Elon_Musk'] ?></td>
                        <td><?= $row['Outros'] ?></td>
                        <td><?= $row['Alcantara'] ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">Nenhum dado encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Gráfico 1 -->
    <h2 class="titulo-centralizado">Status dos Lançamentos</h2>
    <canvas id="grafico1"></canvas>

    <script>
        // Dados para o gráfico 1
        const data1 = {
            labels: ['Partiu', 'Scrub', 'Explodiu'],
            datasets: [{
                label: 'Total',
                data: [<?= $totalPartiu ?>, <?= $totalScrub ?>, <?= $totalExplodiu ?>],
                backgroundColor: ['#00ff00', '#ffff00', '#ff0000'],
                borderColor: ['#00ff00', '#ffff00', '#ff0000'],
                borderWidth: 1
            }]
        };

        // Configuração do gráfico 1
        const config1 = {
            type: 'bar', // Tipo de gráfico (barra)
            data: data1,
            options: {
                plugins: {
                    legend: { display: false } // Remove a legenda
                },
                scales: {
                    y: {
                        beginAtZero: true // Começa do zero no eixo Y
                    }
                }
            }
        };

        // Renderiza o gráfico 1
        new Chart(
            document.getElementById('grafico1'),
            config1
        );
    </script>

    <!-- Gráfico 2 -->
    <h2 class="titulo-centralizado">Status Bases</h2>
    <canvas id="grafico2"></canvas>

    <script>
        // Dados para o gráfico 2
        const data2 = {
            labels: ['Elon_Musk', 'Outros', 'Alcantara'],
            datasets: [{
                label: 'Total',
                data: [<?= $totalElon_musk ?>, <?= $totalOutros ?>, <?= $totalAlcantara ?>],
                backgroundColor: ['#00ff00', '#ffff00', '#ff0000'],
                borderColor: ['#00ff00', '#ffff00', '#ff0000'],
                borderWidth: 1
            }]
        };

        // Configuração do gráfico 2
        const config2 = {
            type: 'doughnut', // Tipo de gráfico (rosca)
            data: data2,
            options: {
                plugins: {
                    legend: { display: false } // Remove a legenda
                }
            }
        };

        // Renderiza o gráfico 2
        new Chart(
            document.getElementById('grafico2'),
            config2
        );
    </script>
</body>
</html>
