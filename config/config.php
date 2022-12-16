<?php
   const BASE_URL = "http://localhost/Proyecto-AmiraOptic/";

   //Datos para la conexión a la Base de Datos
   const DB_HOST = "localhost";
   const DB_NAME = "dbamira";
   const DB_USER = "root";
   const DB_PASSWORD = "";
   const DB_CHARSET = "utf8";
   
   define('CLIENT_ID', 'AbWQAJ6G1OKV0XuADBE3NiVbJdCSoHojJv24F_7MmaMJG3bA7ry9-YdbBlznX-dAiZFYbiSq8BFh2B7D');
   define('LOCALE', 'es_PE'); 
   define("CURRENCY", "USD");

   define("KEY_TOKEN", "APR.wqc-354*");
   define("MONEDA", "S/");

   session_start();

   $num_cart = 0;
   if(isset($_SESSION['carrito']['productos'])){
      $num_cart = count($_SESSION['carrito']['productos']);
}


?>