<?php
require_once 'conexion.php';

// Aseguramos que la respuesta sea interpretada como JSON
header('Content-Type: application/json');

if (isset($_GET['bodega_id']) && !empty($_GET['bodega_id'])) {
    try {
        $objetoConexion = new CConexion();
        $pdo = $objetoConexion->conexionBD();

        $stmt = $pdo->prepare("SELECT sucursal_id, nombre FROM sucursales WHERE bodegas_id = :bodega_id");
        $stmt->execute(['bodega_id' => $_GET['bodega_id']]);
        $sucursales = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retornamos el array de sucursales en formato JSON
        echo json_encode($sucursales);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode([]);
}
?>