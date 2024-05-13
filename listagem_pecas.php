<?php
include '_script/lista.php';
?>
<span style="font-family: verdana, geneva, sans-serif;">
  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Dashboard | By Code Info</title>
    <link rel="stylesheet" href="style/styles.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.1.2/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/carousel.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/calendario.js"></script>
  </head>
  <body>
    <div class="container">
      <nav>
        <ul>
          <li><a href="#" class="logo">
              <img src="img/logo2.webp" alt="">
              <span class="nav-item">AutoPeças</span>
            </a></li>
          <li><a href="index.php">
              <i class="fas fa-home"></i>
              <span class="nav-item">Home</span>
            </a></li>
          <li><a href="cadastro_pecas.php">
              <i class="fas fa-user"></i>
              <span class="nav-item">Cadastrar Peças</span>
            </a></li>
          <li><a href="listagem_pecas.php">
              <i class="fas fa-list"></i>
              <span class="nav-item">Estoque</span>
            </a></li>
          <li><a href="calendario.php">
              <i class="fas fa-calendar"></i>
              <span class="nav-item">Calendario</span>
            </a></li>
        </ul>
      </nav>
      <section class="main">
        <div class="main-top">
          <h1>Produtos</h1>
          <i class="fas fa-user-cog"></i>
        </div>
        <section class="main-course">
          <h1>Listagem das Peças em Estoque</h1>
          <div class="course-box">
            <table>
              <thead>
                <tr>
                  <th>Imagem</th> <!-- Nova coluna para a imagem -->
                  <th>Nome da Peça</th>
                  <th>Fornecedor</th>
                  <th>Valor de Compra</th>
                  <th>Valor de Venda</th>
                  <th>Quantidade</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Verificar se há linhas retornadas pela consulta
                if ($result && $result->num_rows > 0) {
                  // Loop através das linhas retornadas
                  while ($row = $result->fetch_assoc()) {
                    // Exibir os dados da peça em cada linha da tabela
                    echo "<tr>";
                    // Exibir a imagem na primeira coluna
                    echo "<td><img class='img-lista' src='" . $row["Imagem"] . "' alt='Imagem da peça'></td>";
                    echo "<td>" . $row["Nome_Peca"] . "</td>";
                    echo "<td>" . $row["Fornecedor"] . "</td>";
                    echo "<td>" . $row["Valor_Compra"] . "</td>";
                    echo "<td>" . $row["Valor_Venda"] . "</td>";
                    echo "<td>" . $row["Quantidade"] . "</td>";
                    echo "</tr>";
                  }
                } else {
                  // Se não houver linhas retornadas
                  echo "<tr><td colspan='6'>Nenhum registro encontrado.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </section>
    </div>
  </body>
  </html>
  <?php
  // Fecha a conexão com o banco de dados
  $conn->close();
  ?>
  </html>
</span>