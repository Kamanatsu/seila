<?php
require_once "functions.php";
require_once "config.php";
protect_acess();

$valor_total = 0;

if(!isset($_SESSION['ultimo_id'])){
    $nome = "";
    $endereco = "";
    $telefone = "";
    $bairro = "";
}else{

    $id = $_SESSION['ultimo_id'];

    $reload = "SELECT * FROM cliente WHERE id = '$id'";
    $rename = $mysqli->query($reload);

    $cliente = $rename->fetch_assoc();
    
    $nome = $cliente['nome'];
    $endereco = $cliente['endereco'];
    $telefone = $cliente['telefone'];
    $bairro = $cliente['bairro'];
}

if (isset($_POST["botao_ativado"]) && isset($_POST["nome"]) && isset($_POST["endereco"]) && isset($_POST["telefone"]) && isset($_POST["bairro"])) {
    $nome = $mysqli->real_escape_string($_POST["nome"]);
    $endereco = $mysqli->real_escape_string($_POST["endereco"]);
    $telefone = $mysqli->real_escape_string($_POST["telefone"]);
    $bairro = $mysqli->real_escape_string($_POST["bairro"]);

    $sql_cadastra_usuario = "INSERT INTO `cliente`(`nome`, `endereco`, `telefone`, `bairro`) VALUES ('$nome','$endereco','$telefone','$bairro')";
    if($mysqli->query($sql_cadastra_usuario) === true){
        $ultimo_id = $mysqli->insert_id;
        $_SESSION["ultimo_id"] = $ultimo_id;
        echo "Último ID inserido: " . $_SESSION['ultimo_id'];

    }
}

if (isset($_POST["reset_dados"])){
    unset($_SESSION['ultimo_id']);
    $nome = "";
    $endereco = "";
    $telefone = "";
    $bairro = "";
    $valor_total = 0;
}

if (isset ($_POST["adicionar_pedido"])){
    $tamanho = $mysqli->real_escape_string($_POST["tamanho"]);
    $sabor = $mysqli->real_escape_string($_POST["sabor"]);
    $preco = ($tamanho == "Pequena") ? 25.00 :
    (($tamanho == "Média") ? 35.00 : 45.00);

    $valor_total = $valor_total + $preco;

    $quantidade = $mysqli->real_escape_string($_POST["quantidade"]);

    $id = $_SESSION['ultimo_id'];

    $sql_pedido = "INSERT INTO `pizza`(`id`, `quantidade`, `tamanho`, `sabor`, `preco`, `status`) 
    VALUES ('$id','$quantidade', '$tamanho', '$sabor', '$preco', 'Pendente')";
    $mysqli->query($sql_pedido);

    $sql = "SELECT * FROM pizza WHERE id = '$id'"; // Consulta à tabela pizza
    $result = $mysqli->query($sql); // Executa a consulta

    $reload = "SELECT * FROM cliente WHERE id = '$id'";
    $rename = $mysqli->query($reload);

    $cliente = $rename->fetch_assoc();
    
    $nome = $cliente['nome'];
    $endereco = $cliente['endereco'];
    $telefone = $cliente['telefone'];
    $bairro = $cliente['bairro'];
    
    // Armazenar os dados em um array para exibição na tabela
    $pizzas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pizzas[] = $row;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/painel.css">
    <title>Cadastro de Pedido</title>
</head>
<body>

    <div class="junção">
        <div class="form-geral">
            <!-- FORMULARIO DO CLIENTE -->
            <div>
                <form action="" method="POST">
                    <label for="nome">Dados do Cliente:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required><br><br>

                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($endereco); ?>" required><br><br>

                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" required><br><br>

                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" value="<?php echo htmlspecialchars($bairro); ?>" required><br><br>

                
                    <button type="submit" name="botao_ativado">Enviar</button>

                    
                    <button type="submit" name="reset_dados">Resetar Dados</button>
                </form>
            </div>

            <!-- FORMULARIO DA PIZZA -->
            <div>
                <form action="" method="POST">
                    <label for="tamanho">Tamanho da Pizza:</label>
                    <select id="tamanho" name="tamanho" required>
                        <option value="Pequena">Pequena</option>
                        <option value="Média">Média</option>
                        <option value="Grande">Grande</option>
                    </select><br><br>

                    <label for="quantidade">quantidade</label>
                    <input type="text" name="quantidade" min="1" required>

                    <label for="sabor">Sabor:</label>
                    <select id="sabor" name="sabor" required>
                        <option value="Calabresa">Calabresa</option>
                        <option value="Mussarela">Mussarela</option>
                        <option value="Portuguesa">Portuguesa</option>
                        <option value="Frango com Catupiry">Frango com Catupiry</option>
                        <option value="Quatro Queijos">Quatro Queijos</option>
                        <option value="Pepperoni">Pepperoni</option>
                        <option value="Marguerita">Marguerita</option>
                        <option value="Atum">Atum</option>
                        <option value="Bacon">Bacon</option>
                        <option value="Vegetariana">Vegetariana</option>
                    </select><br><br>

                    <button type="submit" name="adicionar_pedido">Adicionar ao Pedido</button>
                </form>
            </div>
        </div>

        <!-- Pedidos -->
        <div>
            <?php if (!empty($pizzas)): ?>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Quantidade</th>
                            <th>Tamanho</th>
                            <th>Sabor</th>
                            <th>Preço</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pizzas as $pizza): ?>
                            <tr>
                                <td><?php echo $pizza['quantidade']; ?></td>
                                <td><?php echo $pizza['tamanho']; ?></td>
                                <td><?php echo $pizza['sabor']; ?></td>
                                <td><?php echo $pizza['preco']; ?></td>
                                <td><?php echo $pizza['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td>Valor total</td>
                            <td></td>
                            <td></td>
                            <td><?php echo $valor_total; ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <?php endif; ?>
        </div>
    </div>
    <a href="logout.php">Logout</a>
</body>
</html>
