<?php
include 'database.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepara os dados para inserção
    $nome = $_POST["nome"];
    $fornecedor = $_POST["fornecedor"];
    $valor_compra = $_POST["valor_compra"];
    $valor_venda = $_POST["valor_venda"];
    $quantidade = $_POST["quantidade"];

    // Verifique se uma imagem foi enviada e a move para o diretório de imagens
    $imagem_path = '';
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
        // Verifica se o diretório imagens existe, se não, cria-o
        $directory = __DIR__ . '/../imagens';
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // Constrói o caminho relativo para salvar a imagem
        $imagem_temp = $_FILES["imagem"]["tmp_name"];
        $imagem_nome = $_FILES["imagem"]["name"];
        $imagem_extensao = strtolower(pathinfo($imagem_nome, PATHINFO_EXTENSION));
        $imagem_path = 'imagens/' . uniqid('', true) . '.' . $imagem_extensao;

        // Move o arquivo para o diretório de imagens
        if (!move_uploaded_file($imagem_temp, $directory . '/' . basename($imagem_path))) {
            echo "Erro ao mover a imagem para o diretório.";
            exit();
        }

        // Mensagem de depuração para verificar o caminho da imagem
        echo "Imagem salva em: " . $imagem_path;
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
        // Se já existir, atualize a quantidade em estoque
        $row = $result_check->fetch_assoc();
        $cod_peca = $row['Cod_Peca'];
        $quantidade_total = $row['Quantidade'] + $quantidade;

        // Query SQL para atualizar a quantidade em estoque
        $sql_update = "UPDATE Pecas SET Quantidade = ? WHERE Cod_Peca = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $quantidade_total, $cod_peca);
        $stmt_update->execute();

        // Redireciona de volta para a página de cadastro de peças
        header("Location: cadastro_pecas.php");
        exit();
    } else {
        // Se não existir, insira uma nova peça
        $sql_insert = "INSERT INTO Pecas (Nome_Peca, Fornecedor, Valor_Compra, Valor_Venda, Quantidade, Imagem) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sssdds", $nome, $fornecedor, $valor_compra, $valor_venda, $quantidade, $imagem_path);
        if ($stmt_insert->execute()) {
            // Redireciona de volta para a página de cadastro de peças
            header("Location: cadastro_pecas.php");
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