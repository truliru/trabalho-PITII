<?php
session_start();

// Remove todas as variáveis de sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login ou qualquer outra página desejada após o logout
header("Location: login.php");
exit();
?>