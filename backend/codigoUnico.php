<?php

  require_once 'conexion.php';

  header('Content-Type: application/json');

  if(isset($_GET['codigo']) && !empty($_GET['codigo'])){
    try{
      $objetoConexion = new CConexion();
      $pdo = $objetoConexion->ConexionBD();

      $stmt = $pdo->prepare("SELECT COUNT(*) FROM productos WHERE codigo_producto = :codigo");
      $stmt->execute(['codigo' => $_GET['codigo']]);
      $existe = $stmt->fetchColumn() > 0;

      echo json_encode(['existe' => $existe]);

    }catch(Exception $e){
      http_response_code(500);
      echo json_encode(['error' => $e->getMessage()]);
    }
  }else{

    echo json_encode(['existe' => false]);
  }
?>