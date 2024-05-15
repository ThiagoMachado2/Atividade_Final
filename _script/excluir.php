<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Cod_Peca'])) {
        $cod_peca = intval($_POST['Cod_Peca']);

        if ($conn->connect_error) {
            echo "error: Connection failed: " . $conn->connect_error;
            exit();
        }

        // Começar uma transação
        $conn->begin_transaction();

        try {
            // Excluir registros da tabela `itens_venda` relacionados com `Cod_Peca`
            $sql_delete_itens_venda = "DELETE FROM Itens_Venda WHERE Cod_Peca = ?";
            $stmt_delete_itens_venda = $conn->prepare($sql_delete_itens_venda);
            $stmt_delete_itens_venda->bind_param("i", $cod_peca);
            $stmt_delete_itens_venda->execute();
            $stmt_delete_itens_venda->close();

            // Excluir o registro da tabela `Pecas`
            $sql_delete_pecas = "DELETE FROM Pecas WHERE Cod_Peca = ?";
            $stmt_delete_pecas = $conn->prepare($sql_delete_pecas);
            $stmt_delete_pecas->bind_param("i", $cod_peca);
            $stmt_delete_pecas->execute();
            $stmt_delete_pecas->close();

            // Confirmar a transação
            $conn->commit();
            echo "success";
        } catch (mysqli_sql_exception $exception) {
            $conn->rollback();
            echo "error: " . $exception->getMessage();
        }

        $conn->close();
    } else {
        echo "error: Cod_Peca not set";
    }
} else {

}
?>