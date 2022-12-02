<?php

    include("../model/modelRegistrar.php");

    if(isset($_POST['registrar'])){

        //Instanciar objeto registrar
        $registro = new modelRegistrar;

        //Almacenar en el objeto login los valores correo y password
        $registro -> setNombre($_POST['nombre']);
        $registro -> setApellido($_POST['apellido']);
        $registro -> setCorreo($_POST['correo']);
        $registro -> setPassword($_POST['password']);
        $registro -> setDni($_POST['dni']);

        $campos = array();

        //Devolver valores del objeto login y guardarlo en nuevas variables
        $nombre = $registro->getNombre();
        $apellido = $registro -> getApellido();
        $correo = $registro -> getCorreo();
        $password = $registro -> getPassword();
        $dni = $registro -> getDni();

        if(!empty($nombre) && !empty($apellido) && !empty($correo) && !empty($password) && !empty($dni)){

            //Método para registrar datos
            $registro -> registrar($nombre, $apellido, $correo, $password, $dni);

        }else{
            if($nombre == ""){        
                array_push($campos, "El campo Nombre no puede estar vacío.");
            }
            if($apellido == ""){        
                array_push($campos, "El campo apellido no puede estar vacío.");
            }

            if($correo == "" || strpos($email, "@") === false){
                array_push($campos, "Ingresa un correo electrónico válido.");
            }

            if(empty($contraseña)){
                array_push($campos, "El campo contraseña no debe estar vacío.");
            }   
            
            if(empty($dni)){
                array_push($campos, "El campo dni no debe estar vacío.");
            } 

            if(count($campos) > 0){
                echo "<div class='error'>";
                for($i = 0; $i < count($campos); $i++){
                    echo "<li>".$campos[$i]."</i>";
                }
            }else{
                echo "<div class='correcto'>
                        Datos correctos";                        
            }

            echo "</div>";
        }

    }

?>