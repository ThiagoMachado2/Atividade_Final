<?php
include 'database.php';

// Query SQL para selecionar todas as peças da tabela Pecas
$sql = "SELECT Nome_Peca, Fornecedor, Valor_Compra, Valor_Venda, Quantidade, Imagem FROM Pecas";

// Executa a consulta
$result = $conn->query($sql);

?>