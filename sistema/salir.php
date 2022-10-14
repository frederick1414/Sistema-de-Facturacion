<?php

    if (!empty($_POST['usuario']) || !empty($_POST['clave'])) 
        {
            session_start();
            
            session_destroy();

        } 
        header('location: ../');
            

      //  session_start();
            
        //session_destroy();
    

    //header('location : ../');

?>