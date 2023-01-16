<?php 
if(isset($message)){
	foreach($message as $message){
		echo '
		<div class="message">
			<span>'. $message .'</span>
			<i class="fas fa-times" onclick="this.parentElement.remove();"></i>
		</div>
		';
	}
}
?>
<!-- ======= Header Section(dashboard) ======= -->
<header class="header">
	<section class="flex">
		<a href="dashboard.php" class="logo">Painel<span> Adm</span></a>
		<nav class="navbar">
			<a href="dashboard.php">Inicio</a>
			<a href="products.php">Produtos</a>
			<a href="placed_orders.php">Pedidos</a>
			<a href="admin_accounts.php">Administradores</a>
			<a href="users_accounts.php">Usuários</a>
			<a href="messages.php">Mensagens</a>
		</nav>
		<div class="icons">
			<div id="menu-btn" class="fas fa-bars"></div>
			<div id="user-btn" class="fas fa-user"></div>
		</div>
		<div class="profile">
			<?php
			$select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
			$select_profile->execute([$admin_id]);
			$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);			
			?>
			<p><?= $fetch_profile['nome']; ?></p>
			<a href="update_profile.php" class="btn">Atualizar perfil</a>
			<div class="flex-btn">
				<a href="admin_login.php" class="option-btn">Login</a>
				<a href="register_admin.php" class="option-btn">Registro</a>
			</div>
			<a href="../components/admin_logout.php" onclick="return confirm('Sair deste site?');" class="delete-btn">Sair</a>
		</div>
	</section>
</header>

<!--
    Autor: Daniel Oliveira
    Email: danieloliveira.webmaster@gmail.com
    Manaus/Amazonas
    08/01/2023
-->