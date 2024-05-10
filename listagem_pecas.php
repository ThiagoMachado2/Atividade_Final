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
    <script src="js/carousel.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/ajax.js"></script>
  </head>
  <body>
    <div class="container">
      <nav>
        <ul>
          <li><a href="#" class="logo">
              <img src="imagens/logo2.webp" alt="">
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
        <div class="main-skills">
          <div class="carousel">
            <div class="card">
              <img src="caminho_da_sua_imagem.jpg" alt="Imagem do Produto">
              <h3>Nome do Produto</h3>
              <p>R$ 10,00</p>
            </div>
            <div class="card">
              <img src="caminho_da_sua_imagem.jpg" alt="Imagem do Produto">
              <h3>Nome do Produto</h3>
              <p>R$ 10,00</p>
            </div>
            <div class="card">
              <img src="caminho_da_sua_imagem.jpg" alt="Imagem do Produto">
              <h3>Nome do Produto</h3>
              <p>R$ 10,00</p>
            </div>
            <div class="card">
              <img src="caminho_da_sua_imagem.jpg" alt="Imagem do Produto">
              <h3>Nome do Produto</h3>
              <p>R$ 10,00</p>
            </div>
            <div class="card">
              <img src="caminho_da_sua_imagem.jpg" alt="Imagem do Produto">
              <h3>Nome do Produto</h3>
              <p>R$ 10,00</p>
            </div>
            <button class="prev">Anterior</button>
            <button class="next">Próximo</button>
          </div>
        </div>
        <script>
          $(document).ready(function() {
            $('.carousel').slick({
              slidesToShow: 3, // Quantidade de cards visíveis de uma vez
              slidesToScroll: 1, // Quantidade de cards a rolar
              prevArrow: $('.prev'), // Botão de navegação para anterior
              nextArrow: $('.next'), // Botão de navegação para próximo
              responsive: [{
                breakpoint: 768, // Breakpoint para telas menores
                settings: {
                  slidesToShow: 1 // Reduzir a quantidade de cards visíveis em telas menores
                }
              }]
            });
          });
        </script>
        <section class="main-course">
          <h1>Listagem das Peças em Estoque</h1>
          <div class="course-box">
            <table>
              <thead>
                <tr>
                  <th>Nome da Peça</th>
                  <th>Fornecedor</th>
                  <th>Valor de Compra</th>
                  <th>Valor de Venda</th>
                  <th>Quantidade</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Verifica se há linhas retornadas pela consulta
                if ($result && $result->num_rows > 0) {
                  // Loop através das linhas retornadas
                  while ($row = $result->fetch_assoc()) {
                    // Exibe os dados da peça em cada linha da tabela
                    echo "<tr>";
                    echo "<td>" . $row["Nome_Peca"] . "</td>";
                    echo "<td>" . $row["Fornecedor"] . "</td>";
                    echo "<td>" . $row["Valor_Compra"] . "</td>";
                    echo "<td>" . $row["Valor_Venda"] . "</td>";
                    echo "<td>" . $row["Quantidade"] . "</td>";
                    echo "</tr>";
                  }
                } else {
                  // Se não houver linhas retornadas
                  echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
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