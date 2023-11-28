// alert para login

function checkSession(event) {
// Verifica se a sessão está ativa (o exemplo usa uma verificação simplificada)
if (!<?php echo isset($_SESSION['usuario']) ? 'true' : 'false'; ?>) {
    event.preventDefault(); // Impede o comportamento padrão do link
    alert('Você precisa efetuar o login'); // Exibe um alerta
}
}