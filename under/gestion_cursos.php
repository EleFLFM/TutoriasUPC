<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tutorias UPC - Cursos</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Enhanced Custom Styles -->
    <style>
        .card.course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left-width: 4px !important;
        }
        .card.course-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }
        .course-card .course-title {
            font-size: 1.2rem;
            color: #5a5a5a;
        }
        .course-card .course-status {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 0.25rem;
        }
        .course-card .course-actions {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .course-card:hover .course-actions {
            opacity: 1;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar_admin.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topbar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row g-4">
                        <?php
                        include "../conexion.php";

                        $sql = "SELECT code, descripcion, semestre, id_estado FROM courses";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $code = $row['code'];
                                $descripcion = $row['descripcion'];
                                $semestre = $row['semestre'];
                                $estado = $row['id_estado'];
                                
                                $nombre_docente = "Sin asignar";
                                $consulta_docente = "SELECT u.nombre 
                                                     FROM docente_curso dc
                                                     JOIN usuarios u ON dc.docente_id = u.id
                                                     WHERE dc.course_code = ?";
                                $stmt = $conn->prepare($consulta_docente);
                                $stmt->bind_param("i", $code);
                                $stmt->execute();
                                $stmt->bind_result($nombre);
                                if ($stmt->fetch()) {
                                    $nombre_docente = $nombre;
                                }
                                $stmt->close();

                                $status_class = $estado == 1 ? 'border-success text-success' : 'border-danger text-danger';
                                $badge_class = $estado == 1 ? 'badge-success' : 'badge-danger';

                                echo '
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card course-card border-left-' . ($estado == 1 ? 'success' : 'danger') . ' shadow h-100">
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div>
                                                    <h5 class="course-title mb-2 font-weight-bold">' . htmlspecialchars($descripcion) . '</h5>
                                                    <span class="badge ' . $badge_class . ' course-status">
                                                        ' . ($estado == 1 ? 'Activo' : 'Inactivo') . '
                                                    </span>
                                                </div>
                                                <i class="fas fa-book-open text-gray-300 fa-2x"></i>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="text-xs font-weight-bold text-primary mb-2">
                                                    Docente: ' . htmlspecialchars($nombre_docente) . '
                                                </div>
                                                <div class="course-actions d-flex justify-content-between">
                                                    <a href="edit_course_admin.php?code=' . urlencode($code) . '" class="btn btn-info btn-sm">
                                                        <i class="fas fa-info-circle mr-1"></i>Detalles
                                                    </a>
                                                    <div class="btn-group" role="group">
                                                        <a href="edit_course_admin.php?code=' . urlencode($code) . '" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                         <button class="delete btn btn-danger btn-sm ml-1" data-code="' . $code . '">
                            <i class="fas fa-trash"></i> 
                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                        } else {
                            echo "<div class='alert alert-info text-center'>No hay cursos disponibles.</div>";
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
                <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar clics en los botones de eliminar
        document.querySelectorAll('.delete').forEach(button => {
            button.addEventListener('click', function() {
                const courseCode = this.getAttribute('data-code');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, redirige a delete_course.php
                        window.location.href = `../courses/delete_course.php?code=${courseCode}`;
                    }
                });
            });
        });

        // Mostrar alerta de éxito si existe en la sesión
        <?php if (isset($_SESSION['success'])): ?>
        Swal.fire({
            title: 'Éxito!',
            text: '<?php echo $_SESSION['success']; ?>',
            icon: 'success',
            confirmButtonText: 'Ok'
        });
        <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        // Mostrar alerta de error si existe en la sesión
        <?php if (isset($_SESSION['error'])): ?>
        Swal.fire({
            title: 'Error!',
            text: '<?php echo $_SESSION['error']; ?>',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    });
</script>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "footer.php" ?>
                <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

</body>
</html>