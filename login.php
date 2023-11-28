<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cupcakes Store</title>
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body></body>

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
            <div>
                <h2>Entrar</h2>
                <p>Olá! Bom ver você.</p>
            </div>

            <div>
                <form id="login__form" name="loginform" class="d-flex flex-col form__style" action="sessao-login.php" method="POST">
                    <label for="usuario">Usuário:</label>
                    <input id="user" name="usuario" class="login__form--user" type="text">
                    <span class="div--spacer"></span>
                    <label for="senha">Senha:</label>
                    <input id="password" name="senha" class="login__form--senha" type="password">
                    <span class="div--spacer"></span>
                    <button class="button__style" type="submit" name="submit">Entrar</button>
                </form>
            </div>
            <div id="mensagem" class="login__form--result d-flex centralize">
                <!-- <p>Ops! Alguma informação está incorreta!</p> -->
            </div>
        </div>

    </main>

    <footer>
        <div class="pl-1">
            <div>
                <a href="#"><p style="text-align: center;">Esqueceu sua senha?</p></a>
            </div>
            <div>
                <a href="register.php"><p style="text-align: center; color: var(--red);">Inscrever-se</p></a>
            </div>
        </div>
    </footer>

    

</body>
</html>