<?php
session_start();
require_once "../conexion.php";
header('Content-Type: application/json');

// Validar datos recibidos
$required_fields = ['docente_id', 'course_code', 'calificacion', 'usuario_id'];
foreach ($required_fields as $field) {
    if (!isset($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => "Campo requerido faltante: $field"]);
        exit;
    }
}

try {
    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO comentarios_docentes 
                          (docente_id, course_code, usuario_id, calificacion, comentario, fecha_creacion) 
                          VALUES (?, ?, ?, ?, ?, NOW())");
    
    $comentario = !empty($_POST['comentario']) ? $_POST['comentario'] : null;
    
    $stmt->bind_param("iiiis", 
        $_POST['docente_id'],
        $_POST['course_code'],
        $_POST['usuario_id'],
        $_POST['calificacion'],
        $comentario
    );

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Valoración guardada']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar: ' . $stmt->error]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>