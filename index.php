<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <div>
      <h1>Formulario de Producto</h1>
    </div>
    <form id="formularioProducto">
      <div>
        <div>
          <label for="codigo">Codigo</label>
          <input type="text" id="codigo" name="codigo" />
        </div>
        <div>
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" name="nombre" />
        </div>
      </div>
      <div>
        <div>
          <label for="bodega">Bodega</label>
          <select id="bodega" name="bodega">
            <option value="">Seleccione</option>
            <option value="bodega1">Bodega 1</option>
            <option value="bodega2">Bodega 2</option>
            <option value="bodega3">Bodega 3</option>
          </select>
        </div>
        <div>
          <label for="sucursal">Sucursal</label>
          <select id="sucursal" name="sucursal">
            <option value="">Seleccione</option>
            <option value="sucursal1">Sucursal 1</option>
            <option value="sucursal2">Sucursal 2</option>
            <option value="sucursal3">Sucursal 3</option>
          </select>
        </div>
      </div>
      <div>
        <div>
          <label for="mondeda">Mondeda</label>
          <select id="moneda" name="moneda">
            <option value="">Seleccione</option>
            <option value="CLP">Pesos chilenos</option>
            <option value="PEN">Sol peruano</option>
          </select>
        </div>
        <div>
          <label for="precio">Precio</label>
          <input type="number" id="precio" name="precio" />
        </div>
        <div>
          <label>Material del Producto</label>
          <div>
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
        <div>
          <label for="descripcion">Descripcion</label>
          <textarea name="descripcion" id="descripcion"></textarea>
        </div>
      </div>
      <button type="submit">Guardar Producto</button>
    </form>
    <script src="./js/app.js"></script>
  </body>
</html>
