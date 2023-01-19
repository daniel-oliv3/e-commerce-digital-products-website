<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
	header('location:admin_login.php');
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Atualização de Perfil</title>
	<link rel="stylesheet" href="../css/admin_style.css">
	<link rel="shortcut icon" href="img/favicon.ico"/>
	<!-- Font Awesome CDN Link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
<!-- ======= Seção do formulário de atualização de administrador =======  -->
<section class="form-container">
	<form action="" method="POST">
		<h3>Atualizar perfil</h3>
		<input type="text" name="nome" maxlength="25" required placeholder="Digite seu email" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
		<input type="password" name="senha" maxlength="25" required placeholder="Digite sua senha" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
		<input type="password" name="csenha" maxlength="25" required placeholder="Confirme sua senha" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
		<input type="submit" class="btn" name="submit" value="Atualizar agora">
	</form>
</section>


	<script src="../js/admin_script.js"></script>
</body>
</html>

<!--
    Autor: Daniel Oliveira
    Email: danieloliveira.webmaster@gmail.com
    Manaus/Amazonas
    14/01/2023
-->