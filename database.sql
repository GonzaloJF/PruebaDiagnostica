-- Creacion de la base de datos.
CREATE DATABASE prueba;

\c prueba;

-- Creacion de la tabla de bodegas
CREATE TABLE bodegas(
  bodegas_id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  nombre varchar(100) NOT NULL
);

-- Creacion de la tabla sucursales
CREATE TABLE sucursales(
  sucursal_id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  nombre varchar(100) NOT NULL,
  bodegas_id UUID,
  CONSTRAINT fk_bodega FOREIGN KEY(bodegas_id) REFERENCES bodegas(bodegas_id) 
);

-- Creacion de la tabla de los monedas
CREATE TABLE monedas( 
  moneda_id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  nombre varchar(100) NOT NULL,
  abreviacion varchar(10) NOT NULL
);

-- Creacion de la tabla de los productos.
CREATE TABLE productos(
  producto_id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  codigo_producto varchar(15) UNIQUE,
  nombre_producto varchar(50) NOT NULL,
  precio_producto numeric(10,2) NOT NULL, 
  materiales text[] NOT NULL,
  descripcion text NOT NULL,
  bodegas_id UUID,  
  sucursal_id UUID, 
  moneda_id UUID,   
  CONSTRAINT fk_bodega FOREIGN KEY(bodegas_id) REFERENCES bodegas(bodegas_id),
  CONSTRAINT fk_sucursal FOREIGN KEY(sucursal_id) REFERENCES sucursales(sucursal_id), 
  CONSTRAINT fk_moneda FOREIGN KEY(moneda_id) REFERENCES monedas(moneda_id)      
);


-- insertar valores en bodegas 
INSERT INTO bodegas(nombre) VALUES ('Bodega 1');
INSERT INTO bodegas(nombre) VALUES ('Bodega 2');
INSERT INTO bodegas(nombre) VALUES ('Bodega 3');
INSERT INTO bodegas(nombre) VALUES ('Bodega 4');

-- insertar monedas 
INSERT INTO monedas (nombre, abreviacion) 
VALUES ('Dólar Estadounidense', 'USD'),
       ('Peso Chileno', 'CLP'),
       ('Sol Peruano', 'PEN');


CREATE OR REPLACE FUNCTION crear_sucursales_automaticas(
    p_nombre_bodega VARCHAR,
    p_cantidad_sucursales INT
) 
RETURNS VOID AS $$
DECLARE
    v_bodega_id UUID;
    i INT;
BEGIN
    -- Buscamos el UUID de la bodega usando su nombre
    SELECT bodegas_id INTO v_bodega_id 
    FROM bodegas 
    WHERE nombre = p_nombre_bodega;

    -- Validamos si existe
    IF v_bodega_id IS NULL THEN
        RAISE EXCEPTION 'La bodega "%" no existe.', p_nombre_bodega;
    END IF;

    -- Insertamos la cantidad de sucursales solicitadas en el bucle
    FOR i IN 1..p_cantidad_sucursales LOOP
        INSERT INTO sucursales (nombre, bodegas_id)
        VALUES ('Sucursal ' || i || ' - ' || p_nombre_bodega, v_bodega_id);
    END LOOP;
END;
$$ LANGUAGE plpgsql;

SELECT crear_sucursales_automaticas('Bodega 1', 2);
SELECT crear_sucursales_automaticas('Bodega 2', 3);
SELECT crear_sucursales_automaticas('Bodega 3', 2);
SELECT crear_sucursales_automaticas('Bodega 4', 1);