<?php
   // session_start();

?>
<!DOCTYPE html>
<html lang="en">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">   
    <script src="https://kit.fontawesome.com/737ba94987.js" crossorigin="anonymous"></script>


    <?php 


if (empty($_SESSION['active'])) {
        
    
    include "salir.php";
    // el codigo recomendado era este
    // header('location; ../');
    //pero no me funciono me daba error en el servidor
    //por eso agregue la pagina de salir la cual tiene dicha funcion.

}



?>
<header>


            <nav>


        <ul>
            <li><a href="./index.php"> <i class="fas fa-home"></i> Inicio</a></li>
        <?php 
            if ($_SESSION['rol'] ==1) { //solo tendran asceso a la lista y crear usuario los admin

            
        ?>
            <li class="principal">
                
                <a href="#"><i class="fas fa-users"></i> Usuarios</a>
                <ul>
                    <li><a href="registro_usuario.php" > <i class="fas fa-user-plus"></i> Nuevo Usuario</a></li>
                    <li><a href="lista_usuario.php"><i class="fas fa-list-alt"></i> Lista de Usuarios</a></li>
                </ul>
            </li>
            <?php } ?>
            <li class="principal">
                <a href="#"> <i class="fas fa-users"></i> Clientes</a>
                <ul>
                    <li><a href="registro_cliente.php">  <i class="fas fa-user-plus"></i> Nuevo Cliente</a></li>
                    <li><a href="lista_cliente.php"><i class="fas fa-list-alt"></i> Lista de Clientes</a></li>
                </ul>
            </li>
            <?php 
            if ($_SESSION['rol'] !=3) { //solo tendran asceso a la lista y crear usuario los admin

            
            ?>
            <li class="principal">
                <a href="#">  <i class="fas fa-building"></i>  Proveedores</a>
                <ul>
                    <li><a href="registro_proveedor.php"><i class="fas fa-plus"></i>  Nuevo Proveedor</a></li>
                    <li><a href="lista_proveedor.php"> <i class="fas fa-list-alt"></i> Lista de Proveedores</a></li>
                </ul>
            </li>
            <?php } ?>
            
            <li class="principal">
                <a href="#"><i class="fas fa-cubes"></i>  Productos</a>
                <ul>
                        
                    <?php 
                    if ($_SESSION['rol'] !=3) { //solo tendran asceso a la lista y crear usuario los admin

                    
                    ?>
                    <li><a href="registro_productoError.php">Nuevo Producto</a></li>
                    <?php } ?>
                    <li><a href="lista_producto.php">Lista de Productos</a></li>
                    
                </ul>
            </li>
            
            
            
            <li class="principal">
                <a href="#"><i class="fas fa-file-invoice"></i> Ventas</a>
                <ul>
                    <li><a href="nueva_venta.php">Nuevo venta</a></li>
                    <li><a href="ventas.php"> <i class="far fa-newspaper" ></i> ventas</a></li>
                </ul>
            </li>

            <li class="principal">
                
                <span class="user">  <?php echo   $_SESSION['user'].' -'.$_SESSION['rol'].' -'.$_SESSION['email'] ?></span>
			 	<img class="photouser" src="img/user.png" alt="Usuario">
				        
            </li>
            <li>
            <a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
                
            </li>



        </nav>
</header>

<body>
    
</body>
</html>