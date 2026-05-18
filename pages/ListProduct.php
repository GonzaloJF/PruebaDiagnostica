<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <Link rel="stylesheet" href="../css/app.css"></Link>
</head>
<body>
  <?php
    require_once '../backend/conexion.php';
    try{
      $objetoConexion = new CConexion();
      $pdo = $objetoConexion->ConexionBD();

      $sql = "SELECT p.nombre_producto,p.precio_producto,p.descripcion,m.abreviacion FROM productos p INNER JOIN monedas m ON p.moneda_id = m.moneda_id";
  
      $stmtProductos = $pdo->query($sql);
      $productos = $stmtProductos->fetchAll();


    }catch(Exception $e){
      die("Error al cargar los datos: ". $e->getMessage());
     }
  ?>
    <nav class="menu">
      <a href="./createProduct.php" class="navButton">Crear Productos</a>
    </nav>

    <div class="page">
      <?php  foreach ($productos as $producto): ?>
      <div class="cards-productos">
        <div class="nombre-producto">
          <h3><?= htmlspecialchars($producto['nombre_producto'])  ?></h3>
        </div>
        <div class="descripcion">
          <div>Descipcion:</div>
          <p><?= htmlspecialchars($producto['descripcion'])  ?></p>
        </div>
        <div class="precio">
          <div>precio:</div>
          <p><strong><?= htmlspecialchars($producto['abreviacion']) ?></strong> 
            <?= htmlspecialchars(number_format($producto['precio_producto'], 2)) ?></p>
        </div>
      </div>
       <?php endforeach; ?>
    </div>
</body>
</html>