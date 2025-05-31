<?php
session_start();
require_once "../conexion.php";

// Configurar cabeceras para respuesta JSON
header('Content-Type: application/json');

// Verificar que es una petición POST
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Obtener y validar datos
$usuario_id = isset($_POST['usuario_id']) ? intval($_POST['usuario_id']) : 0;
$course_code = isset($_POST['course_code']) ? intval($_POST['course_code']) : 0;
$comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';

// Validaciones básicas
if($usuario_id === 0 || $course_code === 0) {
    echo json_encode(['success' => false, 'message' => 'Datos de usuario o curso inválidos']);
    exit;
}

if(strlen($comentario) < 10) {
    echo json_encode(['success' => false, 'message' => 'El comentario debe tener al menos 10 caracteres']);
    exit;
}

// Verificar que el usuario está matriculado en el curso
$sql_verificar = "SELECT 1 FROM estudiante_curso WHERE usuario_id = ? AND course_code = ?";
$stmt_verificar = $conn->prepare($sql_verificar);
$stmt_verificar->bind_param("ii", $usuario_id, $course_code);
$stmt_verificar->execute();
$puede_comentar = $stmt_verificar->get_result()->num_rows > 0;

if(!$puede_comentar) {
    echo json_encode(['success' => false, 'message' => 'No estás matriculado en este curso']);
    exit;
}

// Insertar el comentario
try {
    $sql = "INSERT INTO comentarios_cursos (usuario_id, course_code, comentario, fecha_creacion) 
            VALUES (?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $usuario_id, $course_code, $comentario);
    
    if($stmt->execute()) {
        $_SESSION['comentario_exito'] = "¡Gracias! Tu comentario ha sido registrado.";
        echo json_encode([
            'success' => true,
            'message' => 'Comentario guardado exitosamente'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al guardar en la base de datos: ' . $conn->error
        ]);
    }
} catch(Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>