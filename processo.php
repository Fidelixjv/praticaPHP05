<?php
if (isset($_POST["enviar"])) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $diretorioDestino = "uploads";
    $arquivoDestino   = $diretorioDestino . basename($_FILES["imagem"]["name"]);
    $uploadOk = 1;
    $tipoArquivo = strtolower(pathinfo($arquivoDestino, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["imagem"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Arquivo não é uma imagem.<br>";
        $uploadOk = 0;
    }

    if (file_exists($arquivoDestino)) {
        echo "Desculpe, o arquivo já existe.<br>";
        $uploadOk = 0;
    }

    if ($_FILES["imagem"]["size"] > 500000) {
        echo "Desculpe, seu arquivo é muito grande.<br>";
        $uploadOk = 0;
    }

    $extensoesPermitidas = ["jpg", "jpeg", "png", "gif", "tiff"];
    if (!in_array($tipoArquivo, $extensoesPermitidas)) {
        echo "Desculpe, apenas arquivos JPG, JPEG, PNG, TIFF e GIF são permitidos.<br>";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $arquivoDestino)) {
            echo "<h2>Cadastro Realizado com Sucesso!</h2>";
            echo "<p><strong>Nome:</strong> $nome</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Imagem de Perfil:</strong></p>";
            echo "<img src='$arquivoDestino' alt='Imagem de perfil' style='max-width: 200px; border-radius: 8px;'>";
        } else {
            echo "Desculpe, ocorreu um erro ao enviar seu arquivo.<br>";
        }
    } else {
        echo "O upload não foi realizado devido a erros.<br>";
    }
} else {
    echo "Acesso inválido.";
}
?>
