<?php

session_start();
session_unset(); /* Libera variables de sesión */
session_destroy(); /* Destruye toda la información registrada de una sesión */

echo '<script>alert("Cerrando sesión...");
     window.location.href="../view/index.php";</script>';

 /* header("Location: iniciar_sesion.php");   */

?>