<?php
include '_script/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $sql = "INSERT INTO pecas (nome, preco, quantidade) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdd", $nome, $preco, $quantidade);
    $stmt->execute();

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Peça</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Cadastro de Peça</h1>
    </header>

    <main>
        <form action="cadastro-peca.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" required>

            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" required>

            <button type="submit">Cadastrar</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2023 Loja de Autopeças</p>
    </footer>
</body>
</html>