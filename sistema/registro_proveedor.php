<?php
	
    session_start();

	if($_SESSION['rol'] == 3)
	{
		header("location: ./");
	}
    
    include "../conexion.php";

    if (!empty($_POST)) {

        $alert='';
        if( empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono'])  || empty($_POST['direccion'])) 
        {
            $alert='<p class="msg_error">Todos los campos son obligatorios .</p>';
        }else {
            $proveedor = $_POST['proveedor'];
            $contacto = $_POST['contacto'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $usuario_id =$_SESSION['idUser'];



                $query_insert = mysqli_query($conection,"INSERT INTO proveedor(proveedor,contacto,telefono,direccion, usuario_id)  
                                                                    VALUES('$proveedor','$contacto','$telefono','$direccion','$usuario_id')");

                if ($query_insert ) {
                    $alert ='<p class="msg_save">Proveedor guardado correctamente.</p>';
                }else {
                    $alert ='<p class="msg_error">Error al guardar el Proveedor.</p>';
                }
            
        }
        mysqli_close($conection);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

    
	<?php include "includes/scripts.php"; ?>
    
	<title>Registro proveedor</title>
    <link rel="stylesheet" href="css/style_regitro_usuario.css">
    
    <link rel="stylesheet" href="css/botones_crear.css">

</head>
<body>
    

                <?php include"includes/header.php"; ?>
                <section id="container">

                <div class="form_register" >
                    <h1>   <i class="fas fa-building"></i>  Registro proveedor</h1>
                    <hr>
                    <div class="alert" > <?php echo isset($alert) ? $alert: '';  ?></div>

                    <div class="card" style="width: 18rem;">

                            
                            <form action="" method="post">
                                <label for="proveedor"> Proveedor</label>
                                <input type="text" name="proveedor" id="proveedor" placeholder="Nombre del proveedor" >                             
                                <label for="text">Contacto</label>

                                <input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto" >
                                <label for="telefono">Telefono</label>
                                <input type="number" name="telefono" id="telefono " placeholder="Telefono">
                                <label for="direccion">Direccion</label>
                                <input type="text" name="direccion" id="direccion" placeholder="Direccion">
                                
                                <button type="submit" class="btn_save"><i class="far fa-save"></i> Guardar proveedor</button>
                            </form>
                    </div>
                
                </div>
                </section>

                
                <?php include"includes/footer.php"; ?>



    


    
</body>
</html>