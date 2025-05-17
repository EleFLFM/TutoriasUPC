<?php
session_start();
require_once "../conexion.php";

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id']) || !isset($_POST['course_code'])) {
    echo json_encode(['success' => false]);
    exit();
}

$course_code = intval($_POST['course_code']);

try {
    // Obtener total de videos del curso
    $sql_total = "SELECT COUNT(*) as total FROM videos_curso WHERE course_code = ?";
    $stmt_total = $conn->prepare($sql_total);
    $stmt_total->bind_param("i", $course_code);
    $stmt_total->execute();
    $total = $stmt_total->get_result()->fetch_assoc()['total'];
    
    // Obtener videos vistos por el usuario
    $sql_vistos = "SELECT COUNT(DISTINCT vc.id) as vistos 
                  FROM videos_curso vc
                  JOIN video_views vv ON vc.video_url = vv.video_url 
                  WHERE vv.usuario_id = ? AND vv.course_code = ? AND vv.visto = TRUE";
    $stmt_vistos = $conn->prepare($sql_vistos);
    $stmt_vistos->bind_param("ii", $_SESSION['usuario_id'], $course_code);
    $stmt_vistos->execute();
    $vistos = $stmt_vistos->get_result()->fetch_assoc()['vistos'];
    
    echo json_encode([
        'success' => true,
        'total' => $total,
        'vistos' => $vistos
    ]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>