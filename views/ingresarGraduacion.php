<?php require_once("./header.php"); ?>

<?php 



?>

<div class="graduacionTotal">
    <div class="graduacionTotal2">
        <div class="graduacionTotal2Titulo">
            <h1>INGRESA TU GRADUACIÓN</h1>
        </div>
        <div class="graduacionTotal2Config">
            <div class="totalConfigEncab">
                <h2>Configura tu graduación</h2>
            </div>
            <div class="totalConfigSubti">
                <h3>Selecciona las medidas para poder realizar tus lunas</h3>
            </div>
            <!-- La tabla para aumentar o disminuir -->
            <div class="ConfigLenteIzDer">
                <form action="" method="POST">
                <table>
                    <thead>
                        <tr>
                            <td></td>
                            <td>Esfera</td>
                            <td>Cilindro</td>
                            <td>Eje</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="lenteOWO">Lente Derecho</td>
                            <td><input type="number" name="ldEsfera" id="" value="0.25" step="0.01" max="1"></td>
                            <td><input type="number" name="ldCilindro" id="" value="0.00" step="0.01" max="1"></td>
                            <td><input type="number" name="ldEje" id="" value="0" step="0.01" max="1"></td>                        
                        </tr>
                        <tr>
                            <td class="lenteOWO">Lente Izquierdo</td>
                            <td><input type="number" name="liEsfera" id="" value="0.25" step="0.01" max="1"></td>
                            <td><input type="number" name="liCilindro" id="" value="0.00" step="0.01" max="1"></td>
                            <td><input type="number" name="liEje" id="" value="0" step="0.01" max="1"></td>    
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="distanciaInterp">
                <h2>Distancia Interpupilar (en mm)</h2>
                <input type="number" name="distanInterp" id="distanInterp" value="50">
            </div>
            <div class="eresIngresaD">
                <div class="ingresaSoloTxt">
                    <h3>Eres cliente, ingresa tu DNI: </h3>
                </div>
                <div class="ingresaInpot">
                    <input type="text" placeholder="Ingresa DNI" minlength="8" maxlength="8">
                </div>
            </div>
        </div>
        <div class="graduacionTotalSoloTexto">
            <h2>¿Eres Cliente AmiraOptic?</h2>
            <h3>Inicia sesión, para encontrar tus medidas registradas</h3>
        </div>
        <div class="graduacionFinali">            

            <button name="registrarMedidas" type="submit" id="registrarMedidas">Guardar medidas</button>

            <?php if(isset($_POST['registrarMedidas'])){
                        if($_SESSION == null) { ?>
                            <script>
                                alert('Debe iniciar sesión primero antes de ingresar su graduación de ojos');
                            </script>
            <?php }else{ ?>

            <?php require_once("../controller/controllerMedida.php"); ?>

            <?php } }?>
            </form>
        </div>
    </div>
</div>


<?php require_once("./footer.php"); ?>