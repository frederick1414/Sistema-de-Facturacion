<?php
// buscar addCliente

if ($_POST['action'] == 'searchCliente') 
{
    if (!empty($_POST['cliente'])) {
        $nit = $_POST['cliente'];

        $query = mysqli_query($conection, "SELECT * FROM cliente WHERE nit LIKE '$nit' and estado=1");

        mysqli_close($conection);
        $result = mysqli_num_rows($query);

        $data = '';
        if ($result > 0) {
            $data = mysqli_fetch_assoc($query);
        }else {
            $data = 0;
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

    } 
    exit;
    
}

//registrar cliente ventas
if ($_POST['action'] == 'addcliente') {

    $nit = $_POST['nit_cliente'];
    $nombre = $_POST['nom_cliente'];
    $telefono = $_POST['tel_cliente'];
    $direccion = $_POST['dir_cliente'];
    $usuario_id = $_SESSION['idUser'];

    $query_insert = mysqli_query($conection, "INSERT INTO cliente(nit,nombre,telefono,direccion,usuario_id)
                                                VALUE ('$nit','$nombre','$telefono','$direccion','$usuario_id')");

    if ($query_insert) {
        $codCliente = mysqli_insert_id($conection);
        $msg = $codCliente;

    }else {
        $msg ='error';
    }
    mysqli_close($conection);
    echo $msg;
    exit;
}

?>