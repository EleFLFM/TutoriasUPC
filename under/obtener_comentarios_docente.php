<?php
require_once "conexion.php";

if(!isset($_POST['docente_id'])) {
    die("ID de docente no proporcionado");
}

$docente_id = intval($_POST['docente_id']);

// Consulta para obtener comentarios
$sql = "SELECT c.*, co.nombre as curso_nombre 
        FROM comentarios_docentes c
        JOIN courses co ON c.course_code = co.code
        WHERE c.docente_id = ?
        ORDER BY c.fecha_creacion DESC";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $docente_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    echo '<div class="list-group">';
    while($comentario = $result->fetch_assoc()) {
        echo '<div class="list-group-item mb-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-1">'.htmlspecialchars($comentario['curso_nombre']).'</h6>
                    <small>'.date('d/m/Y H:i', strtotime($comentario['fecha_creacion'])).'</small>
                </div>
                <div class="mb-2">
                    '.str_repeat('<i class="fas fa-star text-warning"></i>', $comentario['calificacion']).'
                    '.str_repeat('<i class="far fa-star text-warning"></i>', 5 - $comentario['calificacion']).'
                </div>';
        
        if(!empty($comentario['comentario'])) {
            echo '<p class="mb-1">"'.htmlspecialchars($comentario['comentario']).'"</p>';
        }
        
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<div class="alert alert-info">Este docente no tiene comentarios aún.</div>';
}

$stmt->close();
$conn->close();
?>