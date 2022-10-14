<?php 
    session_start();
    include "../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Nueva venta</title>
    <link rel="stylesheet" href="css/nueva_venta.css">
    <link rel="stylesheet" href="css/boton_nueva_venta.css">



</head>
<body>

    <?php include "includes/header.php"; ?>
    

    <section id="container" > 
         
            <div >
                <h1 class="moverh"><i class="fas fa-cube" ></i>Nueva venta</h1>
                <div class="action_cliente">
                <h4 >Datos del cliente</h4>
            </div>
            <div >
                <a href="#" class="btn_new  btn_new_cliente"><i class="fas fa-plus" >Nuevo cliente</i></a>
            </div>
        
        
                        <div class="tbl_venta" > 
                            <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos" >
                                <input type="hidden" name="action" value="addCliente">
                                <input type="hidden" id="idcliente" name="idcliente"  value=""  require>
                                <div class="wd30">
                                <label for="nit">NIT</label>
                                <input type="text" name="nit_cliente" id="nit_cliente">
                                </div>
                                <div class="wd30">
                                <label for="text">Nombre</label>
                                <input type="text" name="nom_cliente" id="nom_cliente" disabled require >
                                </div>
                                <div class="wd30">
                                <label for="telefono">Telefono</label>
                                <input type="number" name="tel_cliente" id="tel_cliente" disabled require>
                                </div>
                                <div class="wd100">
                                <label for="direccion">Direccion</label>
                                <input  class="input_direcion" type="text" name="dir_cliente" id="dir_cliente" disabled require>
                                </div>

                                <div id="div_registro_cliente"  class="wd100">
                                <button type="submit"><i class="far fa-save fa-lg"></i> Guardar</button>
                                </div>
                            </form>
                        </div>

                        <div class="datos_venta">
                            <h4>Datos de ventas</h4>
                            <div class="datos">
                                <div class="wd50">
                                    <label >Vendedor</label>
                                    <p><?php echo $_SESSION['nombre']; ?></p>
                                </div>
                                <div class="wd50">
                                    <label >Acciones</label>
                                    <div id="acciones_venta">
                                        <a href="#" class="btn_ok textcenter btn_anula" id="btn_anular_venta"><i class="fas fa-ban"></i> Anular</a>
                                        <a href="#" class="btn_new textcenter" id="btn_facturar_venta"><i class="fas fa-edit" ></i> Procesar</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="tbl_venta">
                            <thead>
                                <tr>
                                    <th width="100px" >Codigo</th>
                                    <th>Descripcion </th>
                                    <th> Existencia</th>
                                    <th width="100px">Cantidad</th>
                                    <th class="textringht">Precio </th>
                                    <th class="textringht">Precio Total</th>
                                    <th>Accion</th>                        
                                </tr>
                                <tr>
                                    <td><input class="input_direcion" type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                                    <td id="txt_descripcion">-</td>
                                    <td id="txt_descripcion">-</td>
                                    <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                                    <td id="txt_precio" class="textringht">0.00</td>
                                    <td id="txt_precio_total"class="textringht">0.00</td>
                                    <td><a href="#" id="add_product_venta" class="link_add"> <i class="far fa-plus"></i> Agregar</a>
                                   
                                   
                                    </td>
                                </tr>
                                <tr>
                                    <th>Codigo</th>
                                    <th colspan="2" >Descripcion</th>
                                    <th>Cantidad</th>
                                    <th class="textringht">Precio</th>
                                    <th class="textringht">Precio Total</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="datalle_venta">
                                <tr>
                                    <td>1</td>
                                    <td colspan="2">Mouse USB</td>
                                    <td class="textcenter">1</td>
                                    <td class="textringht">100.00</td>
                                    <td class="textringht">100.00</td>
                                    <td class="">
                                        <a href="#" id="add_product_venta" class="link_delete" > <i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td colspan="2">Teclado USB</td>
                                    <td class="textcenter">1</td>
                                    <td class="textringht">150.00</td>
                                    <td class="textringht">150.00</td>
                                    <td class="">
                                        <a href="#" class="link_delete" onclick="event.preventDefault(); del_product_detalle(1);" > <i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
 
                            </tbody>
                            <tfoot>
                                <tr>
                                <td colspan="5" class="textringht">SUBTOTAL Q . </td>
                                <td class="textringht">1000.00 </td>
                                </tr>
                                <tr>
                                <td colspan="5" class="textringht">IVA (12%) . </td>
                                <td class="textringht">500 </td>
                                <tr>
                                <td colspan="5" class="textringht">TOTAL Q . </td>
                                <td class="textringht">1000.00 </td>
                                </tr>
                                </tr>
                            </tfoot>

                        </table>


       </section>

    <?php include "includes/footer.php"; ?>

    
    <script type="text/javascript" src="js/nueva_funcion.js"></script>
    
    <script  src="js/venta.js"></script>
</body>
</html>