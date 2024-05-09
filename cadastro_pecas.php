<span style="font-family: verdana, geneva, sans-serif;">
  <!DOCTYPE html>

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
  </head>

  <body>
    <div class="container">
      <nav>
        <ul>
          <li><a href="#" class="logo">
              <img src="imagens/logo2.webp" alt="">
              <span class="nav-item">Autopeças</span>
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
          <li><a href="calandario.php">
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
          <h1>Cadastro de Peças</h1>
          <div class="course-box">
            <form action="_script/cadastro.php" method="post">
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

              <button type="submit">Cadastrar</button>
            </form>
          </div>
        </section>
    </div>
    </section>
    </section>
    </div>
  </body>

  </html>
</span>