<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
	header('location:admin_login.php');
}

if(isset($_POST['submit'])){
	$nome = $_POST['nome'];
	$nome = filter_var($nome, FILTER_SANITIZE_STRING);
	$senha = sha1($_POST['senha']);
	$senha = filter_var($senha, FILTER_SANITIZE_STRING);
	$csenha = sha1($_POST['csenha']);
	$csenha = filter_var($csenha, FILTER_SANITIZE_STRING);

	$select_admin = $conn->prepare("SELECT * FROM `admins` WHERE nome = ?");
	$select_admin->execute([$nome]);
	
	if($select_admin->rowCount() > 0){
		$message[] = 'Nome de usuário já existe!';
	}else {
		if($senha != $csenha){
			$message[] = 'As senhas não são iguais!';
		}else {
			$insert_admin = $conn->prepare("INSERT INTO `admins`(nome, senha) VALUES(?,?)");
			$insert_admin->execute([$nome, $csenha]);
			$message[] = 'Novo Administrador Registrado!';
		}
	}

}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
	<link rel="stylesheet" href="../css/admin_style.css">
	<link rel="shortcut icon" href="img/favicon.ico"/>
	<!-- Font Awesome CDN Link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
<!-- ======= register_admin.php ======= -->
<?php include '../components/admin_header.php' ?>

<!-- ======= Seção do formulário de registro de administrador =======  -->
<section class="form-container">
	<form action="" method="POST">
		<h3>Novo Registro</h3>
		<input type="text" name="nome" maxlength="25" required placeholder="Digite seu email" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
		<input type="password" name="senha" maxlength="25" required placeholder="Digite sua senha" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
		<input type="password" name="csenha" maxlength="25" required placeholder="Confirme sua senha" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
		<input type="submit" class="btn" name="submit" value="Registrar agora">
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