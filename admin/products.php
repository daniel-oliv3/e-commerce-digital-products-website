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

	$selecionar_produto = $conn->prepare("SELECT * FROM `products` WHERE nome = ?");
	$selecionar_produto->execute([$nome]);

	if($selecionar_produto->rowCount() > 0){
		$message[] = 'O nome do produto já existe';
	} else {		
		if($imagem_01_size > 2000000 OR $imagem_02_size > 2000000 OR $imagem_03_size > 2000000){
			$message[] = 'O tamanho da imagem é muito grande';
		} else {
			move_uploaded_file($imagem_01_tmp_name, $imagem_01_folder);
			move_uploaded_file($imagem_02_tmp_name, $imagem_02_folder);
			move_uploaded_file($imagem_03_tmp_name, $imagem_03_folder);
			$inserir_produto = $conn->prepare("INSERT INTO `products`(nome, detalhes, preco, imagem_01, imagem_02, imagem_03) VALUES(?,?,?,?,?,?)");
			$inserir_produto->execute([$nome, $detalhes, $preco, $imagem_01, $imagem_02, $imagem_03]);
			$message[] = 'Novo produto adicionado!';
		}
	}
}

if(isset($_GET['delete'])){
	$delete_id = $_GET['delete'];
	$delete_produto_imagem = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
	$delete_produto_imagem->execute([$delete_id]);
	$buscar_delete_imagem = $delete_produto_imagem->fetch(PDO::FETCH_ASSOC);
	unlink('../uploaded_img/' . $buscar_delete_imagem['imagem_01']);
	unlink('../uploaded_img/' . $buscar_delete_imagem['imagem_02']);
	unlink('../uploaded_img/' . $buscar_delete_imagem['imagem_03']);
	$delete_produto = $conn->prepare("DELETE FROM `products` WHERE id = ?");
	$delete_produto->execute([$delete_id]);
	$delete_carrinho = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
	$delete_carrinho->execute([$delete_id]);
	$delete_lista_de_desejo = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
	$delete_lista_de_desejo->execute([$delete_id]);
	header('location:products.php');
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


<!-- ======= Show products section ======= -->
<section class="show-products">
	<div class="box-container">
		<?php
			$mostrar_produtos = $conn->prepare("SELECT * FROM `products`");
			$mostrar_produtos->execute();
			if($mostrar_produtos->rowCount() > 0){
				while($buscar_produtos = $mostrar_produtos->fetch(PDO::FETCH_ASSOC)){
		?>
		<div class="box">
			<img src="../uploaded_img/<?= $buscar_produtos['imagem_01']; ?>">
			<div class="name"><?= $buscar_produtos['nome']?></div>
			<div class="detalhes"><?= $buscar_produtos['detalhes']?></div>
			<div class="preco">R$ <?= $buscar_produtos['preco']?></div>
			<div class="flex-btn">
				<a href="update_product.php?update=<?= $buscar_produtos['id']; ?>" class="option-btn">Atualizar</a>
				<a href="products.php?delete=<?= $buscar_produtos['id']; ?>" class="delete-btn" onclick="return confirm('Excluir este produto?'); ">Deletar</a>
			</div>
		</div>
		<?php
				} 
			}else {
				echo '<p class="empty">Nenhum produto adicionado ainda!</p>';
			}
		?>
	</div>
</section>





	<script src="../js/admin_script.js"></script>
</body>
</html>

<!--
    Autor: Daniel Oliveira
    Email: danieloliveira.webmaster@gmail.com
    Manaus/Amazonas
    31/01/2023
-->