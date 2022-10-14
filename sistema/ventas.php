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
	
	
	
	<title> Lista de ventas</title>

</head>
<body>

	<?php include"includes/header.php"; ?>
	<section id="container">
		<h1> <i class="far fa-newspaper" ></i>Nueva venta</h1>
		<a href="nueva_venta.php" class="btn_new"> <i class="fas fa-user-plus"></i> Nueva venta</a>

		<form  action="buscar_cliente.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" class="form_search_input" placeholder="No. Factura">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

        <div>
            <h5>Buscar por Fecha</h5>
            <form action="buscar_venta.php" method="get" class="form_search_date">
                <label >De: </label>
                <input type="date" name="fecha_de" id="fecha_de" require>
                <label >A</label>
                <input type="date" name="fecha_a" id="fecha_a" require>
                <button type="submit" class="btn_view" ><i class="fas fa-serach"></i></button>
            </form>
        </div>


		<table>
			<tr>
				<th>No.</th>
				<th>Fecha / hora</th>
				<th>Cliente</th>
				<th>Vendedor</th>
				<th>Estado</th>
				<th class="textright" >Total Factura</th>
                <th class="textright" >Acciones</th> 
			</tr>		
		<?php



		

				//paginador 
				
				$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM factura WHERE estado != 10");
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





                $query = mysqli_query($conection, "SELECT f.nofactura, f.fecha, f.totalfactura, f.codcliente, f.estado
                                                            u.nombre as vendedor,
                                                            cl.nombre as cliente
                                                        FROM factura f
                                                        INNER JOIN usuario u
                                                        ON f.usuario = u.idusuario
                                                        INNER join cliente cl
                                                        on f.codcliente = cl.idcliente
                                                        WHERE f.estado != 0
                                                        ORDER BY f.fecha DESC LIMIT $desde,$por_pagina");

				mysqli_close($conection);

				$result = $query;
				if ($result > 0 ) {
					
					while ($data = mysqli_fetch_array($query)) {
                        if ($data['estado'] == 1) {
                            $estado = '<span class="pagada">Pagada</span>';
                        }else {
                            $estado = '<span class="anulada">Anulada</span>';
                        }

				?> <!-- C/F consuminodor final-->
								
								<tr id="row_<?php $data['nofactura']; ?>" > 
									<td><?php  echo $data["nofactura"]  ?></td>
									<td><?php  echo $data["fecha"]  ?></td>
									<td><?php  echo $data["cliente"]  ?></td>
									<td><?php  echo $data["vendedor"]  ?></td>
									<td><?php  echo $estado;  ?></td>
                                    <td class="textringht totalfactura"><span>Q.</span><?php echo $data['totalfactura']; ?></td>
									

									<td>


							
								<a class="link_edit" href="editar_cliente.php?id=<?php  echo $data["idcliente"]  ?>"> <i class="far fa-edit"></i> Editar</a>
								<?php if ($_SESSION['rol']==1 ||  $_SESSION['rol']==2) {?>
								|
								<a class="link_delete" href="eliminar_cliente.php?id=<?php  echo $data["idcliente"]  ?>"> <i class="far fa-trash-alt"> </i> Eliminar</a>
							<?php }?>

                                     </td>
                                </tr>

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