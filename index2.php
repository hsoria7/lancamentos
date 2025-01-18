<?php
require_once 'conexao.php'; // Inclui a conexão ao banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preencher Lançamentos Space Today</title>
    <style>
        /* CSS para estilizar os campos de preenchimento */ 
        .campo-preenchimento {
            width: 100%; 
            padding: 8px; 
            margin: 10px 0; 
            box-sizing: border-box; 
            border: 1px solid #ccc; 
            border-radius: 4px;
        }

        .campo-container {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column; /* Rótulo acima do campo */
        }

        label {
            margin-bottom: 5px; /* Espaço entre rótulo e campo */
            font-weight: bold;
        }

        .radio-group {
            margin-bottom: 15px;
        }

        .botao-personalizado {
            background-color: green; /* Cor do fundo */
            color: white; /* Cor do texto */
            font-size: 15px; /* Tamanho do texto */
            padding: 8px 12px; /* Tamanho do botão */
            border: none; /* Remove a borda */
            border-radius: 8px; /* Arredondamento */
            cursor: pointer; /* Muda o cursor ao passar por cima */
        }

        .botao-personalizado:hover {
            background-color: darkgreen; /* Cor ao passar o mouse */
        }

        /* Estilo para a imagem do foguete */
        .imagem-foguete {
            position: absolute;
            top: 70px; /* Distância do topo */
            right: 50px; /* Distância da direita */
            width: 500px; /* Largura da imagem */
            height: auto; /* Mantém a proporção */
        }
    </style>
</head>
<body>
    
    <h1>Preencher Lançamentos Space Today</h1>

    <!-- Formulário para adicionar dados -->
    <form action="adicionar.php" method="post">
        <div class="campo-container">
            <label for="nome_live">Nome_live:</label>
            <input type="text" id="nome_live" name="nome_live" class="campo-preenchimento" style="width: 1000px;" required>
        </div>

        <div class="campo-container">
            <label for="foguete">Foguete:</label>
            <input type="text" id="foguete" name="foguete" class="campo-preenchimento" style="width: 1000px;" required>
        </div>

        <div class="campo-container">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" class="campo-preenchimento" style="width: 200px;" required>
        </div>

        <!-- Campo Partiu -->
        <div class="radio-group">
            <label>Partiu:</label>
            <input type="radio" id="partiu_sim" name="partiu" value="Sim" required>
            <label for="partiu_sim">Sim</label>
            <input type="radio" id="partiu_nao" name="partiu" value="Não" required>
            <label for="partiu_nao">Não</label>
        </div>

        <!-- Campo Scrub -->
        <div class="radio-group">
            <label>Scrub:</label>
            <input type="radio" id="scrub_sim" name="scrub" value="Sim" required>
            <label for="scrub_sim">Sim</label>
            <input type="radio" id="scrub_nao" name="scrub" value="Não" required>
            <label for="scrub_nao">Não</label>
        </div>

        <!-- Campo Explodiu -->
        <div class="radio-group">
            <label>Explodiu:</label>
            <input type="radio" id="explodiu_sim" name="explodiu" value="Sim" required>
            <label for="explodiu_sim">Sim</label>
            <input type="radio" id="explodiu_nao" name="explodiu" value="Não" required>
            <label for="explodiu_nao">Não</label>
        </div>

        <!-- Campo Elon Musk -->
         <div class="radio-group">
            <label>Elon Musk:</label>
            <input type="radio" id="elon_musk_sim" name="elon_musk" value="Sim" required>
            <label for="elon_musk_sim">Sim</label>
            <input type="radio" id="elon_musk_nao" name="elon_musk" value="Não" required>
            <label for="elon_musk_nao">Não</label>
        </div>

         <!-- Campo Outros -->
        <div class="radio-group">
            <label>Outros:</label>
            <input type="radio" id="outros_sim" name="outros" value="Sim" required>
            <label for="outros_sim">Sim</label>
            <input type="radio" id="outros_nao" name="outros" value="Não" required>
            <label for="outros_nao">Não</label>
        </div>
        
         <!-- Campo Alcântara -->
         <div class="radio-group">
            <label>Alcântara:</label>
            <input type="radio" id="alcantara_sim" name="alcantara" value="Sim" required>
            <label for="alcantara_sim">Sim</label>
            <input type="radio" id="alcantara_nao" name="alcantara" value="Não" required>
            <label for="alcantara_nao">Não</label>
        </div>

        
        <button type="submit" class="botao-personalizado">Adicionar</button>
    </form>

    <!-- Inclui o script que exibe os dados da tabela -->
    <?php include 'listar.php'; ?>
    
    <!-- Adiciona a imagem do foguete -->
    <!-- <img src="URL_DA_IMAGEM" alt="Imagem do foguete" class="imagem-foguete"> -->
</body>
</html>
