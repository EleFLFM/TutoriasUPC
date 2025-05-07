<?php
 session_start();

// // Verificar que el usuario está autenticado y tiene el rol de docente
// if (!isset($_SESSION['usuario_id'])) {
//     // Redirigir si no está autenticado
//     echo 'No autenticado';
//     exit();
// } else {
//     // Obtener el ID del docente desde la sesión
//     $estudiante_id = $_SESSION['usuario_id'];

//     echo '<script>alert("' . $estudiante_id . '");</script>'; 
    
// }

// ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tutorias UPC</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
         <?php
         include "sidebar_student.php"
         ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
             <div id="content">

                <!-- Topbar -->
                <?php
                include "topbar.php"
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    

                <div class="row">
                    

                        <!-- end curso -->

                       
<!-- Primer curso -->
<?php

include "../conexion.php";

// Verificar que el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    echo 'No autenticado';
    exit();
}

// Obtener el ID del estudiante desde la sesión
$estudiante_id = $_SESSION['usuario_id'];

// Consulta para obtener los cursos en los que está matriculado el estudiante
// Obtener los cursos a los que está matriculado el estudiante
$sql = "SELECT c.code, c.descripcion, c.semestre, c.id_estado, u.nombre 
        FROM courses c
        INNER JOIN estudiante_curso ec ON c.code = ec.course_code
        INNER JOIN usuarios u ON ec.usuario_id = u.id
        WHERE ec.usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $estudiante_id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el estudiante está matriculado en algún curso
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $code = $row['code'];
        $descripcion = $row['descripcion'];
        $semestre = $row['semestre'];
        $estado = $row['id_estado'];
        $nombre_docente = $row['nombre'];  // Nombre del docente

         // Determinar la URL según el nombre del curso
             $rutas = json_decode(file_get_contents("rutas.json"), true);
     // Determinar la URL según el nombre del curso
     $url = isset($rutas[$descripcion]) ? $rutas[$descripcion] : "#";
        // Generar la tarjeta para cada curso
        echo '
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Primer curso -->
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">' . htmlspecialchars($descripcion) . '</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                ' . htmlspecialchars($nombre_docente) . '
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="' . $url . '" class="btn btn-primary btn-icon-split">
                                <span class="text">Ir</span>
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end curso -->
        </div>';
    }
} else {
    echo "<p>No tienes cursos matriculados.</p>";
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Universidad Popular del Cesar - Seccional Aguachica 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <a class="btn btn-primary" href="../cerrar_sesion.php">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>