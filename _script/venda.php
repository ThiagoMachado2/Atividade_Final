<?php
include 'database.php';

// Definir o fuso horário para São Paulo
date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cart_items'])) {
    $cart_items = json_decode($_POST['cart_items'], true);
    $data_venda = date("Y-m-d");

    $conn->begin_transaction();

    try {
        // Inserir a venda na tabela Vendas
        $total_venda = 0;
        foreach ($cart_items as $item) {
            $total_venda += $item['total'];
        }
        $stmt = $conn->prepare("INSERT INTO Vendas (Data_Venda, Total) VALUES (?, ?)");
        $stmt->bind_param("sd", $data_venda, $total_venda);
        $stmt->execute();
        $cod_venda = $stmt->insert_id;

        // Inserir os itens da venda na tabela Itens_Venda
        foreach ($cart_items as $item) {
            $stmt = $conn->prepare("INSERT INTO Itens_Venda (Cod_Venda, Cod_Peca, Nome_Peca, Valor_Venda, Quantidade, Total_Item) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisdsd", $cod_venda, $item['cod_peca'], $item['nome_peca'], $item['valor_venda'], $item['quantidade'], $item['total']);
            $stmt->execute();
        }

        $conn->commit();
        // Após a confirmação da venda, atualizar o estoque na tabela Pecas
        foreach ($cart_items as $item) {
            // Verificar se a chave 'cod_peca' está definida em $item
            if (isset($item['cod_peca'])) {
                $cod_peca = $item['cod_peca'];

                // Verificar se a chave 'quantidade' está definida em $item
                $quantidade_vendida = isset($item['quantidade']) ? $item['quantidade'] : 0;

                $stmt = $conn->prepare("UPDATE Pecas SET Quantidade = Quantidade - ? WHERE Cod_Peca = ?");
                $stmt->bind_param("ii", $quantidade_vendida, $cod_peca);
                if ($stmt->execute()) {
                    echo "Quantidade do item " . $cod_peca . " atualizada com sucesso!<br>";
                } else {
                    echo "Erro ao atualizar a quantidade do item " . $cod_peca . ": " . $conn->error . "<br>";
                }
            } else {
                // Se 'cod_peca' não estiver definida, exibir um erro e pular este item
                echo "Erro: chave 'cod_peca' não está definida no item.<br>";
                continue;
            }
        }

        echo "Venda concluída com sucesso!";
           // Inserir evento de venda na tabela Events
           $title = "Venda de " . $item['nome_peca'];
           $start = date("Y-m-d H:i:s"); // Utilize a data da venda como data de início
           $end = date("Y-m-d H:i:s"); // Utilize a data da venda como data de término
           $color = "green"; // Defina a cor para o evento de venda
           $stmt = $conn->prepare("INSERT INTO Events (title, color, start, end) VALUES (?, ?, ?, ?)");
           $stmt->bind_param("ssss", $title, $color, $start, $end);
           $stmt->execute();
           
       } catch (Exception $e) {
           $conn->rollback();
           echo "Erro ao processar a venda: " . $e->getMessage();
       }
   } else {
       echo "Nenhum item no carrinho.";
   }

?>