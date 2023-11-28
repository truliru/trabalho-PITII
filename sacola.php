<?php 
    include 'banco.php'; 
    session_start();

    // Verifica se a sessão não está ativa
    if (!isset($_SESSION['usuario'])) {
        // Redireciona o usuário para a página de login
        header('Location: login.php');
        exit(); // Finaliza o script para evitar que o restante do código seja executado
    }

    $idCliente = $_SESSION['id'];

    // Consulta SQL para obter os detalhes do carrinho
    $stmt = $conn->prepare("SELECT nome_do_produto, Preco_unitario, Quantidade
                            FROM detalhes_pedido 
                            WHERE Id_pedido = ?");
    $stmt->bind_param("i", $idCliente); // "i" indica um valor inteiro
    
    $stmt->execute();
    $result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho | Cupcakes Store</title>
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/sacola.css">
</head>
<body>

    <header>
        <nav class="p-2 d-flex flex-row" style="justify-content: space-between; align-items: baseline;">
            <div class="navbar__mob-list d-flex">
                <input type="checkbox" id="checkbox-menu">
                <label for="checkbox-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="accordion__sidebar">
                        <div class="d-flex flex-col accordion__sidebar--itens">
                            <a href="./">Home</a>
                            <?php
                                if(isset($_SESSION['usuario'])){
                                    echo '<a href="logout.php">Logout</a>';
                                } else{
                                    echo '<a href="login.php">Login</a><a href="register.php">Cadastro</a>';
                                }
                            ?>
                        </div>
                    </div>
                </label>
            </div>
            <div>
                <a href="sacola.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.8em" fill="var(--red)" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64v48H160V112zm-48 48H48c-26.5 0-48 21.5-48 48V416c0 53 43 96 96 96H352c53 0 96-43 96-96V208c0-26.5-21.5-48-48-48H336V112C336 50.1 285.9 0 224 0S112 50.1 112 112v48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg>
                </a>
            </div>
        </nav>
    </header>

    <main  class="container">
        <div class="d-flex centralize mt-3">
            <h1>Cupcakes Store</h1>
        </div>
        <div class="pl-3">
            <div class="mb-3">
                <h2>Carrinho</h2>
                <p>Confira os itens selecionados para finalizar a compra.</p>
            </div>

            <section>
                <div>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="product__card--cart">';
                                echo '<div class="cart__product--name">';
                                echo '<p>' . $row['nome_do_produto'] . '</p>';
                                echo '</div>';
                                echo '<div class="cart__count">';
                                echo '<p class="cart__count--minum">-</p>';
                                echo '<p class="cart__count--price">' . $row['Quantidade'] . '</p>';
                                echo '<p class="cart__count--plus">+</p>';
                                echo '</div>';
                                echo '<p class="d-none">' . $row['Preco_unitario'] . ' un =</p>'; 
                                echo '<p class="total-product-price">' . ($row['Preco_unitario'] * $row['Quantidade']) . '</p>'; 
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Nenhum item no carrinho.</p>';
                        }
                    ?>
                </div>
            </section>

            <div>
                <p>Preço total: <span class="product__card--totalPrice"></span></p>
            </div>

            <div class="d-flex centralize">
                <a href="pagamento.php" class="mt-3 button__style" style="text-align: center;">Finalizar compra</a>
            </div>
            
            <div id="mensagem" class="login__form--result d-flex centralize">
                <!-- <p>Ops! Alguma informação está incorreta!</p> -->
            </div>
        </div>

    </main>

<?php
    $stmt->close();
    $conn->close();
?>

</body>
<script src="./assets/js/quantidades-cart.js"></script>

</html>