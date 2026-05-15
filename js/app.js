const formulario = document.querySelector("#formularioProducto");

// Validacion codigo
function validarCodigo(codigo) {
  const regexCodigo = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/;
  if (codigo === "") {
    alert("El código del producto no puede estar en blanco.");
    return false;
  } else if (!regexCodigo.test(codigo)) {
    alert("El código del producto debe contener letras y números");
    return false;
  } else if (codigo.length < 5 || codigo.length > 15) {
    alert("El código del producto debe tener entre 5 y 15 caracteres.");
    return false;
  }
  return true;
}

//validacion nombre
function validarNombre(nombre) {
  if (nombre === "") {
    alert("El nombre del producto no puede estar en blanco.");
    return;
  }
  if (nombre.length < 2 || nombre.length > 50) {
    alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
  }
  return true;
}
//validacion de precios
function validarPrecio(precio) {
  const regexPrecio = /^\d+(\.\d{1,2})?$/;
  if (precio === "") {
    alert("El precio del producto no puede estar en blanco");
    return false;
  } else if (!regexPrecio.test(precio)) {
    alert(
      "El precio del producto debe ser un número positivo con hasta dos decimales",
    );
    return false;
  }
  return true;
}
//validacion de bodega
function validarMaterial(material) {
  if (material.length < 2) {
    alert("Debe seleccionar al menos dos materiales para el producto.");
    return false;
  }
  return true;
}
function validarBodega(bodega) {
  if (bodega === "") {
    alert("Debe seleccionar una bodega.");
    return false;
  }
  return true;
}

function validarSucursal(sucursal) {
  if (sucursal === "") {
    alert("Debe seleccionar una sucursal para la bodega seleccionada");
    return false;
  }
  return true;
}

function validarMoneda(moneda) {
  if (moneda === "") {
    alert("Debe seleccionar una moneda para el producto.");
    return false;
  }
  return true;
}

function validarDescripcion(descripcion) {
  if (descripcion === "") {
    alert("La descripción del producto no puede estar en blanco.");
    return false;
  } else if (descripcion.length < 10 || descripcion.length > 1000) {
    alert("La descripción del producto debe tener entre 10 y 1000 caracteres.");
    return false;
  }
  return true;
}
formulario.addEventListener("submit", (e) => {
  e.preventDefault();
  //capturar los campos del formulario
  const codigo = document.getElementById("codigo").value.trim();
  const nombre = document.getElementById("nombre").value.trim();
  const bodega = document.getElementById("bodega").value;
  const sucursal = document.getElementById("sucursal").value;
  const moneda = document.getElementById("moneda").value;
  const precio = document.getElementById("precio").value;
  const material = [];
  document
    .querySelectorAll('input[name="materiales"]:checked')
    .forEach((checkbox) => {
      material.push(checkbox.value);
    });
  const descripcion = document.getElementById("descripcion").value.trim();

  if (!validarCodigo(codigo)) {
    return;
  }
  if (!validarNombre(nombre)) {
    return;
  }
  if (!validarPrecio(precio)) {
    return;
  }
  if (!validarMaterial(material)) {
    return;
  }
  if (!validarBodega(bodega)) {
    return;
  }
  if (!validarSucursal(sucursal)) {
    return;
  }
  if (!validarMoneda(moneda)) {
    return;
  }
  if (!validarDescripcion(descripcion)) {
    return;
  }
  //creacion del objeto a enviar a php
  const data = {
    codigo: codigo,
    nombre: nombre,
    bodega: bodega,
    sucursal: sucursal,
    moneda: moneda,
    precio: precio,
    material: material,
    descripcion: descripcion,
  };
  console.log(data);
});
