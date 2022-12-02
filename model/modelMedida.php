<?php

include("../library/conexion.php");

class modelMedida{

    private $intId;
    private $ld_esfera;
    private $ld_cilindro;
    private $ld_eje;
    private $li_esfera;
    private $li_cilindro;
    private $li_eje;
    private $distInterpupi;
    private $id_cliente;

    public function __construct(){}

    public function insertarMedida($ldEsfera, $ldCilindro, $ldEje, $liEsfera, $liCilindro, $liEje, $distancia, $idCliente){
        $bd = new Conexion; 

        try{

            $consulta = "INSERT INTO medidas(ld_esfera, ld_cilindro, ld_eje, li_esfera, li_cilindro, li_eje, id_cliente, DistanciaInterpupilar) 
            VALUES (:ld_esfera, :ld_cilindro, :ld_eje, :li_esfera, :li_cilindro, :li_eje, :id_cliente, :DistanciaInterpupilar)";

            $registrar = $bd -> conecta() -> prepare($consulta);
            $registrar -> bindParam(':ld_esfera', $ldEsfera, PDO::PARAM_STR);
            $registrar -> bindParam(':ld_cilindro', $ldCilindro, PDO::PARAM_STR);
            $registrar -> bindParam(':ld_eje', $ldEje, PDO::PARAM_STR);
            $registrar -> bindParam(':li_esfera', $liEsfera, PDO::PARAM_STR);
            $registrar -> bindParam(':li_cilindro', $liCilindro, PDO::PARAM_STR);
            $registrar -> bindParam(':li_eje', $liEje, PDO::PARAM_STR);
            $registrar -> bindParam(':DistanciaInterpupilar', $distancia, PDO::PARAM_STR);
            $registrar -> bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
            $registrar -> execute();

            echo '<script type="text/javascript">
                  alert("¡Medidas Registradas! Puede continuar con su compra de lentes oftalmológicos");
                  window.location.href="../views/lentesOftalmologicos.php";
                  </script>';                
                  exit();
        }catch (PDOException $e){
            echo 'Falló el registro de las medidas: '.$e->getMessage();
            die();
        }finally{
            $registrar = null;
            $bd = null;
        }
    }

    public function editarMedida($ldEsfera, $ldCilindro, $ldEje, $liEsfera, $liCilindro, $liEje, $distancia, $idCliente){
        $bd = new Conexion; 

        try{
            $consulta = "UPDATE medidas SET ld_esfera = :ld_esfera , ld_cilindro = :ld_cilindro, ld_eje = :ld_eje, li_esfera = :li_esfera, li_cilindro = :li_cilindro,
            li_eje = :li_eje, DistanciaInterpupilar = :DistanciaInterpupilar WHERE id_cliente = :id_cliente";

            $registrar = $bd -> conecta() -> prepare($consulta);
            $registrar -> bindParam(':ld_esfera', $ldEsfera, PDO::PARAM_STR);
            $registrar -> bindParam(':ld_cilindro', $ldCilindro, PDO::PARAM_STR);
            $registrar -> bindParam(':ld_eje', $ldEje, PDO::PARAM_STR);
            $registrar -> bindParam(':li_esfera', $liEsfera, PDO::PARAM_STR);
            $registrar -> bindParam(':li_cilindro', $liCilindro, PDO::PARAM_STR);
            $registrar -> bindParam(':li_eje', $liEje, PDO::PARAM_STR);
            $registrar -> bindParam(':DistanciaInterpupilar', $distancia, PDO::PARAM_STR);
            $registrar -> bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
            $registrar -> execute();

            echo '<script type="text/javascript">
                  alert("¡Medidas Actualizadas! Puede continuar con su compra de lentes oftalmológicos");
                  window.location.href="../views/lentesOftalmologicos.php";
                  </script>';                
                  exit();
        }catch (PDOException $e){
            echo 'Falló el registro de las medidas: '.$e->getMessage();
            die();
        }finally{
            $registrar = null;
            $bd = null;
        }
    }

    public function setLd_esfera(string $ldEsfera){
        $this -> ld_esfera = $ldEsfera;
    }

    public function setLd_cilindro(string $ldCilindro){
        $this -> ld_cilindro = $ldCilindro;
    }

    public function setLd_eje(string $ldEje){
        $this -> ld_eje = $ldEje;
    }

    public function setLi_esfera(string $liEsfera){
        $this -> li_esfera = $liEsfera;
    }

    public function setLi_cilindro(string $liCilindro){
        $this -> li_cilindro = $liCilindro;
    }

    public function setLi_eje(string $liEje){
        $this -> li_eje = $liEje;
    }

    public function setDistInterpupi(string $disInter){
        $this -> distInterpupi = $disInter;
    }

    public function setId_cliente(string $idCliente){
        $this -> id_cliente = $idCliente;
    }

    public function getLd_esfera(): string{
        return $this -> ld_esfera;
    }

    public function getLd_cilindro(): string{
        return $this -> ld_cilindro;
    }

    public function getLd_eje(): string{
        return $this -> ld_eje;
    }

    public function getLi_esfera(): string{
        return $this -> li_esfera;
    }

    public function getLi_cilindro(): string{
        return $this -> li_cilindro;
    }

    public function getLi_eje(): string{
        return $this -> li_eje;
    }

    public function getDistInterpupi(): string{
        return $this -> distInterpupi;
    }

    public function getId_cliente(): string{
        return $this -> id_cliente;
    }

}


?>