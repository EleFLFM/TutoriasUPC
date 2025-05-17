<?php
session_start();
require_once "../conexion.php";

// Verificar sesión y parámetros
if (!isset($_SESSION['usuario_id']) || !isset($_POST['video_url']) || !isset($_POST['course_code'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit();
}

$video_url = filter_var($_POST['video_url'], FILTER_SANITIZE_URL);
$course_code = intval($_POST['course_code']);
$video_id = isset($_POST['video_id']) ? $_POST['video_id'] : '';

// Extraer ID de YouTube si es una URL de YouTube
if (empty($video_id) && strpos($video_url, 'youtube.com') !== false) {
    parse_str(parse_url($video_url, PHP_URL_QUERY), $params);
    $video_id = $params['v'] ?? '';
}

try {
    // Verificar si ya está registrado
    $sql_check = "SELECT id FROM video_views 
                 WHERE usuario_id = ? AND course_code = ? AND video_url = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("iis", $_SESSION['usuario_id'], $course_code, $video_url);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows === 0) {
        // Insertar nuevo registro
        $sql_insert = "INSERT INTO video_views 
                      (usuario_id, course_code, video_url, video_id, visto, fecha_visto)
                      VALUES (?, ?, ?, ?, TRUE, NOW())";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iiss", $_SESSION['usuario_id'], $course_code, $video_url, $video_id);
        $success = $stmt_insert->execute();
        $stmt_insert->close();
    } else {
        // Actualizar registro existente
        $sql_update = "UPDATE video_views SET visto = TRUE, fecha_visto = NOW()
                      WHERE usuario_id = ? AND course_code = ? AND video_url = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("iis", $_SESSION['usuario_id'], $course_code, $video_url);
        $success = $stmt_update->execute();
        $stmt_update->close();
    }

    echo json_encode(['success' => $success ?? false]);
    
} catch (Exception $e) {
    error_log("Error en registrar_video.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error en el servidor']);
}

$stmt_check->close();
$conn->close();
?>