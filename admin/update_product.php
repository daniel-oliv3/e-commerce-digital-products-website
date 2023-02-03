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
	<title>Novos Produtos</title>
	<link rel="stylesheet" href="../css/admin_style.css">
	<link rel="shortcut icon" href="img/favicon.ico"/>
	<!-- Font Awesome CDN Link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
<!-- ======= Update Products Section ======= -->
<?php include('../components/admin_header.php') ?>

<section class="update-product">
	<?php
		$update_id = $_GET['update'];
		$mostrar_produtos = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
		$mostrar_produtos->execute([$update_id]);
		if($mostrar_produtos->rowCount() > 0){
			while($buscar_produtos = $mostrar_produtos->fetch(PDO::FETCH_ASSOC)){
	?>
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="image-container">
			<div class="main-image">
				<img src="../uploaded_img/<?= $buscar_produtos['imagem_01']; ?>">
			</div>
		</div>
	</form>

	<?php
		} 
		}else {
			echo '<p class="empty">Nenhum produto adicionado ainda!</p>';
		}
	?>
</section>


	<script src="../js/admin_script.js"></script>
</body>
</html>

<!--
    Autor: Daniel Oliveira
    Email: danieloliveira.webmaster@gmail.com
    Manaus/Amazonas
    03/02/2023
-->