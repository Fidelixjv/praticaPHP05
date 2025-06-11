<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="divgeral">

    <div class="divform">
        <h1>Formulário</h1>
        <h2>Preencha os campos abaixo</h2>


      <form action="processo.php" method="post" enctype="multipart/form-data">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        
        <label for="imagem">Imagem de Perfil (JPG, PNG, JPEG, TIFF, GIF):</label>
        <input type="file" id="imagem" name="imagem" accept="image/*" required><br><br>

        <button type="submit" name="enviar" value="Enviar"> Enviar </button>

      </form>
    </div>

  </div>
</body>
</html>
