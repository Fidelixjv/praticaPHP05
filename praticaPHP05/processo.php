<?php

define("UPLOAD_DIR", "uploads/");
define("MAX_FILE_SIZE", 500000);
define("ALLOWED_EXTENSIONS", ["jpg", "jpeg", "png", "gif", "tiff"]);

if (isset($_POST["enviar"])) {
    $erros = [];

    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $senha = $_POST["senha"];

    if (empty($nome)) {
        $erros[] = "O campo nome é obrigatório.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O email fornecido é inválido.";
    }
    if (empty($senha)) {
        $erros[] = "A senha é obrigatória.";
    }

    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["imagem"]["tmp_name"];
        $fileName = $_FILES["imagem"]["name"];
        $fileSize = $_FILES["imagem"]["size"];
        $fileType = $_FILES["imagem"]["type"];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $novoNomeArquivo = uniqid('profile_', true) . '.' . $fileExtension;
        $destinoArquivo = UPLOAD_DIR . $novoNomeArquivo;

        $check = getimagesize($fileTmpPath);
        if ($check === false) {
            $erros[] = "Arquivo não é uma imagem válida.";
        }

        if ($fileSize > MAX_FILE_SIZE) {
            $erros[] = "Desculpe, seu arquivo é muito grande. O tamanho máximo permitido é " . (MAX_FILE_SIZE / 1000) . "KB.";
        }

        if (!in_array($fileExtension, ALLOWED_EXTENSIONS)) {
            $erros[] = "Desculpe, apenas arquivos JPG, JPEG, PNG, TIFF e GIF são permitidos.";
        }

    } else {
        $erros[] = "Nenhuma imagem foi enviada ou ocorreu um erro no upload.";
    }

    if (!empty($erros)) {
        echo "<h2>Erro no Cadastro:</h2>";
        echo "<ul>";
        foreach ($erros as $erro) {
            echo "<li>" . htmlspecialchars($erro) . "</li>";
        }
        echo "</ul>";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        if (move_uploaded_file($fileTmpPath, $destinoArquivo)) {
            echo "<h2>Cadastro Realizado com Sucesso!</h2>";
            echo "<p><strong>Nome:</strong> " . $nome . "</p>";
            echo "<p><strong>Email:</strong> " . $email . "</p>";
            echo "<p><strong>Imagem de Perfil:</strong></p>";
            echo "<img src='" . htmlspecialchars($destinoArquivo) . "' alt='Imagem de perfil' style='max-width: 200px; border-radius: 8px;'>";

        } else {
            echo "Desculpe, ocorreu um erro ao enviar seu arquivo. Por favor, tente novamente.<br>";
        }
    }
} else {
    echo "Acesso inválido. Por favor, envie o formulário.";
}

?>