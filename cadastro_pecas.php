<span style="font-family: verdana, geneva, sans-serif;">
  <!DOCTYPE html>

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
    <script src="js/carousel.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/ajax.js"></script>
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
          <h1>Produtos</h1>
        </div>
        <div class="main-skills">
          <div class="carousel">
            <?php
            include '_script/database.php';

            // Recupera todas as peças do banco de dados
            $sql = "SELECT * FROM Pecas";
            $result = $conn->query($sql);

            // Verifica se há resultados
            if ($result->num_rows > 0) {
              // Exibe os cards para cada peça
              while ($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<div class="card-image">'; // Adiciona a classe card-image aqui
                echo '<img src="'  . $row["Imagem"] . '" alt="' . $row["Nome_Peca"] . '" >';
                echo '</div>';
                echo '<h3>' . $row["Nome_Peca"] . '</h3>';
                echo '<p>R$ ' . $row["Valor_Venda"] . '</p>';
                echo '<button class="select-button" data-nome="' . $row["Nome_Peca"] . '" data-fornecedor="' . $row["Fornecedor"] . '" data-valor-compra="' . $row["Valor_Compra"] . '" data-valor-venda="' . $row["Valor_Venda"] . '" data-quantidade="' . $row["Quantidade"] . '">Selecionar</button>';
                echo '</div>';
              }
            } else {
              echo "Nenhuma peça encontrada.";
            }
            $conn->close();
            ?>
          </div>
        </div>
        <section class="main-course">
          <h1>Cadastro de Peças</h1>
          <div class="course-box-cad">
            <form action="_script/cadastro.php" method="post" enctype="multipart/form-data">
              <label for="nome">Nome da Peça:</label>
              <input type="text" id="nome" name="nome" required>

              <label for="fornecedor">Fornecedor:</label>
              <input type="text" id="fornecedor" name="fornecedor" required>

              <label for="valor_compra">Valor de Compra:</label>
              <input type="number" id="valor_compra" name="valor_compra" step="0.01" required>

              <label for="valor_venda">Valor de Venda:</label>
              <input type="number" id="valor_venda" name="valor_venda" step="0.01" required>

              <label for="quantidade">Quantidade:</label>
              <input type="number" id="quantidade" name="quantidade" required>

              <label for="imagem">Imagem da Peça:</label>
              <input type="file" id="imagem" name="imagem" accept="image/*" required>

              <button type="submit">Cadastrar</button>
            </form>
          </div>
        </section>
    </div>
    <footer class="footer">
      <div class="footer__container bd-container">
        <h2 class="footer__title">Apex Auto Gear</h2>
        <p class="footer__description">Bem-vindo à Apex Auto Gear, sua fonte confiável para peças automotivas de qualidade. <br>Estamos comprometidos em fornecer as melhores soluções para todas as suas necessidades de veículos. Visite-nos hoje para encontrar as peças certas para o seu carro.</br></p>
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
</span>