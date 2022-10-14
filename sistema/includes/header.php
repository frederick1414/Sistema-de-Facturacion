


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
	<?php include"nav.php"; ?>

	</header> 










