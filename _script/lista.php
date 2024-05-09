<?php
// Inclua o arquivo de conexão com o banco de dados
include 'database.php';

// Query SQL para selecionar todas as peças da tabela Pecas
$sql = "SELECT Nome_Peca, Fornecedor, Valor_Compra, Valor_Venda, Quantidade FROM Pecas";

// Executa a consulta
$result = $conn->query($sql);

?>