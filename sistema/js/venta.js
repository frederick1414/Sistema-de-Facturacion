


// === buscar cliente 
$('#nit_cliente').keyup(function(e){
    e.preventDefault();

    var cl = $(this).val();
    var action = 'searchCliente';

    $ajax({
        url: 'ajax.php',
        type: 'POST',
        async:true, 
        data: {action:action,cliente:cl},

        success : function(response)
        {
            
            if (response == 0) {
                $('#idcliente').val('');
                $('#nom_cliente').val('');
                $('#tel_cliente').val('');
                $('#dir_cliente').val('');
                //motrar boton agregar
                $('.btn_new_cliente').slideDown();
            }else{
                var data = $.parseJSON(response);
                $('#idcliente').val(data.idcliente);
                $('#nom_cliente').val(data.nombre);
                $('#tel_cliente').val(data.telefono);
                $('#dir_cliente').val(data.direccion);
                //ocultar boton agregar
                $('btn_new_cliente').slideUp();

                //bloque campos
                $('#nom_cliente').attr('disabled','disabled');
                $('#tel_cliente').attr('disabled','disabled');
                $('#dir_cliente').attr('disabled','disabled');

                //ocultar boton agregar
                $('btn_new_cliente').slideUp();
                
            }
        },
        error: function(error){

        }
    });
});


//crear cliente ventas


$('#form_new_cliente_venta').submit(function(e){
    e.preventDefault();

    $ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data : $('#form_new_cliente_venta').serialize(),

        success : function(response)
        {
            if (response != 'error') {
                
                $('#idcliente').val(response);

                $('#nom_cliente').attr('disabled','disabled');
                $('#tel_cliente').attr('disabled','disabled');
                $('#dir_cliente').attr('disabled','disabled');

                $('.btn_new_cliente').slideUp();

                
                $('.div_registro_cliente').slideUp();
            }
        },
        error: function(error)
        {

        }
    })
});

$('#txt_cod_producto').keyup(function(e){
    e.preventDefault();

    var producto = $(this).val();
    var action  = 'infoProducto';
    if ($producto != '') {
        
            
            $ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data : {action:action,producto:producto},

                success: function(response)
                {
                    console.log(response);
                },
                error: function(error)
                {

                }
            });
    }

});


//registrar cliente ventas



