<?php 
	session_start();
	include "../conexion.php";


	
	   
		$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM usuario WHERE estado = 1");
		$result_registros = mysqli_fetch_array($sql_registros);
		$total_registro = $result_registros['total_registro'];

		
			
	   
		$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_cliente FROM cliente WHERE estado = 1");
		$result_registros = mysqli_fetch_array($sql_registros);
		$total_cliente = $result_registros['total_cliente'];



	   
		$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_proveedores FROM proveedor WHERE estado = 1");
		$result_registros = mysqli_fetch_array($sql_registros);
		$total_proveedor = $result_registros['total_proveedores'];


	   
		$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_producto FROM producto WHERE estado = 1");
		$result_registros = mysqli_fetch_array($sql_registros);
		$total_producto = $result_registros['total_producto'];

	   
	
	   
		$sql_registros = mysqli_query($conection, "SELECT COUNT(*) as total_ventas FROM factura WHERE estado = 1");
		$result_registros = mysqli_fetch_array($sql_registros);
		$total_venta = $result_registros['total_ventas'];

	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include"includes/scripts.php"; ?>
	<link rel="stylesheet" href="css/panel_control.css">
	
	<link rel="stylesheet" href="css/form_inicio.css">
	
	<link rel="stylesheet" href="css/logo.css">
	
	<title>Sisteme Ventas</title>

</head>
<body>

	

	<?php include"includes/header.php"; ?>

	<section id="container">
		<div class="divContainer">
			<div>
			
				<h1 class="titlePanelControl">Panel de control</h1>
			</div>
			<div class="dashboard">
			<?php 
				if ( $_SESSION['rol']!=1) {
					
				
			  
				}else {
					
				
			?>
				<a href="lista_usuario.php">
					<i class="fas fa-users"></i>
					<p>
						<strong>Usuarios</strong><br>
						<span>

						<?php echo $total_registro;   
						
						 ?>
						</span>
					</p>
				</a>

					<?php } ?>

				<a href="lista_cliente.php">
					<i class="fas fa-user"></i>
					<p>
						<strong>clientes</strong><br>
						<span>
						<?php    
						
							echo $total_cliente; ?></span>
					</p>
				</a>


				<?php 
				if ( $_SESSION['rol']!=3) {
					
				
			  
			
			?>
				<a href="lista_proveedor.php">
					<i class="fas fa-building"></i>
					<p>
						<strong>Proveedores</strong><br>
						<span>
							<?php echo $total_proveedor;?>
						</span>
					</p>
				</a>

				<?php } ?>
				<a href="lista_producto.php">
					<i class="fas fa-cubes"></i>
					<p>
						<strong>Productos</strong><br>
						<span>
						<?php echo $total_producto;?>
						</span>
					</p>
				</a>

				<a href="ventas.php">
					<i class="fas fa-list"></i>
					<p>
						<strong>Ventas</strong><br>
						<span>

							<?php echo $total_venta; ?>
						</span>
					</p>
				</a>
			</div>
		</div>


		<div class="divInfoSistema">
			<div>
				<h1 class="titlePanelControl">Configuracion</h1>
			</div>
			<di class="containerPerfil">
				<div class="containerDataUser">
					<div class="logoUser">
						<img src="img/userr.png">
					</div>
					<div class="divDataUser">
						<h4>Informacion personal</h4>



						
						<div>
							<label >Nombre:</label>  <span><?php echo   $_SESSION['nombre']?></span>
						</div>
						
						<div>
							<label >Correo:</label>  <span><?php echo   $_SESSION['email']?></span>
						</div>
						
						<h4>Datos Usuario</h4>
						<div>
							<label >Rol:</label>  <span><?php echo   $_SESSION['rol']?></span>
						</div>
						
						<div>
							<label >Usuario:</label>  <span>	<?php echo   $_SESSION['user']?></span>
						</div>

						<h4>Cambiar contraseña</h4>
						<script>
							

							$('.newPass').keyup(function(){
								valiPass();
							});

							function valiPass(){
								var passNuevo = $('#txtNewPassUser').val();
								var confirmPassNuevo = $('#txtPassConfirm').val();
								if (passNuevo != confirmPassNuevo ) {
									$('alertChangePass').html('<p> Las contraseñas no son iguales. </p>');
									$('.alertChangePass').slideDown();
									return false;
								}
								if (passNuevo.length < 6) {
									$('alertChangePass').html('<p> La nueva contraseña debe ser de 6 caracteres como minimo. </p>')
									$('alertChangePass').slideDown();
									return false;
								}
								$('alertChangePass').html();
								$('alertChangePass').slideUp();
							}

						</script>
						<form action="" method="post" name="frmChangePass" id="frmChangePass"  class="cambiar" >

								<div>
									<input type="password" name="txtPassUser" id="txtPassUser" placeholder="Contraseña actual" required>
								</div>
								<div>
									<input  onclick="valiPass();" class="newPass" type="password" name="txtNewPassUser" id="txtNewPassUser" placeholder="Nueva contraseña " required>
								</div>
								<div>
									<input class="newPass" type="password" name="txtPassConfirm" id="txtPassConfirm" placeholder="Confirmar contraseña" required>
								</div>

								<div class="alertChangePass" style="display: none; ">

								</div>
								<div>
									<button onclick="valiPass();" type="submit" class="btn_save btnChangePass"> <i class="fas fa-key"></i> Cambiar contraseña</button>
								</div>
						</form>
								
					</div>
				</div>
				<?php if ($_SESSION['rol']==1) {
					# code...
				?>
				<div class="containerDataEmpresa">
				
					<div class="logoEmpresa">
										<div class="imgclass">
											<div class="imagen">
										    <img src="img/logoempresa.png">
											</div>
											<h4>Datos de la empresa</h4>


											<form action="" mothod="post" name="frmEmpresa" id="frmEmpresa">
												<input type="hidden" name="action" value="updateDataEmpresa">
												<div>
													<label> Nit: </label><input type="text" name="txtNit" id="txtNit" placeholder="Nit de la empresa" value="" required>

												</div>
												<div>
													<label> Nombre: </label><input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre de la empresa" value="" required>

												</div>
												<div>
													<label> Razon social: </label><input type="text" name="txtRSocial" id="txtRSocial" placeholder="Razon social" value="" required>

												</div>
												<div>
													<label> Telefono: </label><input type="text" name="txtTelEmpresa" id="txtTelEmpresa" placeholder="Numero de telefono" value="" required>

												</div>
												<div>
													<label> Correo electronico: </label><input type="text" name="txtEmailEmpresa" id="txtEmailEmpresa" placeholder="Correo electronico" value="" required>

												</div>
												<div>
													<label> Direccion: </label><input type="text" name="txtDirEmpresa" id="txtDirEmpresa" placeholder="Direccion" value="" required>

												</div>	<div>
													<label> Iva (%): </label><input type="text" name="txtIva" id="txtIva" placeholder="Impuesto al valor agregado (IVA)" value="" required>

												</div>
											
												<div class="alertFormEmpresa" style="display:none;"></div>
												<div>
													<button type="submit" class="btn_save btnChangePass"> <i class="far fa-save fa-lg"></i> Guardar datos</button>
												</div>
											</form>

										</div>
					</div>
				</div>
				<?php } ?>
			</di>
		</div>
	</section>
	
	<?php include"includes/footer.php"; ?>
</body>
</html>