<?php 



    session_start();
    if ($_SESSION['rol'] !=1) {
        header("location: ./");
    }
	include "../conexion.php";

	if (!empty($_POST)) {


		if ($_POST['idusuario'] == 1) {
			header("location: lista_usuario.php");
			mysqli_close($conection);
			exit;
		}

		$idusuario = $_POST['idusuario'];

		// Eliminar usuarios $query_delete =mysqli_query($conection, "DELETE FROM usuario where idusuario = $idusuario");
		$query_delete = mysqli_query($conection, "UPDATE usuario SET estado = 0 where idusuario = $idusuario");
		mysqli_close($conection);
		if ($query_delete) {
			header("location: lista_usuario.php");
		}else {
			echo "Error al eliminar";
		}

	}

	if (empty($_REQUEST['id']) || $_REQUEST['id']==1) { //si coloco el rol enn lugar del ID tendra mas seguridad a la hora de eliminar
		header("location: lista_usuario.php");
		mysqli_close($conection);
	}else {
		include "../conexion.php";

		$idusuario = $_REQUEST['id'];
		
		$query = mysqli_query($conection,"SELECT U.nombre, u.usuario, r.rol
												FROM usuario u
												INNER JOIN
												rol r
												ON u.rol = r.idrol
												WHERE u.idusuario = $idusuario");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if ($result > 0) {
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nombre = $data['nombre'];
				$usuario = $data['usuario'];
				$rol = $data['rol'];

			}
		}else {
			header("location: lista_usuario.php");
		}
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include"includes/scripts.php"; ?>

	
	
	<link rel="stylesheet" href="css/style_eliminarr_usuario.css">
	<title>Eliminar Usuario</title>

</head>
<body>

	<?php include"includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
		<i class="fas fa-user-times fa-7x   " style="color: #e66262"></i> <br> <br>
			<h2>Esta seguro de eliminar el siguiente registro?</h2>
			<p>Nombre :<span><?php echo $nombre;  ?></span></p>
			<p> Usuario:<span><?php echo $usuario;  ?></span></p>
			<p>Tipo Usuario: <span><?php echo $rol;  ?></span></p>
		

			<form method="post" action="">
				<input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
				<a href="lista_usuario.php" class="btn_cancel"> <i class="fas fa-ban"></i>  Cancelar </a>
				<button type="submit"   class="btn_ok"><i class="far fa-trash-alt"></i>  Eliminar</button>
			</form>
		</div>
	</section>

	
	<?php include"includes/footer.php"; ?>
</body>
</html>