<?php 
    session_start();
    if ($_SESSION['rol'] ==3) {
        header("location: ./");
    }
    include "../conexion.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style_lista_usuarios.css">	
	<link rel="stylesheet" href="css/style_listaUsuario_paginador.css">
	<link rel="stylesheet" href="css/buscar_usuario.css">


	<?php include"includes/scripts.php"; ?>
	
	
	
	<title>Lista de proveedores</title>

</head>
<body>

	<?php include"includes/header.php"; ?>
	<section id="container">
		<h1> <i class="fas fa-building"></i> Lista de proveedores</h1>
		<a href="registro_proveedor.php" class="btn_new"> <i class="fas fa-plus"></i> Crear proveedor</a>

		<form  action="buscar_proveedor.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" class="form_search_input" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>


		<table>
			<tr>
				<th>ID</th>
				<th>Proveedor</th>
				<th>Contacto</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Fecha</th>
				<th>Acciones</th> 
			</tr>		
		<?php



		

				//paginador 
				
				$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM proveedor WHERE estado = 1");
				$result_registros = mysqli_fetch_array($sql_registros);
				$total_registro = $result_registros['total_registro'];

				//cantidad de usuarios a mostrar dentro de la lista
				$por_pagina = 3;

				if (empty($_GET['pagina'])) {
					$pagina = 1;
				}else {
					$pagina = $_GET['pagina'];
				}


				$desde = ($pagina-1) * $por_pagina;
				$total_paginas = ceil($total_registro / $por_pagina);
				//la variable ceil sirve para redondear






				$query = mysqli_query($conection ,"SELECT * FROM proveedor
                                                                where estado = 1 
				LIMIT $desde,$por_pagina");
				mysqli_close($conection);

				$result = mysqli_num_rows($query);
				if ($result > 0 ) {
					
					while ($data = mysqli_fetch_array($query)) {
						$formato = 'Y-m-d H:i:s';
                        $fecha = DateTime::createFromFormat($formato, $data["date_add"]  );

				?> <!-- C/F consuminodor final-->
								
								<tr>
									<td><?php  echo $data["codproveedor"]  ?></td>
									<td><?php  echo $data["proveedor"]  ?></td>
									<td><?php  echo $data["contacto"]  ?></td>
									<td><?php  echo $data["telefono"]  ?></td>
									<td><?php  echo $data["direccion"]  ?></td>
									<td><?php  echo $fecha->format('d-m-Y');?></td>
									

									<td>


							
								<a class="link_edit" href="editar_proveedor.php?id=<?php  echo $data["codproveedor"]  ?>"> <i class="far fa-edit"></i> Editar</a>
								
								|
								<a class="link_delete" href="eliminar_proveedor.php?id=<?php  echo $data["codproveedor"]  ?>"> <i class="far fa-trash-alt"> </i> Eliminar</a>
							

		<?php			
				}
			}
		?>
		
		</table>
			<div class="paginador">
				<ul>
					<?php 
						if ($pagina!= 1) {
							# code...
						
					?>
					
					<li><a href="?pagina=<?php echo 1 ;?>"><i class="fas fa-step-backward"></i></a></li>
					<li><a href="?pagina=<?php echo $pagina -1;?>"><i class="fas fa-caret-left fa-lg"></i></a></li>
		
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
					<li><a href="?pagina=<?php echo $pagina +1 ;?>"><i class="fas fa-caret-right  fa-lg"></i></a></li>
					<li><a href="?pagina=<?php echo $total_paginas ;?>"><i class="fas fa-step-forward "></i></a></li>
				<?php } ?>
				</ul>
			</div>

	</section>

	
	<?php include"includes/footer.php"; ?>
</body>
</html>