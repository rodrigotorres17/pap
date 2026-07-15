<?php
session_start();

if(
    !isset($_SESSION['tipo']) ||
    $_SESSION['tipo'] != 'admin'
){
    header("Location: menuprimario.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Painel Admin</title>
</head>
<body>

<h1>Painel de Administração</h1>

<ul>
    <li>Gerir Contas</li>
    <li>Adicionar Utilizadores</li>
    <li>Remover Utilizadores</li>
    <li>Editar Conteúdo do Site</li>
    <li>Gerir Notícias</li>
</ul>

<a href="menuprimario.php">Voltar</a>

</body>
</html>