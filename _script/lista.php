<?php
include 'database.php';

$sql = "SELECT Cod_Peca, Nome_Peca, Fornecedor, Valor_Compra, Valor_Venda, Quantidade, Imagem FROM Pecas";
$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}
