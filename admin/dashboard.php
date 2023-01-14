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
	<title>Dashboard</title>
	<link rel="stylesheet" href="../css/admin_style.css">
	<link rel="shortcut icon" href="img/favicon.ico"/>
	<!-- Font Awesome CDN Link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
<!-- ======= dashboard.php ======= -->
<?php include '../components/admin_header.php' ?>

<!-- ======= Admin dashboard ======= -->
<section class="dashboard">
	<h1 class="heading">Dashboard</h1>
	<div class="box-container">
		<div class="box">
			<h3>Bem-vindo!</h3>
			<p><?= $fetch_profile['nome'] ?></p>
			<a href="update_profile.php" class="btn">Atualizar perfil</a>
		</div>
		<div class="box">
			<?php
				$total_pendings = 0;
				$select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
				$select_pendings->execute(['pending']);
				while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
				$total_pendings += $fetch_pendings['total_preco'];
				}
			?>
			<h3><span>R$ <?= $total_pendings; ?></span>/-</h3>
			<p>Total de pendências</p>
			<a href="placed_orders.php" class="btn">Ver pedidos</a>
		</div>
		<div class="box">
			<?php
				$total_completes = 0;
				$select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
				$select_completes->execute(['completes']);
				while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
				$total_completes += $fetch_completes['total_preco'];
				}
			?>
			<h3><span>R$ <?= $total_completes; ?></span>/-</h3>
			<p>Total de concluído</p>
			<a href="placed_orders.php" class="btn">Ver pedidos</a>
		</div>
		<div class="box">
			<?php
				$select_orders = $conn->prepare("SELECT * FROM `orders`");
				$select_orders->execute();
				$numbers_of_orders = $select_orders->rowCount();
			?>
			<h3><?= $numbers_of_orders; ?></h3>
			<p>Total de pedidos</p>
			<a href="placed_orders.php" class="btn">Ver pedidos</a>
		</div>
		<div class="box">
			<?php
				$select_products = $conn->prepare("SELECT * FROM `products`");
				$select_products->execute();
				$numbers_of_products = $select_products->rowCount();
			?>
			<h3><?= $numbers_of_products; ?></h3>
			<p>Produtos adicionados</p>
			<a href="products.php" class="btn">Ver produtos</a>
		</div>
		<div class="box">
			<?php
				$select_users = $conn->prepare("SELECT * FROM `users`");
				$select_users->execute();
				$numbers_of_users = $select_users->rowCount();
			?>
			<h3><?= $numbers_of_users; ?></h3>
			<p>Contas de usuários</p>
			<a href="users_accounts.php" class="btn">Ver contas</a>
		</div>
		<div class="box">
			<?php
				$select_admins = $conn->prepare("SELECT * FROM `admins`");
				$select_admins->execute();
				$numbers_of_admins = $select_admins->rowCount();
			?>
			<h3><?= $numbers_of_admins; ?></h3>
			<p>Administradores</p>
			<a href="admin_accounts.php" class="btn">Ver administradores</a>
		</div>
		<div class="box">
			<?php
				$select_messages = $conn->prepare("SELECT * FROM `messages`");
				$select_messages->execute();
				$numbers_of_messages = $select_messages->rowCount();
			?>
			<h3><?= $numbers_of_messages; ?></h3>
			<p>Novas mensagens</p>
			<a href="messages.php" class="btn">Ver mensagens</a>
		</div>
	</div>
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