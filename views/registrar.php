<?php include_once("./header.php"); ?>

<div class="regis">
    <h2>REGÍSTRATE</h2>
    <form class="formregis" action="" method="post">
        <div class="datos">
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre">
        </div>
        <div class="datos">
        <label for="apellido">Apellidos: </label>
        <input type="text" id="apellido" name="apellido">
        </div>
        <div class="datos">
        <label for="correo">Correo: </label>
        <input type="email" id="correo" name="correo">
        </div>
        <div class="datos">
        <label for="password">Contraseña: </label>        
        <input type="password" id="password" name="password">
        </div>
        <div class="datos">
        <label for="dni">DNI: </label>        
        <input type="text" id="dni" name="dni" minlength="8" maxlength="8">
        </div>
        <p class="autori">Autorizo el uso de mis datos personales para fines de marketing</p>
        <button name="registrar" class="btnRegis">Crear cuenta</button>

        <?php require("../controller/controllerRegistrar.php"); ?>
        
    </form>
</div>

<?php include_once("./footer.php"); ?>

<!-- modificación de albertoqa   esperemos  -->