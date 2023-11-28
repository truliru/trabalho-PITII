<?php
session_start();

if(isset($_POST['submit'])) {
    $servername = "localhost"; // ou o endereço do seu servidor MySQL
    $username = "root"; // seu nome de usuário do MySQL
    $password = ""; // sua senha do MySQL
    $dbname = "cupcakestore"; // o nome do seu banco de dados

    // Conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Recupera os valores do formulário
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Query SQL para verificar as credenciais do usuário
    $sql = "SELECT id FROM cliente WHERE Usuario='$usuario' AND Senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuário autenticado
        $row = $result->fetch_assoc();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['id'] = $row['id'];

        // Adicionar ID do cliente à tabela pedido, se ainda não estiver presente
        $idCliente = $_SESSION['id'];
        $sqlCheckPedido = "SELECT Id_cliente FROM pedido WHERE Id_cliente = '$idCliente'";
        $resultCheckPedido = $conn->query($sqlCheckPedido);

        if ($resultCheckPedido->num_rows === 0) {
            $sqlInsertPedido = "INSERT INTO pedido (Id_cliente) VALUES ('$idCliente')";
            if ($conn->query($sqlInsertPedido) === TRUE) {
                // Pedido criado com sucesso
            } else {
                echo "Erro ao criar pedido: " . $conn->error;
            }
        }

        header('Location: index.php');
        exit();
    } else {
        // Credenciais inválidas
        echo "Credenciais inválidas!";
    }

    // Fecha a conexão
    $conn->close();
}
?>
