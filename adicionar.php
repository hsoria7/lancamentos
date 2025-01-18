<?php
// Inclui a conexão
require_once 'conexao.php';

// Captura os dados enviados pelo formulário
$nome_live = $_POST['nome_live'] ?? null;
$foguete = $_POST['foguete'] ?? null;
$data = $_POST['data'] ?? null;
$partiu = $_POST['partiu'] ?? null; // Sim ou Não
$scrub = $_POST['scrub'] ?? null;  // Sim ou Não
$explodiu = $_POST['explodiu'] ?? null; // Sim ou Não
$elon_musk = $_POST['elon_musk'] ?? null; // Sim ou Não
$outros = $_POST['outros'] ?? null; // Sim ou Não
$alcantara = $_POST['alcantara'] ?? null; // Sim ou Não

// Verifica se todos os campos obrigatórios foram preenchidos
if (!is_null($nome_live) && !is_null($foguete) && !is_null($data) && !is_null($partiu) && !is_null($scrub) && !is_null($explodiu) && !is_null($elon_musk) && !is_null($outros) && !is_null($alcantara)) {
    // Conecta ao banco e insere os dados
    $connection = getConexao();

    // Prepara a consulta SQL
    $stmt = $connection->prepare("INSERT INTO lancamentos (Nome_live, foguete, data, partiu, scrub, explodiu, Elon_musk, Outros, Alcantara) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die('Erro na preparação da consulta: ' . $connection->error);
    }

    // Altera os tipos para "sssssssss" (nove strings)
    $stmt->bind_param("sssssssss", $nome_live, $foguete, $data, $partiu, $scrub, $explodiu, $elon_musk, $outros, $alcantara);

    // Executa a consulta
    if ($stmt->execute()) {
        header('Location: index2.php'); // Redireciona para a página inicial
        exit;
    } else {
        echo "Erro ao adicionar dados: " . $stmt->error;
    }

    // Fecha a consulta e a conexão
    $stmt->close();
    $connection->close();
} else {
    echo "Por favor, preencha todos os campos obrigatórios!";
}
?>
