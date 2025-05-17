<?php
session_start();

// Verificar autenticación del estudiante
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
    <meta name="description" content="Sistema de Tutorías UPC - Cursos Activos">
    <meta name="author" content="Universidad Popular del Cesar">

    <title>Cursos Activos | Tutorías UPC</title>

    <!-- Fuentes -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Estilos -->
    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <style>
        .card-curso {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
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
                        <h1 class="h3 mb-0 text-gray-800">Todos los Cursos Activos</h1>
                    </div>
                    
                    <!-- Filtros (opcional para futuras implementaciones) -->
                    <!-- <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar curso..." id="searchInput">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-filter"></i> Filtrar por semestre
                                </button>
                                <div class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <a class="dropdown-item" href="#">Todos</a>
                                    <a class="dropdown-item" href="#">Semestre 1</a>
                                    <a class="dropdown-item" href="#">Semestre 2</a>
                                    <a class="dropdown-item" href="#">Semestre 3</a>
                                    <a class="dropdown-item" href="#">Semestre 4</a>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- Tarjetas de cursos -->
                    <div class="row">
                        <?php
                        // Consulta optimizada para obtener cursos activos
                        $sql = "SELECT c.code, c.descripcion, c.semestre, 
                                       COALESCE(u.nombre, 'Sin asignar') as nombre_docente 
                                FROM courses c
                                LEFT JOIN docente_curso dc ON c.code = dc.course_code
                                LEFT JOIN usuarios u ON dc.docente_id = u.id AND u.idcargo = 3
                                WHERE c.id_estado = 1 
                                ORDER BY c.semestre, c.descripcion";
                        
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $code = $row['code'];
                                $descripcion = $row['descripcion'];
                                $semestre = $row['semestre'];
                                $nombre_docente = $row['nombre_docente'];
                                
                                // Obtener URL del curso desde JSON
                                $rutas = json_decode(file_get_contents("rutas.json"), true);
                                $url = isset($rutas[$descripcion]) ? $rutas[$descripcion] : "#";
                                ?>
                                
                                <!-- Tarjeta de curso -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2 card-curso">
                                        <div class="card-body">
                                            <div class="curso-header">
                                                <h5 class="font-weight-bold text-gray-800 mb-1">
                                                    <?= htmlspecialchars($descripcion) ?>
                                                </h5>
                                                <span class="badge badge-semestre">Semestre <?= htmlspecialchars($semestre) ?></span>
                                            </div>
                                            
                                            <div class="mb-2">
                                                <div class="text-sm text-success font-weight-bold">
                                                    <i class="fas fa-chalkboard-teacher mr-1"></i>
                                                    <?= htmlspecialchars($nombre_docente) ?>
                                                </div>
                                                <div class="text-xs text-muted">
                                                    <i class="fas fa-hashtag mr-1"></i>
                                                    Código: <?= htmlspecialchars($code) ?>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-auto">
                                                <a href="<?= $url. '?code=' . urlencode($code) ?>" class="btn btn-primary btn-sm btn-block">
                                                    <i class="fas fa-arrow-right mr-1"></i> Ver detalles
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
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Actualmente no hay cursos activos disponibles.
                                    </div>
                                  </div>';
                        }
                        
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>

            <!-- Pie de página -->
            <?php include "footer.php"; ?>
        </div>
    </div>

    <!-- Botón para volver arriba -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    
    <!-- Script para búsqueda -->
    <!-- <script>
        $(document).ready(function(){
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".col-xl-3").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script> -->
</body>
</html>