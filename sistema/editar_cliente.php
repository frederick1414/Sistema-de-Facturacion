<?php 
	
	session_start();

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])  )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idcliente = $_POST['id'];
            $nit       = $_POST['nit'];
            $nombre    = $_POST['nombre'];
			$telefono  = $_POST['telefono'];
			$direccion = $_POST['direccion'];

            $result = 0;
            if (is_numeric($nit) and $nit != 0) {
                    

			$query = mysqli_query($conection,"SELECT * FROM cliente 
                                                        WHERE (nit = '$nit' AND idcliente != $idcliente )
                                                        ");      
            $result = mysqli_fetch_array($query);
            $contador = 0;
            $contador = $contador + $result;          
            }



			if($result > 0){
				$alert='<p class="msg_error">El nit ya existe, ingrese otro.</p>';
			}else{

                if ($nit=='') {
                    $nit = 0;
                }


					$sql_update = mysqli_query($conection,"UPDATE cliente
															SET nit = '$nit', nombre='$nombre',telefono='$telefono'
                                                            ,direccion= '$direccion' 
                                                            WHERE idcliente= $idcliente ");
				
				if($sql_update){
					$alert='<p class="msg_save">Cliente actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el cliente.</p>';
				}
			}
		}
	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_cliente.php');
		mysqli_close($conection);
	}
	$idcliente = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT *	FROM cliente WHERE idcliente= $idcliente and estado=1 ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_cliente.php');
	}else{
		
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idcliente  = $data['idcliente'];
			$nit        = $data['nit'];
			$nombre     = $data['nombre'];
			$telefono   = $data['telefono'];
			$direccion  = $data['direccion'];
			


		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	
    <link rel="stylesheet" href="css/style_regitro_usuario.css">
	<title>Actualizar cliente</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar cliente</h1>
			<hr>
            <?php  //este parte del codigo la hice para que no me apareca la laerta hasta que no se actualice el cliente  ?>
            <?php if (!empty($_POST)) {
                
             
            ?>

			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

               <?php }  ?>
                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?php echo $idcliente;?>">
                                        <label for="nit">NIT</label>
                                        <input type="number" name="nit" id="nit" placeholder="Numero de nit" value="<?php echo $nit;?>">                             
                                        <label for="text">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre;?>">
                                        <label for="telefono">Telefono</label>
                                        <input type="number" name="telefono" id="telefono " placeholder="Telefono" value="<?php echo $telefono;?>">
                                        <label for="direccion">Direccion</label>
                                        <input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $direccion;?>">
                                        <input type="submit" value="actualizar Cliente" class="btn_save">
                                    </form>		
                </div>

                
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>