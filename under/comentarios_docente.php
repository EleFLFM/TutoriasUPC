<?php
session_start();
require_once "../conexion.php";

// Verificar que es docente
if (!isset($_SESSION['usuario_id']) || $_SESSION['idcargo'] != 3) {
    header('Location: ../login.php');
    exit();
}

// Obtener comentarios
$sql = "SELECT 
            c.calificacion, 
            c.comentario, 
            c.fecha_creacion, 
            co.nombre as curso_nombre,
            co.code as curso_codigo
        FROM comentarios_docentes c
        JOIN courses co ON c.course_code = co.code
        WHERE c.docente_id = ?
        ORDER BY c.fecha_creacion DESC";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();
$comentarios = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calcular promedio de calificaciones
$sql_avg = "SELECT AVG(calificacion) as promedio 
           FROM comentarios_docentes 
           WHERE docente_id = ?";
$stmt_avg = $conn->prepare($sql_avg);
$stmt_avg->bind_param("i", $_SESSION['usuario_id']);
$stmt_avg->execute();
$promedio = $stmt_avg->get_result()->fetch_assoc()['promedio'];
$promedio = $promedio ? round($promedio, 1) : 0;
$stmt_avg->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Valoraciones</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "sidebar_teacher.php" ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "topbar.php" ?>
                
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Mis Valoraciones</h1>
                    
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-chart-pie mr-2"></i>Estadísticas
                                    </h6>
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="mb-3">Calificación Promedio</h4>
                                    <div class="mb-3" style="font-size: 2rem;">
                                        <?= str_repeat('<i class="fas fa-star text-warning"></i>', floor($promedio)) ?>
                                        <?= ($promedio - floor($promedio) >= 0.5 ? '<i class="fas fa-star-half-alt text-warning"></i>' : '' ?>
                                        <?= str_repeat('<i class="far fa-star text-warning"></i>', 5 - ceil($promedio)) ?>
                                        <span class="d-block mt-2"><?= $promedio ?>/5</span>
                                    </div>
                                    <p class="mb-0">Total de valoraciones: <?= count($comentarios) ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-comments mr-2"></i>Comentarios de Estudiantes
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($comentarios)): ?>
                                        <?php foreach ($comentarios as $comentario): ?>
                                            <div class="mb-4 pb-3 border-bottom">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <h5><?= htmlspecialchars($comentario['curso_nombre']) ?> (<?= $comentario['curso_codigo'] ?>)</h5>
                                                    <small class="text-muted"><?= date('d/m/Y H:i', strtotime($comentario['fecha_creacion'])) ?></small>
                                                </div>
                                                <div class="mb-2">
                                                    <?= str_repeat('<i class="fas fa-star text-warning"></i>', $comentario['calificacion']) ?>
                                                    <?= str_repeat('<i class="far fa-star text-warning"></i>', 5 - $comentario['calificacion']) ?>
                                                </div>
                                                <?php if (!empty($comentario['comentario'])): ?>
                                                    <div class="bg-light p-3 rounded">
                                                        <p class="mb-0 font-italic">"<?= htmlspecialchars($comentario['comentario']) ?>"</p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="alert alert-info text-center">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            Aún no has recibido valoraciones de los estudiantes.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "footer.php" ?>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
</body>
</html>