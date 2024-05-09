<?php
include '_script/database.php';

$sql = "SELECT * FROM pecas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Peças</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Listagem de Peças</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['preco']; ?></td>
                        <td><?php echo $row['quantidade']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2023 Loja de Autopeças</p>
    </footer>
</body>
</html>