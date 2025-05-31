<?php
session_start();
include "../conexion.php";

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$course_code = isset($_GET['code']) ? intval($_GET['code']) : 0;

if ($course_code > 0) {
    // Registrar acceso con fecha y hora actual
    $stmt = $conn->prepare("INSERT INTO ingresos_curso (usuario_id, course_code, fecha_ingreso) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $usuario_id, $course_code);
    $stmt->execute();
    $stmt->close();

    // Obtener la ruta del curso desde rutas.json
    $rutas = json_decode(file_get_contents("rutas.json"), true);

    // Obtener la descripción del curso
    $sql = "SELECT descripcion FROM courses WHERE code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $course_code);
    $stmt->execute();
    $stmt->bind_result($descripcion);
    $stmt->fetch();
    $stmt->close();

    if (isset($rutas[$descripcion])) {
        $url = $rutas[$descripcion];
        header("Location: " . $url . "?code=" . urlencode($course_code));
        exit();
    } else {
        echo "Ruta del curso no encontrada.";
    }
} else {
    echo "Código de curso no válido.";
}
?>
