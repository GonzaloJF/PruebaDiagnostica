<?php

class CConexion{

  function ConexionBD(){
    $host = "localhost";
    $dbname = "prueba";
    $username = "postgres";
    $password = "War.Amumu132132";
    
    $conn = null; 

    try {
      $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    } catch(PDOException $exp) {
      echo "No se pudo establecer una conexión a la base de datos, error: " . $exp->getMessage();
    }
    
    return $conn;
  }
}

?>