<?php
include '_script/lista.php';
include '_script/excluir.php';
?>
<span style="font-family: verdana, geneva, sans-serif;">
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8" />
    <title>Apex Auto Gear</title>
    <link rel="stylesheet" href="style/styles.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <!--  Box Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/carousel.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/excluir.js"></script>
  </head>

  <body>
    <div class="container">
      <nav>
        <ul>
          <li><a href="#" class="logo">
              <img src="img/logo2.webp" alt="">
              <span class="nav-item">ApexAutoGear</span>
            </a></li>
          <li><a href="index.php">
              <i class="fas fa-home"></i>
              <span class="nav-item">Home</span>
            </a></li>
          <li><a href="cadastro_pecas.php">
              <i class="fas fa-user"></i>
              <span class="nav-item">Cadastro</span>
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
          <h1>Listagem das Peças em Estoque</h1>
        </div>
        <section class="main-course">
          <h1></h1>
          <div class="course-box-list">
            <table>
              <thead>
                <tr>
                  <th>Imagem</th>
                  <th>Nome da Peça</th>
                  <th>Fornecedor</th>
                  <th>Valor de Compra</th>
                  <th>Valor de Venda</th>
                  <th>Quantidade</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img class='img-lista' src='" . $row["Imagem"] . "' alt='Imagem da peça'></td>";
                    echo "<td>" . $row["Nome_Peca"] . "</td>";
                    echo "<td>" . $row["Fornecedor"] . "</td>";
                    echo "<td>" . $row["Valor_Compra"] . "</td>";
                    echo "<td>" . $row["Valor_Venda"] . "</td>";
                    echo "<td>" . $row["Quantidade"] . "</td>";
                    echo "<td><button class='delete-btn' data-id='" . $row["Cod_Peca"] . "' style='color: #fff; background-color: #ff0000; border: none; padding: 8px 12px; border-radius: 4px;'><i class='fas fa-trash-alt'></i></button></td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='7'>Nenhum registro encontrado.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
    </div>
    <footer class="footer">
      <div class="footer__container bd-container">
        <h2 class="footer__title">Apex Auto Gear</h2>
        <p class="footer__description">Bem-vindo à Apex Auto Gear, sua fonte confiável para peças automotivas de qualidade. <br>Estamos comprometidos em fornecer as melhores soluções para todas as suas necessidades de veículos. Visite-nos hoje para encontrar as peças certas para o seu carro.</br> </p>

        <div class="footer__social">
          <a href="#" class="footer__link"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="footer__link"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="footer__link"><i class="bx bxl-twitter"></i></a>
        </div>
        <p class="footer__copy">&#169; 2024 Apex Auto Gear. All right reserved</p>
      </div>
    </footer>
  </body>

  </html>
  <?php
  $conn->close();
  ?>
</span>