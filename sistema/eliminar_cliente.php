<?php 



    session_start();
    if ($_SESSION['rol'] !=1 and $_SESSION['rol'] !=2) {
        header("location: ./");
    }
	include "../conexion.php";

	if (!empty($_POST)) {

        if (empty($_POST['idcliente'])) {
            header("location: lista_cliente.php");
            mysqli_close($conection);
        }

		$idcliente = $_POST['idcliente'];

		// Eliminar usuarios $query_delete =mysqli_query($conection, "DELETE FROM usuario where idusuario = $idusuario");
		$query_delete = mysqli_query($conection, "UPDATE cliente SET estado = 0 where idcliente= $idcliente");
		mysqli_close($conection);
		if ($query_delete) {
			header("location: lista_cliente.php");
            
		}else {
			echo "Error al eliminar";
		}

	}

	if (empty($_REQUEST['id'])) { //si coloco el rol enn lugar del ID tendra mas seguridad a la hora de eliminar
		header("location: lista_cliente.php");
		mysqli_close($conection);
	}else {
        $idcliente= $_REQUEST['id'];
        

		$query = mysqli_query($conection,"SELECT * FROM cliente WHERE idcliente = $idcliente");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if ($result > 0) {
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nit = $data['nit'];
				$nombre = $data['nombre'];

			}
		}else {
			header("location: lista_cliente.php");
		}
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include"includes/scripts.php"; ?>

	
	
	<link rel="stylesheet" href="css/style_eliminarr_usuario.css">
	<title>Eliminar cliente</title>

</head>
<body>

	<?php include"includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<i class="fas fa-user-times fa-7x   " style="color: #e66262"></i> <br> <br>
			<h2>Esta seguro de eliminar el siguiente registro?</h2>
			<p> Nombre del cliente:<span><?php echo $nombre;  ?></span></p>
			<p>Nit :<span><?php echo $nit;  ?></span></p>
			
		

			<form method="post" action="">
				<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
				<a href="lista_cliente.php" class="btn_cancel"> <i class="fas fa-ban"></i>  Cancelar </a>
				<button type="submit"   class="btn_ok"><i class="far fa-trash-alt"></i>  Eliminar</button>
			</form>
		</div>
	</section>

	
	<?php include"includes/footer.php"; ?>
</body>
</html>