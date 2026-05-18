<?php 
require_once 'conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data || 
            empty($data['codigo']) || 
            empty($data['nombre']) || 
            (!isset($data['precio']) || $data['precio'] === '') || 
            empty($data['bodega']) || 
            empty($data['sucursal']) || 
            empty($data['moneda']) || 
            empty($data['material']) || 
            empty($data['descripcion'])) {
            
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Datos del formulario incompletos']);
            exit;
        }

        $objetoConexion = new CConexion();
        $pdo = $objetoConexion->ConexionBD();

        $materialesArray = $data['material'];
        $materialesPostgres = '{' . implode(',', array_map(function($m) {
            return '"' . str_replace('"', '\\"', $m) . '"';
        }, $materialesArray)) . '}';

        // SQL con los marcadores corregidos y ordenados
        $sql = "INSERT INTO productos (
                    codigo_producto, nombre_producto, precio_producto, 
                    materiales, descripcion, bodegas_id, sucursal_id, moneda_id
                ) VALUES (
                    :codigo, :nombre, :precio, 
                    :materiales, :descripcion, :bodega_id, :sucursal_id, :moneda_id
                )";

        $stmt = $pdo->prepare($sql);

        $resultado = $stmt->execute([
            ':codigo'      => $data['codigo'],
            ':nombre'      => $data['nombre'],
            ':precio'      => $data['precio'],
            ':materiales'  => $materialesPostgres,
            ':descripcion' => $data['descripcion'],
            ':bodega_id'   => $data['bodega'], 
            ':sucursal_id' => $data['sucursal'], 
            ':moneda_id'   => $data['moneda']
        ]);

        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Producto guardado exitosamente']);
        } else {
            throw new Exception("No se pudo ejecutar la inserción de datos");
        }

    } catch (PDOException $e) {
        http_response_code(400);
        if ($e->getCode() == '23505') {
            echo json_encode(['success' => false, 'message' => 'El código del producto ya existe.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>