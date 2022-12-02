<?php include_once("./header.php"); ?>

<div class="iniciar-sesion">
    <h2>INGRESA TU CUENTA</h2>
    <form class="formulario1" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="email" placeholder="Correo" name="correo">
        <input type="password" placeholder="Contraseña" name="password">
        <button name="entrar" class="btnLog">Ingresar</button>
        <?php require("../controller/controllerLogin.php"); ?>
    </form>
</div>

<div class="nuevoo">
    <h3>¿Nuevo Cliente? &nbsp;<a href="./registrar.php">Crear una cuenta</a></h3>
</div>

<?php include_once("./footer.php"); ?>