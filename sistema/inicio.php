<?php 

	//session_start();
	if (empty($_SESSION['active'])) {
			
		
		include "salir.php";
		// el codigo recomendado era este
		// header('location; ../');
		//pero no me funciono me daba error en el servidor
		//por eso agregue la pagina de salir la cual tiene dicha funcion.
	
	}



?>
	<header>
		<div class="header">
			
			<h1>Sistema</h1>
			<div class="optionsBar">
				<p>República Dominicana,<?php echo fechaC(); ?></p>
				<span>|</span>
				<span class="user"><?php echo  $_SESSION['user'].' -'.$_SESSION['rol'].' -'.$_SESSION['email'] ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
        
	<?php include"nav.php"; ?>

	</header>