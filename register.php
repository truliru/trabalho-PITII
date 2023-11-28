<?php 
    session_start();    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Cupcakes Store</title>
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/register.css">
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

    <main  class="container mb-3">
        <div class="d-flex centralize mt-3">
            <h1>Cupcakes Store</h1>
        </div>
        <div class="pl-3">
            <div class="mb-3">
                <h2>Cadastro</h2>
                <p>Digite seus dados abaixo para <br> concluir o cadastro.</p>
            </div>

            <div class="mt-3">
                <form id="login__form" name="loginform" class="form__style d-flex flex-col" action="processar_registro.php" method="POST">
                    <div class="d-flex flex-col">
                        <label for="nome">Nome:</label>
                        <input id="nome" name="nome" class="login__form--nome" type="text">
                        <span class="div--spacer"></span>
                    </div>
                    <div class="d-flex flex-col">
                        <label for="telefone">Telefone:</label>
                        <input id="telefone" name="telefone" class="login__form--telefone telefone-mask" type="tel">
                        <span class="div--spacer"></span>
                    </div>
                    <div class="d-flex flex-col">
                        <label for="email">Email:</label>
                        <input id="email" name="email" class="login__form--email" type="text">
                        <span class="div--spacer"></span>
                    </div>
                    <div class="d-flex" style="justify-content: space-between">
                        <div class="d-flex flex-col" style="width: 45%">
                            <label for="usuario">Usuario:</label>
                            <input id="user" name="usuario" class="login__form--user" type="text">
                            <span class="div--spacer"></span>
                        </div>
                        <div class="d-flex flex-col" style="width: 45%">
                            <label for="senha">Senha:</label>
                            <input id="password" name="senha" class="login__form--senha" type="password">
                            <span class="div--spacer"></span>
                        </div>
                    </div>
                    <div class="d-flex" style="justify-content: space-between">
                        <div class="d-flex flex-col" style="width: 70%">
                            <label for="rua">Rua:</label>
                            <input id="rua" name="rua" class="login__form--rua" type="text">
                            <span class="div--spacer"></span>
                        </div>
                        <div class="d-flex flex-col" style="width: 25%">
                            <label for="numero">Numero:</label>
                            <input id="numero" name="numero" class="login__form--numero" type="text">
                            <span class="div--spacer"></span>
                        </div>
                    </div>
                    <div class="d-flex" style="justify-content: space-between">
                        <div class="d-flex flex-col" style="width: 70%">
                            <label for="cidade">Cidade:</label>
                            <input id="cidade" name="cidade" class="login__form--cidade" type="text">
                            <span class="div--spacer"></span>
                        </div>
                        <div class="d-flex flex-col" style="width: 25%">
                            <label for="estado">Estado:</label>
                            <input id="estado" name="estado" class="login__form--estado" type="text">
                            <span class="div--spacer"></span>
                        </div>
                    </div>

                    
                    <button class="mt-3 button__style" type="submit" name="submit">Concluir</button>
                </form>
            </div>
            <div id="mensagem" class="login__form--result d-flex centralize">
                <!-- <p>Ops! Alguma informação está incorreta!</p> -->
            </div>
        </div>

    </main>

    <script>
    // Mask do campo Telefone
    const telefones = document.querySelectorAll('.telefone-mask');

    // Função para aplicar a máscara de telefone
    function aplicarMascaraTelefone(event) {
        let valor = event.target.value;

        // Remove todos os caracteres não numéricos
        valor = valor.replace(/\D/g, '');

        // Limita o número de caracteres a 11 (DDD + 8 dígitos)
        valor = valor.slice(0, 11);

        // Formata o número no formato de telefone sem espaços ou caracteres especiais
        if (valor.length > 2 && valor.length <= 6) {
            valor = `${valor.slice(0, 2)}${valor.slice(2)}`;
        } else if (valor.length > 6) {
            valor = `${valor.slice(0, 2)}${valor.slice(2, 6)}${valor.slice(6)}`;
        }

        // Define o valor formatado no campo de input
        event.target.value = valor;
    }

    // Adiciona um ouvinte de eventos para cada campo de telefone
    telefones.forEach(function(telefone) {
        telefone.addEventListener('input', aplicarMascaraTelefone);
    });
    </script>

</body>
</html>