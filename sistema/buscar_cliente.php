<?php
    session_start();
	include"../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style_lista_usuarios.css">	
	<link rel="stylesheet" href="css/style_listaUsuario_paginador.css">
	<link rel="stylesheet" href="css/style_buscador_paginador.css">


	<?php include"includes/scripts.php"; ?>
	
	
	
	<title>Lista de clientes</title>

</head>
<body>

	<?php include"includes/header.php"; ?>
	<section id="container">

    <?php 
        $busqueda = strtolower($_REQUEST['busqueda']);
        if (empty($busqueda))
        {
               header("location: lista_cliente.php");
			   mysqli_close($conection);
        }
    
    ?>
		<h1>Lista de clientes</h1>
		<a href="registro_usuario.php" class="btn_new">Crear cliente</a>

		<form  action="buscar_cliente.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda;?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>


		<table>
			<tr>
				<th>ID</th>
				<th>Nit</th>
				<th>Nombre</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Acciones</th> 
			</tr>		
		<?php





				//paginador 
				$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM cliente 
																		WHERE ( idcliente LIKE '%$busqueda%' OR
																			nit LIKE'%$busqueda%' OR
																			nombre LIKE '%$busqueda%' OR 
																			telfono LIKE 	'%$busqueda%' OR
                                                                            direccion LIKE 	'%$busqueda%'  
																			 ) 
																		AND estado = 1");
				
				$result_registros = $sql_registros;
				$total_registro = $result_registros;

				//cantidad de usuarios a mostrar dentro de la lista
				$por_pagina = 5;

				if (empty($_GET['pagina'])) {
					$pagina = 1;
				}else {
					$pagina = $_GET['pagina'];
				}


				$desde = ($pagina-1) * $por_pagina;
				$total_paginas = ceil($total_registro / $por_pagina);
				//la variable ceil sirve para redondear






				$query = mysqli_query($conection ,"SELECT * FROM cliente where 
															( idcliente LIKE '%$busqueda' OR
																nit LIKE'%$busqueda%' OR
																nombre LIKE '%$busqueda%' OR 
																telefono LIKE 	'%$busqueda%'OR
																direccion LIKE 	'%$busqueda%')  

																AND												
																estado = 1 LIMIT $desde,$por_pagina");


				mysqli_close($conection);

				$result = mysqli_num_rows($query);
				if ($result > 0 ) {
					
					while ($data = mysqli_fetch_array($query)) {
						

							?>
								
								<tr>
									<td><?php  echo $data["idcliente"]  ?></td>
									<td><?php  echo $data["nit"]  ?></td>
									<td><?php  echo $data["nombre"]  ?></td>
									<td><?php  echo $data["telefono"]  ?></td>
									<td><?php  echo $data["direccion"]  ?></td>
									<td>


							
								<a class="link_edit" href="editar_cliente.php?id=<?php  echo $data["idcliente"]  ?>">Editar</a>
							
								<?php if ($_SESSION['rol']==1 ||  $_SESSION['rol']==2) { //esta condicion oculta la opcion de eliminar el usuario admin
							  ?>
								
								|
								<a class="link_delete" href="eliminar_cliente.php?id=<?php  echo $data["idcliente"]  ?>">Eliminar</a>
							<?php } ?>
						
							</td>


		<?php			
				}
			}
		?>
		
		</table>


		<?php 
		
			if ($result > 0) {
				
			
		?>	
			<div class="paginador">
				<ul>
					<?php 
						if ($pagina!= 1) {
							# code...
						
					?>
					<li><a href="?pagina=<?php echo 1 ;?>">|<</a></li>
					<li><a href="?pagina=<?php echo $pagina -1;?>"><<</a></li>
					
			<?php 
					}
				    for ($i=1; $i <= $total_paginas; $i++) { 
						# code...
						if ($i==$pagina) {
							# code...
							echo '<li class="pageSelected">'.$i.'</li>';
						}else {
							echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
						}
	
					}

					
			?>		
			
			<?php 
						if ($pagina!= $total_paginas) {
							# code...
						
					?>
					<li><a href="?pagina=<?php echo $pagina +1 ;?>">>></a></li>
					<li><a href="?pagina=<?php echo $total_paginas ;?>">>|</a></li>
				<?php } ?>
				</ul>
			</div>


	</section>

<?php   


						} else { 
							header("location: lista_cliente.php");
						}

?>

	<?php include"includes/footer.php"; ?>
</body>
</html>