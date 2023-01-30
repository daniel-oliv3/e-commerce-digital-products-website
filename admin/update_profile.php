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
 
	$update_profile_nome = $conn->prepare("UPDATE `admins` SET nome = ? WHERE id = ?");
	$update_profile_nome->execute([$nome, $admin_id]);
 
	$senha_vazia = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
	$prev_senha = $_POST['prev_senha'];
	$antiga_senha = sha1($_POST['antiga_senha']);
	$antiga_senha = filter_var($antiga_senha, FILTER_SANITIZE_STRING);
	$nova_senha = sha1($_POST['nova_senha']);
	$nova_senha = filter_var($nova_senha, FILTER_SANITIZE_STRING);
	$confirmar_senha = sha1($_POST['confirmar_senha']);
	$confirmar_senha = filter_var($confirmar_senha, FILTER_SANITIZE_STRING);
 
	if($antiga_senha == $senha_vazia){
	   $message[] = 'Por favor digite a senha antiga!';
	}elseif($antiga_senha != $prev_senha){
	   $message[] = 'Senha antiga não correspondida!';
	}elseif($nova_senha != $confirmar_senha){
	   $message[] = 'Confirme a senha não correspondida!';
	}else{
	   if($nova_senha != $senha_vazia){
		  $update_admin_senha = $conn->prepare("UPDATE `admins` SET senha = ? WHERE id = ?");
		  $update_admin_senha->execute([$confirmar_senha, $admin_id]);
		  $message[] = 'Senha atualizada com sucesso!';
	   }else{
		  $message[] = 'Por favor digite uma nova senha!';
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
	<title>Atualização de Perfil</title>
	<link rel="stylesheet" href="../css/admin_style.css">
	<link rel="shortcut icon" href="img/favicon.ico"/>
	<!-- Font Awesome CDN Link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
<!-- ======= Seção do formulário de atualização de administrador =======  -->
<?php include '../components/admin_header.php'; ?>
<section class="form-container">
	<form action="" method="POST">
		<h3>Atualizar perfil</h3>		
		<input type="hidden" name="prev_senha" value="<?= $fetch_profile['senha']; ?>">
      	<input type="text" name="nome" value="<?= $fetch_profile['nome']; ?>" required placeholder="Digite seu email" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      	<input type="password" name="antiga_senha" placeholder="Digite sua senha antiga" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      	<input type="password" name="nova_senha" placeholder="Digite sua nova senha" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      	<input type="password" name="confirmar_senha" placeholder="Confirmar a nova senha" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      	<input type="submit" value="Atualizar agora" class="btn" name="submit">
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