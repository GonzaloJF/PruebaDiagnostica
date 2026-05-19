const formulario = document.querySelector("#formularioProducto");

const selectBodega = document.getElementById("bodega");
const selectSucursal = document.getElementById("sucursal");

const inputCodigo = document.getElementById("codigo");

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
  const precioLimpio = precio.replace(",", ".");
  const regexPrecio = /^\d+(\.\d{1,2})?$/;
  if (precio === "") {
    alert("El precio del producto no puede estar en blanco");
    return false;
  } else if (!regexPrecio.test(precio) || parseFloat(precioLimpio) <= 0) {
    alert(
      "El precio del producto debe ser un número positivo con hasta dos decimales",
    );
    return false;
  }
  return true;
}
//validacion de Material
function validarMaterial(material) {
  if (material.length < 2) {
    alert("Debe seleccionar al menos dos materiales para el producto.");
    return false;
  }
  return true;
}
//validacion Bodega
function validarBodega(bodega) {
  if (bodega === "") {
    alert("Debe seleccionar una bodega.");
    return false;
  }
  return true;
}
//Validacion Sucurcales
function validarSucursal(sucursal) {
  if (sucursal === "") {
    alert("Debe seleccionar una sucursal para la bodega seleccionada");
    return false;
  }
  return true;
}
// Validacion de Monedas
function validarMoneda(moneda) {
  if (moneda === "") {
    alert("Debe seleccionar una moneda para el producto.");
    return false;
  }
  return true;
}
// Validacion Descripciones
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

//evento selector sucursales dinamicas
selectBodega.addEventListener("change", async (e) => {
  const bodegaId = e.target.value;

  selectSucursal.innerHTML = '<option value="">Selecccione</option>';

  if (!bodegaId) {
    return;
  }

  try {
    const response = await fetch(
      `../backend/sucursal.php?bodega_id=${bodegaId}`,
    );

    if (!response.ok) {
      throw new Error("Error en la respuesta del servidor");
    }

    const sucursales = await response.json();

    sucursales.forEach((sucursal) => {
      const option = document.createElement("option");
      option.value = sucursal.sucursal_id;
      option.textContent = sucursal.nombre;
      selectSucursal.appendChild(option);
    });
  } catch (error) {
    console.error("Error al cargar sucursales:", error);
    alert("No se pudieron cargar las sucursales de esta bodega.");
  }
});

//verificar si el codigo es unico:
let codigoUninco = false;
async function validarCodigoUnico(codigo) {
  if (codigo === "") {
    return false;
  }

  try {
    const response = await fetch(`../backend/codigoUnico.php?codigo=${codigo}`);

    if (!response.ok) {
      throw new Error(
        "Error en la respuesta del servidor al verificar el código",
      );
    }

    const data = await response.json();

    if (data.existe) {
      alert("El código del producto ya está registrado.");
      codigoUnico = false;
      return false;
    } else {
      codigoUnico = true;
      return true;
    }
  } catch (error) {
    console.error("Error en la validación de unicidad: ", error);
    codigoUnico = false;
    return false;
  }
}
//eventos validar el input codigo
inputCodigo.addEventListener("blur", async (e) => {
  const codigo = e.target.value.trim();

  if (validarCodigo(codigo)) {
    await validarCodigoUnico(codigo);
  }
});

//Evento formularios
formulario.addEventListener("submit", async (e) => {
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
  const esUnico = await validarCodigoUnico(codigo);
  if (!esUnico) {
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
  try {
    const response = await fetch("../backend/guardarProducto.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    const resultado = await response.json();

    if (response.ok && resultado.success) {
      alert(resultado.message);
      formulario.reset();
      document.getElementById("sucursal").innerHTML =
        '<option value="">Seleccione</option>';
    } else {
      alert(
        "Error: " +
          (resultado.message || "No se pudo procesar la soluicitud. "),
      );
    }
  } catch (error) {
    console.error("Error al intentar guardar el producto: ", error);
    alert("Ocurrió un error critico al intentar conectar con el servidor");
  }
});
