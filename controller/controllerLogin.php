<?php
    
    include("../model/modelLogin.php");
    if(isset($_POST['entrar'])){

        //Instanciar objeto login
        $login = new modelLogin;
        
        //Almacenar en el objeto login los valores correo y password
        $login -> setCorreo($_POST['correo']);
        $login -> setPassword($_POST['password']);

        //Devolver valores del objeto login y guardarlo en nuevas variables
        $correo = $login->getCorreo();
        $password = $login -> getPassword();

        if(!empty($correo) && !empty($password)){        

            
            /* Método para iniciar sesión */
            $login -> iniciar($correo, $password);   
            
            
        }else if(empty($correo) && empty($password)){
            echo '<div class="error">*Ingrese el campo de correo. <br>
            *Ingrese el campo password.</div>';            
        }else if(empty($correo)){
            echo '<div class="error">*Ingrese el campo de correo</div>';
        }else if(empty($password)){
            echo '<div class="error">*Ingrese el campo de password</div>';
        }
    }
?>