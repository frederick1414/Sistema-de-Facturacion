<?php
    session_start();
    if ($_SESSION['rol'] !=1) {
        header("location: ./");
    }
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
	
	
	
	<title>Lista de usuarios</title>

</head>
<body>

	<?php include"includes/header.php"; ?>
	<section id="container">

    <?php 
        $busqueda = strtolower($_REQUEST['busqueda']);
        if (empty($busqueda))
        {
               header("location: lista_usuario.php");
			   mysqli_close($conection);
        }
    
    ?>
		<h1>Lista de usuarios</h1>
		<a href="registro_usuario.php" class="btn_new">Crear usuario</a>

		<form  action="buscar_usuario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda;?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>


		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Rol</th>
				<th>Acciones</th> 
			</tr>		
		<?php





				//paginador 
				//busqueda de roles 
				$rol='';
				if ($busqueda=='administrador')
				{
					$rol = "OR rol LIKE '%1%' ";

				}else if ($busqueda=='supervisor') {
					$rol = "OR rol LIKE '%2%' ";

				}else if ($busqueda=='vendedor') {
					$rol = "OR rol LIKE '%3%' ";
				}



				$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM usuario 
																		WHERE ( idusuario LIKE '%$busqueda%' OR
																			nombre LIKE'%$busqueda%' OR
																			correo LIKE '%$busqueda%' OR 
																			usuario LIKE 	'%$busqueda%'  
																			$rol ) 
																		AND estado = 1");


				$result_registros = mysqli_fetch_array($sql_registros);
				$total_registro = $result_registros['total_registro'];

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






				$query = mysqli_query($conection ,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u 
				INNER JOIN rol r ON u.rol = r.idrol 
															where 
															( u.idusuario LIKE '%$busqueda' OR
																u.nombre LIKE'%$busqueda%' OR
																u.correo LIKE '%$busqueda%' OR 
																u.usuario LIKE 	'%$busqueda%'OR
																r.rol  LIKE 	'%$busqueda%')  

																AND												
																estado = 1 LIMIT $desde,$por_pagina");


				mysqli_close($conection);

				$result = mysqli_num_rows($query);
				if ($result > 0 ) {
					
					while ($data = mysqli_fetch_array($query)) {
						

							?>
								
								<tr>
									<td><?php  echo $data["idusuario"]  ?></td>
									<td><?php  echo $data["nombre"]  ?></td>
									<td><?php  echo $data["correo"]  ?></td>
									<td><?php  echo $data["usuario"]  ?></td>
									
									<td><?php  echo $data["rol"]  ?></td>
									

									<td>


							
								<a class="link_edit" href="editar_usuario.php?id=<?php  echo $data["idusuario"]  ?>">Editar</a>
							
							<?php if ($data["idusuario"]!=1 )  {
								//esta condicion oculta la opcion de eliminar el usuario admin
							 ?>
								|
								<a class="link_delete" href="eliminar_usuario.php?id=<?php  echo $data["idusuario"]  ?>">Eliminar</a>
							<?php } ?>
						
							</td>


		<?php			
				}
			}
		?>
		
		</table>
<?php

			if ($total_paginas!=0)
			 {
				
			

?>
			<div class="paginador">
				<ul>
					<?php 
						if ($pagina!= 1) {
							# code...
						
					?>
					<li><a href="?pagina=<?php echo 1 ;?>&busqueda=<?php echo $busqueda; ?> ">|<</a></li>
					<li><a href="?pagina=<?php echo $pagina -1;?>&busqueda=<?php echo $busqueda; ?>  "><<</a></li>
					
			<?php 
					}
				    for ($i=1; $i <= $total_paginas; $i++) { 
						# code...
						if ($i==$pagina) {
							# code...
							echo '<li class="pageSelected">'.$i.'</li>';
						}else {
							echo '<li><a href="?pagina='.$i.' &busqueda='.$busqueda.'">'.$i.'</a></li>';
						}
	
					}

					
			?>		
			
			<?php 
						if ($pagina!= $total_paginas) {
							# code...
						
					?>
					<li><a href="?pagina=<?php echo $pagina +1 ;?>&busqueda=<?php echo $busqueda; ?> ">>></a></li>
					<li><a href="?pagina=<?php echo $total_paginas ;?> &busqueda=<?php echo $busqueda; ?>">>|</a></li>
				<?php } ?>
				</ul>
			</div>

	</section>

<?php   


						}


?>

	<?php include"includes/footer.php"; ?>
</body>
</html>