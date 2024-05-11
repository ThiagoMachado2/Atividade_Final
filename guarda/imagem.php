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