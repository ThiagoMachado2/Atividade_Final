<?php
include 'database.php';

// Verifica se o código da peça foi enviado via POST
if (isset($_POST['cod_peca'])) {
    $cod_peca = $_POST['cod_peca'];

    // Consulta as informações da peça no banco de dados
    $query = "SELECT Nome_Peca, Valor_Venda FROM Pecas WHERE Cod_Peca = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cod_peca);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se a peça foi encontrada
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Retorna os dados da peça como um JSON
        echo json_encode(array(
            'nome_peca' => $row['Nome_Peca'],
            'valor_venda' => $row['Valor_Venda']
        ));
    } else {
        // Se a peça não for encontrada, retorna um JSON vazio
        echo json_encode(array());
    }
} else {
    // Se o código da peça não foi enviado, retorna um JSON vazio
    echo json_encode(array());
}
?>