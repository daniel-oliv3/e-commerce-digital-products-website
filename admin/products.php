<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
	header('location:admin_login.php');
}

if(isset($_POST['add_produto'])){

	$nome = $_POST['nome'];
	$nome = filter_var($nome, FILTER_SANITIZE_STRING);
	$preco = $_POST['preco'];
	$preco = filter_var($preco, FILTER_SANITIZE_STRING);
	$detalhes = $_POST['detalhes'];
	$detalhes = filter_var($detalhes, FILTER_SANITIZE_STRING);

	$imagem_01 = $_FILES['imagem_01']['name'];
	$imagem_01 = filter_var($imagem_01, FILTER_SANITIZE_STRING);
	$imagem_01_size = $_FILES['imagem_01']['size'];
	$imagem_01_tmp_name = $_FILES['imagem_01']['tmp_name'];
	$imagem_01_folder = '../uploaded_img/' .$imagem_01;

	$imagem_02 = $_FILES['imagem_02']['name'];
	$imagem_02 = filter_var($imagem_02, FILTER_SANITIZE_STRING);
	$imagem_02_size = $_FILES['imagem_02']['size'];
	$imagem_02_tmp_name = $_FILES['imagem_02']['tmp_name'];
	$imagem_02_folder = '../uploaded_img/' .$imagem_02;

	$imagem_03 = $_FILES['imagem_03']['name'];
	$imagem_03 = filter_var($imagem_03, FILTER_SANITIZE_STRING);
	$imagem_03_size = $_FILES['imagem_03']['size'];
	$imagem_03_tmp_name = $_FILES['imagem_03']['tmp_name'];
	$imagem_03_folder = '../uploaded_img/' .$imagem_03;
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
<!-- ======= Products ADD Section ======= -->
<?php include '../components/admin_header.php' ?>

<section class="add-products">

	<h1 class="heading">Adicionar produto</h1>

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
				<textarea name="detalhes" class="box" placeholder="Insira os detalhes do produto" cols="30" rows="10" required maxlength="500"></textarea>
			</div>
			<input type="submit" value="Adicionar produto" name="add_produto" class="btn">
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