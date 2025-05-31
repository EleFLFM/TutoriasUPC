<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['idcargo'] != 3) {
    http_response_code(403);
    echo "Acceso denegado.";
    exit();
}

$docente_id = $_SESSION['usuario_id'];
$curso = $_POST['curso'] ?? '';

if (empty($curso)) {
    echo "";
    exit();
}

include "../conexion.php";

// Validar que el docente tiene ese curso asignado
$stmt = $conn->prepare("SELECT COUNT(*) FROM docente_curso WHERE docente_id = ? AND course_code = ?");
$stmt->bind_param("is", $docente_id, $curso);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count == 0) {
    echo "No autorizado";
    exit();
}

// Obtener ingresos con nombre del estudiante
$query = "
    SELECT ic.id, u.nombre, ic.fecha_ingreso 
    FROM ingresos_curso ic
    JOIN usuarios u ON ic.usuario_id = u.id
    WHERE ic.course_code = ?
    ORDER BY ic.fecha_ingreso DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $curso);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($row['fecha_ingreso']) . "</td>";
    echo "</tr>";
}

$stmt->close();
$conn->close();
?>
