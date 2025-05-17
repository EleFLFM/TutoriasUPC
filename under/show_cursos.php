<?php
session_start();

// Verificación de autenticación
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit();
}

include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Tutorías UPC">
    <meta name="author" content="Universidad Popular del Cesar">
    
    <title>Mis Cursos | Tutorías UPC</title>

    <!-- Fuentes y estilos -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <style>
        .card-curso {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid #4edf72!important;
        }
        .card-curso:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .curso-header {
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .badge-semestre {
            font-size: 0.75rem;
            background-color: #f8f9fc;
            color:#4edf72;
            border: 1px solid #d1d3e2;
        }
        .btn-detalles {
            border-radius: 20px;
            padding: 0.25rem 1rem;
        }
    </style>
</head>

<body id="page-top">

    <!-- Contenedor principal -->
    <div id="wrapper">

        <!-- Barra lateral -->
        <?php include "sidebar_student.php"; ?>

        <!-- Contenido principal -->
        <div id="content-wrapper" class="d-flex flex-column">
            
            <!-- Barra superior -->
            <?php include "topbar.php"; ?>

            <!-- Contenido de la página -->
            <div id="content">
                <div class="container-fluid px-4">
                    
                    <!-- Encabezado -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Mis Cursos Matriculados</h1>
                    </div>
                    
                    <!-- Tarjetas de cursos -->
                    <div class="row">
                        <?php
                        // Obtener el ID del estudiante desde la sesión
                        $estudiante_id = $_SESSION['usuario_id'];

                        // Consulta para obtener los cursos del estudiante
                        $sql = "SELECT c.code, c.descripcion, c.semestre, c.id_estado, u.nombre 
                                FROM courses c
                                INNER JOIN estudiante_curso ec ON c.code = ec.course_code
                                INNER JOIN usuarios u ON ec.usuario_id = u.id
                                WHERE ec.usuario_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $estudiante_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $code = $row['code'];
                                $descripcion = $row['descripcion'];
                                $semestre = $row['semestre'];
                                $estado = $row['id_estado'];
                                $nombre_docente = "Sin asignar";
                                
                                // Consulta para obtener el docente asignado
                                $consulta_docente = "SELECT u.nombre 
                                                     FROM docente_curso dc
                                                     JOIN usuarios u ON dc.docente_id = u.id
                                                     WHERE dc.course_code = ?";
                                $stmt_docente = $conn->prepare($consulta_docente);
                                $stmt_docente->bind_param("i", $code);
                                $stmt_docente->execute();
                                $stmt_docente->bind_result($nombre);
                                
                                if ($stmt_docente->fetch()) {
                                    $nombre_docente = $nombre;
                                }
                                $stmt_docente->close();
                                
                                // Obtener URL del curso desde JSON
                                $rutas = json_decode(file_get_contents("rutas.json"), true);
                                $url = isset($rutas[$descripcion]) ? $rutas[$descripcion] : "#";
                                ?>
                                
                                <!-- Tarjeta de curso - Estilo mejorado -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card shadow h-100 py-2 card-curso">
                                        <div class="card-body">
                                            <div class="curso-header">
                                                <h5 class="font-weight-bold text-gray-800 mb-1">
                                                    <?= htmlspecialchars($descripcion) ?>
                                                </h5>
                                                <span class="badge badge-semestre">Semestre <?= htmlspecialchars($semestre) ?></span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <div class="text-sm text-success font-weight-bold">
                                                    <i class="fas fa-chalkboard-teacher mr-1"></i>
                                                    <?= htmlspecialchars($nombre_docente) ?>
                                                </div>
                                                <div class="text-xs text-muted mt-1">
                                                    <i class="fas fa-hashtag mr-1"></i>
                                                    Código: <?= htmlspecialchars($code) ?>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-auto text-center">
                                                <<a href="<?= $url . '?code=' . urlencode($code) ?>" class="btn btn-primary btn-sm btn-detalles">
    <i class="fas fa-arrow-right mr-1"></i> Ir al curso
</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<div class="col-12">
                                    <div class="alert alert-info text-center">
                                        <i class="fas fa-book-open mr-2"></i>
                                        Actualmente no tienes cursos matriculados.
                                    </div>
                                  </div>';
                        }
                        
                        $stmt->close();
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>

            <!-- Pie de página -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Universidad Popular del Cesar - Seccional Aguachica <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Botón para volver arriba -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal de cierre de sesión -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesión</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">¿Está seguro que desea cerrar sesión?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../cerrar_sesion.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

</body>
</html>