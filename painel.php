<?php
require_once "functions.php";
require_once "config.php";
protect_acess();

// Inicializa variáveis
$nome = "";
$endereco = "";
$telefone = "";
$bairro = "";
$readonly = false; // Permite edição inicialmente

// Verifica se o botão de reset foi pressionado
if (isset($_POST["reset_dados"])) {
    $sql_reset = "DELETE FROM cliente ORDER BY id DESC LIMIT 1"; 
    $mysqli->query($sql_reset);
    $readonly = false; // Habilita edição novamente
}

// Buscar se já existe um registro no banco
$sql_ultimo = "SELECT * FROM cliente ORDER BY id DESC LIMIT 1";
$result = $mysqli->query($sql_ultimo);

if ($result->num_rows > 0) {
    $dados = $result->fetch_assoc();
    $nome = $dados["nome"];
    $endereco = $dados["endereco"];
    $telefone = $dados["telefone"];
    $bairro = $dados["bairro"];
    $readonly = true; // Bloqueia edição após o primeiro envio
}

// Se o formulário for enviado e os campos ainda não estiverem bloqueados
if (!$readonly && isset($_POST["botao_ativado"])) {
    if (isset($_POST["nome"]) && isset($_POST["endereco"]) && isset($_POST["telefone"]) && isset($_POST["bairro"])) {
        $nome = $mysqli->real_escape_string($_POST["nome"]);
        $endereco = $mysqli->real_escape_string($_POST["endereco"]);
        $telefone = $mysqli->real_escape_string($_POST["telefone"]);
        $bairro = $mysqli->real_escape_string($_POST["bairro"]);

        $sql_cadastra_usuario = "INSERT INTO `cliente`(`nome`, `endereco`, `telefone`, `bairro`) VALUES ('$nome','$endereco','$telefone','$bairro')";
        $mysqli->query($sql_cadastra_usuario);

        // Após salvar, recarregar os dados e bloquear edição
        $readonly = true;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
</head>
<body>

    <!-- FORMULARIO DO CLIENTE -->
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" <?php echo $readonly ? 'readonly' : ''; ?> required><br><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($endereco); ?>" <?php echo $readonly ? 'readonly' : ''; ?> required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" <?php echo $readonly ? 'readonly' : ''; ?> required><br><br>

        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" value="<?php echo htmlspecialchars($bairro); ?>" <?php echo $readonly ? 'readonly' : ''; ?> required><br><br>

        <?php if (!$readonly): ?>
            <button type="submit" name="botao_ativado">Enviar</button>
        <?php endif; ?>

        <?php if ($readonly): ?>
            <button type="submit" name="reset_dados">Resetar Dados</button>
        <?php endif; ?>
    </form>


    <!-- FORMULARIO DA PIZZA -->
    

    
    <a href="logout.php">Logout</a>
</body>
</html>
