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
	<title>Produtos</title>
	<link rel="stylesheet" href="../css/admin_style.css">
	<link rel="shortcut icon" href="img/favicon.ico"/>
	<!-- Font Awesome CDN Link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
<!-- ======= Products Section ======= -->
<?php include '../components/admin_header.php' ?>

<section class="add-products">
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="flex">
			<div class="inputBox">
				<span>Nome do produto (obrigatório)</span>
				<input type="text" required placeholder="Digite o nome do produto" name="nome" maxlength="100" class="box">
			</div>
			<div class="inputBox">
				<span>Preço do produto (obrigatório)</span>
				<input type="number" min="0" max="9999999999" required placeholder="Digite o preço do produto" name="preco" onkeypress="if(this.value.length == 10) return false;" class="box">
			</div>
			<div class="inputBox">
				<span>Imagem 01 (obrigatório)</span>
				<input type="file" name="imagem_01" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
			</div>
			<div class="inputBox">
				<span>Imagem 02 (obrigatório)</span>
				<input type="file" name="imagem_02" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
			</div>
			<div class="inputBox">
				<span>Imagem 03 (obrigatório)</span>
				<input type="file" name="imagem_03" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
			</div>
			<div class="inputBox">
				<span>Detalhes do produto</span>
				<textarea name="detalhes" class="box" cols="30" rows="10" required></textarea>
			</div>
		</div>
	</form>
</section>














	<script src="../js/admin_script.js"></script>
</body>
</html>

<!--
    Autor: Daniel Oliveira
    Email: danieloliveira.webmaster@gmail.com
    Manaus/Amazonas
    30/01/2023
-->