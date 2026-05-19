<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../css/app.css" />
  </head>
  <body>
    <?php
    require_once '../backend/conexion.php';

    try{
      $objetoConexion = new CConexion();

      $pdo = $objetoConexion->conexionBD();

      $stmtBodegas = $pdo->query("SELECT bodegas_id, nombre FROM bodegas");
      $bodegas = $stmtBodegas->fetchAll();
 
      $stmtMonedas = $pdo->query("SELECT moneda_id, abreviacion FROM monedas");
      $monedas = $stmtMonedas->fetchAll();
    }catch(Exception $e){
      die("Error al cargar los datos: ". $e->getMessage());
     }
    ?>
    <nav class="menu">
      <a href="./ListProduct.php" class="navButton">List Products</a>
    </nav>
    <div class="cuadroFormulario">
      <div class="card">
        <div class="tituloFormulario">
          <h1 class="Titulo">Formulario de Producto</h1>
        </div>
        <form id="formularioProducto">
          <div class="form-row">
            <div class="form-group">
              <label for="codigo">Codigo</label>
              <input type="text" id="codigo" name="codigo" />
            </div>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" name="nombre" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="bodega">Bodega</label>
              <select id="bodega" name="bodega">
                <option value="">Seleccione</option>
                  <?php foreach ($bodegas as $bodega): ?>
                  <option value="<?= htmlspecialchars($bodega['bodegas_id']) ?>">
                    <?= htmlspecialchars($bodega['nombre']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="sucursal">Sucursal</label>
              <select id="sucursal" name="sucursal">
                <option value="">Seleccione</option>

              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="mondeda">Moneda</label>
              <select id="moneda" name="moneda">
                <option value="">Seleccione</option>
                    <?php foreach ($monedas as $moneda):?>
                      <option value="<?= htmlspecialchars($moneda['moneda_id'])  ?>">
                        <?=  htmlspecialchars($moneda['abreviacion']) ?>
                      </option>
                    <?php endforeach;?>
              </select>
            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="number" id="precio" name="precio" step="0.01"/>
            </div>
                    </div>
            <div class="form-group full-width">
              <label>Material del Producto</label>
              <div class="checkbox-group">
                <label>
                  <input
                    type="checkbox"
                    id="plastico"
                    name="materiales"
                    value="Plastico"
                  />
                  Plastico
                </label>

                <label>
                  <input
                    type="checkbox"
                    id="metal"
                    name="materiales"
                    value="Metal"
                  />
                  Metal
                </label>

                <label>
                  <input
                    type="checkbox"
                    id="madera"
                    name="materiales"
                    value="Madera"
                  />
                  Madera
                </label>

                <label>
                  <input
                    type="checkbox"
                    id="vidrio"
                    name="materiales"
                    value="Vidrio"
                  />
                  Vidrio
                </label>
                <label>
                  <input
                    type="checkbox"
                    id="textil"
                    name="materiales"
                    value="Textil"
                  />
                  Textil
                </label>
              </div>
            </div>
          
          
            <div class="form-group full-width">
              <label for="descripcion">Descripcion</label>
              <textarea name="descripcion" id="descripcion"></textarea>
            </div>
            <div class="button-container">
              <button  type="submit">Guardar Producto</button>
  
            </div>
          </div>

        </form>  
      </div>
    </div>          
    <script src="../js/app.js"></script>
  </body>
</html>
