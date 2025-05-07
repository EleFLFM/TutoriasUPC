<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Todos los Cursos Activos - UPC</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include "sidebar_student.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include "topbar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="left: 5%; position: relative;">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Todos los Cursos Activos</h1>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <?php
                            include "../conexion.php";
                            
                            // Consulta para obtener todos los cursos activos
                            $sql = "SELECT c.code, c.descripcion, c.semestre, 
                                           COALESCE(u.nombre, 'DO') as nombre_docente 
                                    FROM courses c
                                    LEFT JOIN docente_curso dc ON c.code = dc.course_code
                                    LEFT JOIN usuarios u ON dc.docente_id = u.id AND u.idcargo = 3
                                    WHERE c.id_estado = 1 
                                    GROUP BY c.code, c.descripcion, c.semestre, nombre_docente"; 
                            $result = $conn->query($sql);
                            
                            // Verificar si hay cursos activos
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $code = $row['code'];
                                    $descripcion = $row['descripcion'];
                                    $semestre = $row['semestre'];
                                    $nombre_docente = $row['nombre_docente'];
                                    
                                      // Determinar la URL según el nombre del curso
                                                                            $rutas = json_decode(file_get_contents("rutas.json"), true);
                                    // Determinar la URL según el nombre del curso
                                    $url = isset($rutas[$descripcion]) ? $rutas[$descripcion] : "#";
                                    // Generar la tarjeta para cada curso
                                    echo '
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">' . htmlspecialchars($descripcion) . '</div>
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Docente: ' . htmlspecialchars($nombre_docente) . '
                                                        </div>
                                                        <div class="text-xs text-gray-500">Código: ' . htmlspecialchars($code) . '</div>
                                                        <div class="text-xs text-gray-500">Semestre: ' . htmlspecialchars($semestre) . '</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="' . $url . '" class="btn btn-primary btn-icon-split">
                                                            <span class="text">Detalles</span>
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-arrow-right"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo "<div class='col-12'><p class='alert alert-info text-center'>No hay cursos activos disponibles.</p></div>";
                            }
                            
                            // Cerrar conexión
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->

                
            </div>
            <!-- Footer -->
            <?php include "footer.php" ?>
                <!-- End of Footer -->
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
    </body>
</html>