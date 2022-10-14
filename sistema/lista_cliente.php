<?php 
    session_start();
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
	
	
	
	<title>Lista de clientes</title>

</head>
<body>

	<?php include"includes/header.php"; ?>
	<section id="container">
		<h1> <i class="fas fa-users"></i> Lista de clientes</h1>
		<a href="registro_cliente.php" class="btn_new"> <i class="fas fa-user-plus"></i> Crear cliente</a>

		<form  action="buscar_cliente.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" class="form_search_input" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>


		<table>
			<tr>
				<th>ID</th>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Acciones</th> 
			</tr>		
		<?php



		

				//paginador 
				
				$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM cliente WHERE estado = 1");
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






				$query = mysqli_query($conection ,"SELECT * FROM cliente 
                                                                where estado = 1 
				LIMIT $desde,$por_pagina");
				mysqli_close($conection);

				$result = mysqli_num_rows($query);
				if ($result > 0 ) {
					
					while ($data = mysqli_fetch_array($query)) {
						if ($data['nit'] < 1)
						{
							$nit  = 'C/F';  
						}else {
							$nit = $data["nit"];
						}

				?> <!-- C/F consuminodor final-->
								
								<tr>
									<td><?php  echo $data["idcliente"]  ?></td>
									<td><?php  echo $nit  ?></td>
									<td><?php  echo $data["nombre"]  ?></td>
									<td><?php  echo $data["telefono"]  ?></td>
									<td><?php  echo $data["direccion"]  ?></td>
									

									<td>


							
								<a class="link_edit" href="editar_cliente.php?id=<?php  echo $data["idcliente"]  ?>"> <i class="far fa-edit"></i> Editar</a>
								<?php if ($_SESSION['rol']==1 ||  $_SESSION['rol']==2) {?>
								|
								<a class="link_delete" href="eliminar_cliente.php?id=<?php  echo $data["idcliente"]  ?>"> <i class="far fa-trash-alt"> </i> Eliminar</a>
							<?php }?>

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