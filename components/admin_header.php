<header class="header">
	<section class="flex">
		<a href="dashboard.php" class="logo">Administrador<span>Painel</span></a>
		<nav class="navbar">
			<a href="dashboard.php">Inicio</a>
			<a href="products.php">Produtos</a>
			<a href="placed_orders.php">Pedidos feitos</a>
			<a href="admin_accounts.php">Contas de administrador</a>
			<a href="user_accounts.php">Contas de usuário</a>
			<a href="messages.php">Mensagens</a>
		</nav>
		<div class="icons">
			<div id="menu-btn" class="fas fa-bars"></div>
			<div id="user-btn" class="fas fa-bars"></div>
		</div>
		<div class="profile">
			<?php
			$select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
			$select_profile->execute([$admin_id]);
			$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);			
			?>
		</div>
	</section>
</header>

<!--
    Autor: Daniel Oliveira
    Email: danieloliveira.webmaster@gmail.com
    Manaus/Amazonas
    08/01/2023
-->