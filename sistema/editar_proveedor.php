<?php 
    
    session_start();
    if ($_SESSION['rol'] ==3) {
        header("location: ./");
    }
    include "../conexion.php";


	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['proveedor']) || empty($_POST['contacto']) ||  empty($_POST['telefono']) || empty($_POST['direccion'])  )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idproveedor = $_POST['id'];
            $proveedor       = $_POST['proveedor'];
            $contacto    = $_POST['contacto'];
			$telefono  = $_POST['telefono'];
			$direccion = $_POST['direccion'];

      
      
      
      
      
      
      
      
      
      
                $sql_update = mysqli_query($conection,"UPDATE proveedor
															SET proveedor = '$proveedor', contacto='$contacto',telefono='$telefono'
                                                            ,direccion= '$direccion' 
                                                            WHERE codproveedor= $idproveedor ");
				
				if($sql_update){
					$alert='<p class="msg_save">Proveedor actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el Proveedor.</p>';
				}
			
		}
	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_proveedor.php');
		mysqli_close($conection);
	}
	$idproveedor = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT *	FROM proveedor WHERE codproveedor= $idproveedor  and estado =1");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_proveedor.php');
	}else{
		
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idproveedor  = $data['codproveedor'];
			$proveedor       = $data['proveedor'];
			$contacto     = $data['contacto'];
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
	<title>Actualizar proveedor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1> <i class="far fa-edit"></i> Actualizar proveedor</h1>
			<hr>
            <?php  //este parte del codigo la hice para que no me apareca la laerta hasta que no se actualice el cliente  ?>
            <?php if (!empty($_POST)) {
                
             
            ?>

			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

               <?php }  ?>
       
                            
               <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $idproveedor?>">
                                <label for="proveedor"> Proveedor</label>
                                <input type="text" name="proveedor" id="proveedor" placeholder="Nombre del proveedor" value="<?php  echo $proveedor?>" >                             
                                <label for="text">Contacto</label>

                                <input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto" value="<?php echo $contacto?>" >
                                <label for="telefono">Telefono</label>
                                <input type="number" name="telefono" id="telefono " placeholder="Telefono" value="<?php echo $telefono?>">
                                <label for="direccion">Direccion</label>
                                <input type="text" name="direccion" id="direccion" placeholder="Direccion"value="<?php echo $direccion?>" >
                                
                                <button type="submit" class="btn_save"><i class="far fa-edit"></i> Actualizar proveedor</button>
                            </form>
         </div>

                
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>