<?php include '_script/database.php';
?>
<span style="font-family: verdana, geneva, sans-serif;">
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8" />
    <title>Apex Auto Gear</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style/styles.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <!--  Box Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="C:\xampp\htdocs\Atividade_Final\js\alertavenda.js"></script>
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
            $sql2 = "SELECT * FROM Pecas";
            $result2 = $conn->query($sql2);

            // Verifica se há resultados
            if ($result2->num_rows > 0) {
              // Exibe os cards para cada peça
              while ($row2 = $result2->fetch_assoc()) {
                echo '<div class="card">';
                echo '<div class="card-image">';
                echo '<img src="'  . $row2["Imagem"] . '" alt="' . $row2["Nome_Peca"] . '" >';
                echo '</div>';
                echo '<h3>' . $row2["Nome_Peca"] . '</h3>';
                echo '<p>R$ ' . $row2["Valor_Venda"] . '</p>';
                echo '<button class="add-to-cart-btn" data-cod-peca="' . $row2["Cod_Peca"] . '" data-nome-peca="' . $row2["Nome_Peca"] . '" data-valor-venda="' . $row2["Valor_Venda"] . '">Adicionar ao Carrinho</button>';
                echo '</div>';
              }
            } else {
              echo "Nenhuma peça encontrada.";
            }

            ?>
          </div>
        </div>
        <section class="main-course">
          <h1>finalização da compra</h1>
          <div class="course-box">
            <form action="_script/venda.php" method="post" id="cart-form">
              <!-- Selecione a peça -->
              <label class="label-v" for="codigo_peca">Selecione a peça:</label>
              <select id="codigo_peca" name="codigo_peca[]" class="form-control">
                <option value="">Selecione...</option>
                <?php
                $sql = "SELECT Cod_Peca, Nome_Peca, Valor_Venda, Quantidade FROM Pecas";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Cod_Peca'] . "' data-valor='" . $row['Valor_Venda'] . "' data-quantidade='" . $row['Quantidade'] . "'>" . $row['Nome_Peca'] . " - R$ " . $row['Valor_Venda'] . "</option>";
                  }
                } else {
                  echo "<option value=''>Nenhuma peça encontrada</option>";
                }
                ?>
              </select>
              <label class="label-v" for="nome_peca">Nome da Peça:</label>
              <input class="input-v" type="text" id="nome_peca" name="nome_peca[]" readonly>
              <label class="label-v" for="valor_venda">Valor de Venda:</label>
              <input type="number" id="valor_venda" name="valor_venda[]" step="0.01" readonly>
              <label class="label-v" for="quantidade">Quantidade:</label>
              <input class="input-v" type="number" id="quantidade" name="quantidade[]">

              <!-- Contêiner para exibir os itens no carrinho -->
              <div id="cart-items">
                <!-- Os itens do carrinho serão adicionados aqui dinamicamente -->
              </div>
              <!-- Exibir o total da compra -->
              <div id="total-compra"></div>

              <div class="button-container">
                <!-- Botão Adicionar ao Carrinho -->
                <button class="btn-v" type="button" id="add-to-cart">Adicionar ao Carrinho</button>

                <!-- Botão Finalizar Compra -->
                <button class="btn-v" type="submit" id="finalizar-compra">Finalizar Compra</button>
              </div>
            </form>
        </section>
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