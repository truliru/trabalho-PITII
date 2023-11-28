<?php
session_start(); // Inicia a sessão

include 'banco.php'; // Inclua o arquivo de conexão com o banco de dados

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifique se o usuário está autenticado
if (!isset($_SESSION['id'])) {
    echo "Usuário não autenticado.";
    exit();
}

$nomeProduto = $_POST['nomeProduto'];
$operacao = $_POST['operacao']; // 'incrementar' ou 'decrementar'

$idCliente = $_SESSION['id'];
$idPedido = $idCliente;

// Verifique se o produto já está no carrinho
$stmt = $conn->prepare("SELECT Quantidade FROM detalhes_pedido WHERE Id_pedido = ? AND nome_do_produto = ?");
$stmt->bind_param("is", $idPedido, $nomeProduto); // "is" indica um inteiro e uma string

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $quantidadeAtual = $row['Quantidade'];

    // Incrementa ou decrementa a quantidade
    if ($operacao === 'incrementar') {
        $novaQuantidade = $quantidadeAtual + 1;
    } elseif ($operacao === 'decrementar' && $quantidadeAtual > 0) {
        $novaQuantidade = $quantidadeAtual - 1;
    } else {
        echo "Erro: Quantidade não pode ser menor que zero.";
        exit();
    }

    // Atualiza a quantidade no banco de dados
    $stmt = $conn->prepare("UPDATE detalhes_pedido SET Quantidade = ? WHERE Id_pedido = ? AND nome_do_produto = ?");
    $stmt->bind_param("iss", $novaQuantidade, $idPedido, $nomeProduto); // "iss" indica um inteiro, uma string e outra string

    if ($stmt->execute()) {
        echo "Quantidade atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar a quantidade: " . $conn->error;
    }
} else {
    echo "Erro: Produto não encontrado no carrinho.";
}

$stmt->close();
$conn->close();
?>
