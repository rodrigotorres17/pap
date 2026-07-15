<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Perfil</title>
</head>
<body>

<h1>Perfil do Utilizador</h1>

<p>
Bem-vindo,
<strong>
<?php echo htmlspecialchars($_SESSION['utilizador']); ?>
</strong>
</p>

<a href="menuprimario.php">Voltar</a>

</body>
</html>