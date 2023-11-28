<?php
session_start(); // Inicia a sessão

include 'banco.php';

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$nomeProduto = $_POST['nome'];
$precoUnitario = $_POST['preco'];

$idCliente = $_SESSION['id'];
$idPedido = $idCliente;

// Verificar se o produto já existe na tabela
$sqlCheckProduct = "SELECT * FROM detalhes_pedido WHERE Id_pedido = '$idPedido' AND nome_do_produto = '$nomeProduto'";
$resultCheckProduct = $conn->query($sqlCheckProduct);

if ($resultCheckProduct->num_rows > 0) {
    // O produto já existe na tabela, então atualiza a quantidade
    $sqlUpdateQuantity = "UPDATE detalhes_pedido SET Quantidade = Quantidade + 1 WHERE Id_pedido = '$idPedido' AND nome_do_produto = '$nomeProduto'";
    if ($conn->query($sqlUpdateQuantity) === TRUE) {
        echo "Quantidade do item incrementada.";
    } else {
        echo "Erro ao incrementar a quantidade do item: " . $conn->error;
    }
} else {
    // O produto não está na tabela, então insere um novo registro
    $sqlInsertProduct = "INSERT INTO detalhes_pedido (Id_pedido, nome_do_produto, Preco_unitario, Quantidade) VALUES ('$idPedido', '$nomeProduto', '$precoUnitario', 1)";
    if ($conn->query($sqlInsertProduct) === TRUE) {
        echo "Item adicionado com sucesso ao carrinho.";
    } else {
        echo "Erro ao adicionar item: " . $conn->error;
    }
}

$conn->close();
?>