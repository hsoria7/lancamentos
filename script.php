<?php
include 'conexao.php';
$conn = getConexao();

ob_start(); // Captura o conteúdo para salvar no arquivo

echo "<!DOCTYPE html>";
echo "<html lang='pt-br'>";
echo "<head><title>Dados</title></head>";
echo "<body><h1>Dados do Banco</h1>";

$sql = "SELECT Nome_live, Foguete, Data FROM lancamentos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>Nome: {$row['Nome_live']}, Foguete: {$row['Foguete']}, Data: {$row['Data']}</p>";
    }
} else {
    echo "<p>Nenhum dado encontrado.</p>";
}

echo "</body></html>";

$html = ob_get_clean();
file_put_contents('index.html', $html);

echo "Arquivo HTML gerado com sucesso!";
?>
