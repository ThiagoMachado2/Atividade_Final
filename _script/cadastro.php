<html>
<body>
<?php
include 'database.php';
// Definir o fuso horário para São Paulo
date_default_timezone_set('America/Sao_Paulo');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepara os dados para inserção
    $nome = $_POST["nome"];
    $fornecedor = $_POST["fornecedor"];
    $valor_compra = $_POST["valor_compra"];
    $valor_venda = $_POST["valor_venda"];
    $quantidade = $_POST["quantidade"];

    // Verifica se uma imagem foi enviada e a move para o diretório de imagens
    $imagem_path = '';
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
        // Define o caminho completo para o diretório de imagens
        $directory = __DIR__ . '/../imagens';

        // Constrói o caminho para salvar a imagem com o nome original do arquivo
        $imagem_nome = $_FILES["imagem"]["name"];
        $imagem_path = 'imagens/' . $imagem_nome;

        // Move o arquivo para o diretório de imagens
        if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], $directory . '/' . $imagem_nome)) {
            echo "Erro ao mover a imagem para o diretório.";
            exit();
        }
    } else {
        echo "Erro: Nenhuma imagem foi enviada ou ocorreu um erro durante o upload.";
        exit();
    }

    // Verifica se já existe uma peça com o mesmo nome e fornecedor no banco de dados
    $sql_check = "SELECT * FROM Pecas WHERE Nome_Peca = ? AND Fornecedor = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $nome, $fornecedor);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Se já existir, permitir atualizar os valores de compra, venda e quantidade
        $row = $result_check->fetch_assoc();
        $cod_peca = $row['Cod_Peca'];
        $quantidade_total = $row['Quantidade'] + $quantidade; // Nova quantidade total

        // Query SQL para atualizar os valores de compra, venda e quantidade
        $sql_update = "UPDATE Pecas SET Valor_Compra = ?, Valor_Venda = ?, Quantidade = ? WHERE Cod_Peca = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ddii", $valor_compra, $valor_venda, $quantidade_total, $cod_peca);
        if ($stmt_update->execute()) {
            echo "Valores de compra, venda e quantidade atualizados com sucesso para a peça existente.";

            // Inserir evento de atualização na tabela Events
            $title = "$nome foi atualizado";
            $start = date("Y-m-d H:i:s"); // Utilize a data atual como data de início
            $end = date("Y-m-d H:i:s"); // Utilize a data atual como data de término
            $color = "blue"; // Defina a cor para o evento de atualização
            $stmt_event = $conn->prepare("INSERT INTO Events (title, color, start, end) VALUES (?, ?, ?, ?)");
            $stmt_event->bind_param("ssss", $title, $color, $start, $end);
            $stmt_event->execute();

            // Redireciona após atualizar os valores
            header("Location: /Atividade_Final/cadastro_pecas.php");
            exit();
        } else {
            echo "Erro ao atualizar os valores de compra, venda e quantidade: " . $stmt_update->error;
        }
    } else {
        // Se não existir, insira uma nova peça
        $sql_insert = "INSERT INTO Pecas (Nome_Peca, Fornecedor, Valor_Compra, Valor_Venda, Quantidade, Imagem) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sssdds", $nome, $fornecedor, $valor_compra, $valor_venda, $quantidade, $imagem_path);
        if ($stmt_insert->execute()) {
            echo "Peça cadastrada com sucesso!";

            // Inserir evento de cadastro na tabela Events
            $title = "$nome foi cadastrado";
            $start = date("Y-m-d H:i:s"); // Utilize a data atual como data de início
            $end = date("Y-m-d H:i:s"); // Utilize a data atual como data de término
            $color = "blue"; // Defina a cor para o evento de cadastro
            $stmt_event = $conn->prepare("INSERT INTO Events (title, color, start, end) VALUES (?, ?, ?, ?)");
            $stmt_event->bind_param("ssss", $title, $color, $start, $end);
            $stmt_event->execute();

            // Redireciona após cadastrar a peça
            header("Location: /Atividade_Final/cadastro_pecas.php");
            exit();
        } else {
            echo "Erro ao cadastrar a peça: " . $stmt_insert->error;
        }
    }
    // Fecha a declaração e a conexão com o banco de dados
    $stmt_check->close();
    $stmt_insert->close();
    $stmt_update->close();
    $conn->close();
}
?>
</body>
</html>