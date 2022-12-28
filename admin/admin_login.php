<?php

include '../components/connect.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="../css/admin_style.css">
	<link rel="shortcut icon" href="img/favicon.ico"/>
	<!-- Font Awesome CDN Link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
<!-- ======= Seção do formulário de login do administrador =======  -->
<section class="form-container">
	<form action="" method="POST">
		<h3>Conecte-se agora</h3>
		<p>nome de usuário padrão = <span>admin</span> & senha = <span>111</span></p>
		<input type="text" name="nome" maxlength="25" required placeholder="Digite seu nome" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
		<input type="password" name="senha" maxlength="25" required placeholder="Digite sua senha" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
		<input type="submit" class="btn" name="submit" value="Conecte-se agora">
	</form>
</section>











	
	<script src="js/script.js"></script>
</body>
</html>

<!--
    Autor: Daniel Oliveira
    Email: danieloliveira.webmaster@gmail.com
    Manaus/Amazonas
    28/12/2022
-->