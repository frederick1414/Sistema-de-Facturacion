<?php
	
    session_start();

	if($_SESSION['rol'] == 3)
	{
		header("location: ./");
	}
    
    include "../conexion.php";

    if (!empty($_POST)) {
        $alert='';
        if( empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio'])  || empty($_POST['cantidad'])) 
        {
            $alert='<p class="msg_error">Todos los campos son obligatorios .</p>';
        }else {
            $proveedor = $_POST['proveedor'];
            $producto = $_POST['producto'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $usuario_id =$_SESSION['idUser'];

            $foto =  $_FILES['foto'];
            $nombre_foto= $foto['name'];
            $type     = $foto['type'];
            $url_temp       = $foto['tmp_name'];
            
            $imgProducto = 'img_producto.png';

            if ($nombre_foto != '') {
                $destino = 'img/uploads';
                $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
                $imgProducto = $img_nombre.'.jpg';
                $src            =$destino.$imgProducto;
            }




                $query_insert = mysqli_query($conection,"INSERT INTO producto(proveedor,descripcion,precio,existencia, usuario_id,foto)  
                                                                    VALUES('$proveedor','$producto','$precio','$cantidad','$usuario_id','$imgProducto')");

                if ($query_insert ) {
                    if ($nombre_foto != '') {
                        move_uploaded_file($url_temp,$src);
                    }
                    $alert ='<p class="msg_save">Producto guardado correctamente.</p>';
                }else {
                    $alert ='<p class="msg_error">Error al guardar el Producto.</p>';
                }
            
        }
        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

    
	<?php include "includes/scripts.php"; ?>
    
	<title>Registro producto</title>
    <link rel="stylesheet" href="css/style_regitro_usuario.css">
    
    <link rel="stylesheet" href="css/botones_crear.css">
    
    <link rel="stylesheet" href="css/foto_producto.css">

</head>
<body>
    

                <?php include"includes/header.php"; ?>
                <section id="container">

                <div class="form_register" >
                    <h1>   <i class="fas fa-cubes"></i> Registro producto</h1>
                    <hr>
                    <div class="alert" > <?php echo isset($alert) ? $alert: '';  ?></div>

                    <div class="card" style="width: 18rem;">

                            
                            <form action="" method="post" enctype="multipart/form-data" >

                                <label for="proveedor"> Proveedor</label>
                         
                                    <?php
                                        $query_proveedor = mysqli_query($conection,"SELECT codproveedor, proveedor FROM proveedor WHERE estado=1 order by proveedor asc");
                                        $result_proveedor = $query_proveedor;
                                        mysqli_close($conection);
                                    ?>
                            
                                <select name="proveedor" id="proveedor">
                                    <?php 
                                        if ($result_proveedor > 0) {
                                            while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                                    
                                    ?>
                                    <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor'] ?></option>
                                
                                    <?php
                                            }
                                        }
                                    ?>       
                                </select>

                                <label for="text">Producto</label>

                                <input type="producto" name="producto" id="producto" placeholder="Nombre  del producto" >

                                <label for="precio">Precio</label>
                                <input type="number" name="precio" id="precio" placeholder="precio del producto">
                                
                                <label for="cantidad">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" placeholder="cantidad del producto">
                                

                                <div class="photo">
                                    <label for="foto">Foto</label>
                                        <div class="prevPhoto">
                                        <span class="delPhoto notBlock">X</span>
                                        <label for="foto"></label>
                                        </div>
                                        <div class="upimg">
                                        <input type="file" name="foto" id="foto">
                                        </div>
                                        <div id="form_alert"></div>
                                </div>



                                <button type="submit" class="btn_save"><i class="far fa-save"></i> Guardar producto</button>
                            </form>
                    </div>
                
                </div>
                </section>

                
                <?php include"includes/footer.php"; ?>



    


    
</body>
</html>