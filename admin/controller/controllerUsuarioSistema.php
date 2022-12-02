<?php

include("../model/modelUsuarioSistema.php");

/* Iniciar Sesión en el Sistema */
if(isset($_POST['sesionUsuario'])){
    //Instanciar objeto Registrar y Almacenar en el objeto loginUsuario los valores
    $loginUsuario = new modelUsuarioSistema;

    //Almacenar valores en setter
    $loginUsuario -> setCorreo($_POST['correoUser']);
    $loginUsuario -> setContrasena($_POST['contraUser']);

    //Almacenar en nuevas variables
    $correo = $loginUsuario -> getCorreo();
    $contrasena = $loginUsuario -> getContrasena();

    //Usar método para iniciar sesión
    $loginUsuario -> iniciarSesion($correo, $contrasena);
}

/* Añadir usuario al sistema */
if(isset($_POST['registrarUsuario'])){

    //Instanciar objeto Registrar y Almacenar en el objeto registrarUs los valores
    $registrarUs = new modelUsuarioSistema;

    //Almacenar valores son los setters
    $registrarUs -> setNombres($_POST['nombres']);
    $registrarUs -> setApellidos($_POST['apellidos']);
    $registrarUs -> setCorreo($_POST['correo']);
    $registrarUs -> setContrasena($_POST['contrasena']);
    $registrarUs -> setDni($_POST['dni']);
    $registrarUs -> setCelular($_POST['celular']);
    $registrarUs -> setDireccion($_POST['direccion']);
    $registrarUs -> setRol($_POST['rol']);

    /* Almacenar en nuevas variables */
    $nombres = $registrarUs -> getNombres();
    $apellidos = $registrarUs -> getApellidos();
    $correo = $registrarUs -> getCorreo();
    $contrasena = $registrarUs -> getContrasena();
    $dni = $registrarUs -> getDni();
    $celular = $registrarUs -> getCelular();
    $direccion = $registrarUs -> getDireccion();
    $rol = $registrarUs -> getRol();

    /* Usar método para almacenar en la base de datos */
    $registrarUs -> insertar($nombres, $apellidos, $correo, $contrasena, $dni, $celular, $direccion, $rol);

}

/* Editar usuario al sistema */
if(isset($_POST['editarUsuario'])){

    //Instanciar objeto Registrar y Almacenar en el objeto registrarUs los valores
    $editarUs = new modelUsuarioSistema;

    //Almacenar valores son los setters
    $editarUs -> setId($_POST['id']);
    $editarUs -> setNombres($_POST['nombresE']);
    $editarUs -> setApellidos($_POST['apellidosE']);
    $editarUs -> setCorreo($_POST['correoE']);
    $editarUs -> setContrasena($_POST['contrasenaE']);
    $editarUs -> setDni($_POST['dniE']);
    $editarUs -> setCelular($_POST['celularE']);
    $editarUs -> setDireccion($_POST['direccionE']);
    $editarUs -> setRol($_POST['rolE']);

    /* Almacenar en nuevas variables */
    $id = $editarUs -> getId();
    $nombres = $editarUs -> getNombres();
    $apellidos = $editarUs -> getApellidos();
    $correo = $editarUs -> getCorreo();
    $contrasena = $editarUs -> getContrasena();
    $dni = $editarUs -> getDni();
    $celular = $editarUs -> getCelular();
    $direccion = $editarUs -> getDireccion();
    $rol = $editarUs -> getRol();

    /* Usar método para almacenar en la base de datos */
    $editarUs -> editar($id, $nombres, $apellidos, $correo, $contrasena, $dni, $celular, $direccion, $rol);

}

if(isset($_POST['eliminarUsuario'])){

    //Instanciar objeto Registrar y Almacenar en el objeto registrarUs los valores
    $eliminarUs = new modelUsuarioSistema;

    //Almacenar valores son los setters
    $eliminarUs -> setId($_POST['id']);

    /* Almacenar en nuevas variables */
    $id = $eliminarUs -> getId();

    /* Usar método para almacenar en la base de datos */
    $eliminarUs -> eliminar($id);
}





?>