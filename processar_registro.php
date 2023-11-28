<?php
// Verifica se o formulário foi submetido
if(isset($_POST['submit'])) {

    $servername = "localhost"; // ou o endereço do seu servidor MySQL
    $username = "root"; // seu nome de usuário do MySQL
    $password = ""; // sua senha do MySQL
    $dbname = "cupcakestore"; // o nome do seu banco de dados

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Preparação da query SQL utilizando prepared statements
    $sql = "INSERT INTO cliente (Nome, Telefone, Rua, Numero, Cidade, Estado, Email, Usuario, Senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da query foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da query: " . $conn->error);
    }

    // Vincula parâmetros e executa a query
    $stmt->bind_param("sssssssss", $_POST['nome'], $_POST['telefone'], $_POST['rua'], $_POST['numero'], $_POST['cidade'], $_POST['estado'], $_POST['email'], $_POST['usuario'], $_POST['senha']);
    if ($stmt->execute() === TRUE) {
        echo '<div style="display: flex; align-itens: center; justify-content: center; width: 100%"><p style: text align: center;">Registro efetuado com sucesso.</p></div>';
        echo '<script>function redirecionarPagina() {setTimeout(function() {window.location.href = "login.php";}, 2000);} redirecionarPagina();</script>';
    } else {
        echo "Erro ao inserir o registro: " . $conn->error;
    }

    // Fecha a conexão e a declaração
    $stmt->close();
    $conn->close();
}
?>