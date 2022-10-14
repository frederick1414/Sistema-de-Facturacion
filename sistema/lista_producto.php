
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
    <link rel="stylesheet" href="css/foto_producto.css">
    <link rel="stylesheet" href="css/foto_list_producto.css">
	<link rel="stylesheet" href="css/modal_producto.css">
	<link rel="stylesheet" href="css/modal2.css">

	<?php include"includes/scripts.php"; ?>
	
	
	
	<title>Lista de clientes</title>

</head>


<header>
							

							<script>
							function myFunction() {
						
								
							var x = document.getElementById("myDIV");
							if (x.style.display === "none") {
								x.style.display = "block";
							} else {
								x.style.display = "none";
							}
						}
						</script>
						
						
						
							<div class="modal" id="myDIV"  >
								<div class="bodyModal"> 			<form action="" class="form_add_product" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sentDataProducto();">
										<h1><i class="fas fa-cubes " style="font-size: 45pt;" > </i> <br>  Agregar producto</h1> 
										<h2 class="nameproducto">Monitor LCD </h2>
										<input type="number" name="cantidad" id="txtCantidad" placeholder="Cantidad del producto" require> <br>
										
										<input type="text" name="precio" id="txtPrecio" placeholder="Precio del producto" require> 
						
										
										<input type="hidden" name="producto_id" id="txtproducto_id"  require> 
										
										<input type="hidden" name="action" value="addProduct" require> 	
										<div class="alert alertAddproduct"><p></p></div>	
										<button type="submit" class="btn_new1"><i class="fas fa-plus"></i>Agregar </button>
										<a href="#" class="btn_ok closeModal" onclick="myFunction() " > <i class="fas fa-ban"> </i> Cerrar</a>
									</form>
								</div>
							</div>
						
								</header>
							
<body>

	<?php include"includes/header.php"; ?>
	<section id="container">
		<h1> <i class="fas fa-cube"></i> Lista de productos</h1>
		<a href="registro_productoError.php" class="btn_new"> <i class="fas fa-plus"></i> Crear producto</a>

		<form  action="buscar_producto.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" class="form_search_input" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>


		<table>
			<tr>
            
				
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Precio</th>
				<th>Existencia</th>
				<script>
				
				
				
					$('#search_proveedor').change(function(e)){
						e.preventDefault();
						var sistema = getUrl();
						alert(sistema);
					}

					function getUrl(){
						var loc = window.location;
						var pathName = loc.pathName.substring(0, loc.pathname.lasIndexOf('/') + 1);
						return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search +loc.hash).length - pathName.length));
						}
				
				</script>
				<th>
					
				<?php
                                        $query_proveedor = mysqli_query($conection,"SELECT codproveedor, proveedor FROM proveedor WHERE estado=1 order by proveedor asc");
                                        $result_proveedor = $query_proveedor;
                                        
                                    ?>
                            
                                <select name="proveedor" id="search_proveedor"  >
                                    <?php 
                                        if ($result_proveedor > 0) {
                                            while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                                    
                                    ?>
                                    <option   value="<?php echo $proveedor['codproveedor']; ?>" >  <?php echo $proveedor['proveedor'] ?> </option>
                                
                                    <?php
                                            }
                                        }
                                    ?>       
                               </select> 	
				</th>
				<th>Foto</th>
				<th>Acciones</th> 
			</tr>		
		<?php



		

				//paginador 
				
				$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM producto WHERE estado = 1");
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






				$query = mysqli_query($conection ,"SELECT p.codproducto,p.descripcion,p.precio,p.existencia, pr.proveedor, p.foto 
                                                                FROM producto p 
                                                                INNER JOIN proveedor pr 
                                                                ON p.proveedor = pr.codproveedor                                                            
                                                                where p.estado = 1  ORDER BY p.codproducto DESC 
                                                                LIMIT $desde,$por_pagina");
				mysqli_close($conection);

                
				$result = mysqli_num_rows( $query);
				if ($result > 0 ) {
					
					while ($data = mysqli_fetch_array($query)) {
						if ($data['foto'] != 'img_producto.png') {
                            $foto = 'img/uploads/'.$data['foto'];
                        }else {
                            $foto = 'img/'.$data['foto'];
                        }
				?> 
								
								<tr>
									<td><?php  echo $data["codproducto"];  ?></td>
									<td><?php  echo $data["descripcion"] ; ?></td>
									<td><?php  echo $data["precio"] ; ?></td>
									<td><?php  echo $data["existencia"];  ?></td>
									<td><?php  echo $data["proveedor"]; ?></td>
									<td class="img_producto">  <img src="<?php  echo $foto; ?>" alt="<?php  echo $data["descripcion"] ; ?>"> </td>
									
                                <?php if ($_SESSION['rol']==1 ||  $_SESSION['rol']==2) {?>
							
								<td>
								
								
								<script> 
									function segunda(){
										$('.modal').fadeIn();


									var producto = $(this).attr('product');
									alert(producto);
									}
								</script>



								

                                <a class="link_add add_product"   product="agregar_producto.php?id=<?php  echo $data["codproducto"]  ?>" href="" onclick="segunda();" > <i class="fas fa-plus"></i>Agregar</a>
								|							
								<a class="link_edit" href="editar_producto.php?id=<?php  echo $data["codproducto"]  ?>"> <i class="far fa-edit"></i> Editar</a>
								|
								<a class="link_delete del_product"   product="agregar_producto.php?id=<?php  echo $data["codproducto"]  ?>" href="#" onclick="segunda();" > <i class="far fa-trash-alt"> </i> Eliminar</a>
								


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