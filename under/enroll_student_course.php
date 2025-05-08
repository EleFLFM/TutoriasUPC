<?php session_start(); ?>
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include "sidebar_teacher.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include "topbar.php" ?>
                <!-- End of Topbar -->

                <?php
                // Conexión a la base de datos
                include "../conexion.php";

                // Verificar si hay mensaje de sesión
                // session_start();
                $message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
                unset($_SESSION['message']); // Limpiar el mensaje después de usarlo

                // Obtener el código del curso desde los parámetros
                if (!isset($_GET['code'])) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se proporcionó el código del curso.',
                                confirmButtonColor: '#4e73df'
                            }).then((result) => {
                                window.location = 'gestion_cursos.php';
                            });
                        });
                    </script>";
                    exit;
                }

                $code = $_GET['code'];

                // Procesar la solicitud de matrícula
                if (isset($_POST['student_id']) && isset($_POST['course_code'])) {
                    $studentId = $_POST['student_id'];
                    $courseCode = $_POST['course_code'];

                    // Verificar si el estudiante ya está matriculado
                    $sql_check = "SELECT 1 FROM estudiante_curso WHERE usuario_id = ? AND course_code = ?";
                    $stmt_check = $conn->prepare($sql_check);
                    $stmt_check->bind_param("is", $studentId, $courseCode);
                    $stmt_check->execute();
                    $result_check = $stmt_check->get_result();

                    if ($result_check->num_rows > 0) {
                        $_SESSION['message'] = [
                            'type' => 'warning',
                            'title' => 'Advertencia',
                            'text' => 'El estudiante ya está matriculado en el curso.'
                        ];
                    } else {
                        // Matricular al estudiante
                        $sql_enroll = "INSERT INTO estudiante_curso (usuario_id, course_code) VALUES (?, ?)";
                        $stmt_enroll = $conn->prepare($sql_enroll);
                        $stmt_enroll->bind_param("is", $studentId, $courseCode);

                        if ($stmt_enroll->execute()) {
                            $_SESSION['message'] = [
                                'type' => 'success',
                                'title' => '¡Éxito!',
                                'text' => 'El estudiante ha sido matriculado exitosamente.'
                            ];
                        } else {
                            $_SESSION['message'] = [
                                'type' => 'error',
                                'title' => 'Error',
                                'text' => 'Hubo un error al matricular al estudiante.'
                            ];
                        }
                        $stmt_enroll->close();
                    }
                    $stmt_check->close();

                    // Redireccionar para evitar reenvío del formulario
                    echo "<script>window.location.href = 'enroll_student_course.php?code=" . $code . "';</script>";
                    exit;
                }

                // Consultar estudiantes no matriculados
                $sql = "SELECT u.id, u.nombre, u.usuario 
                        FROM usuarios u
                        WHERE u.idcargo = 2 AND u.id_estado = 1
                        AND u.id NOT IN (
                            SELECT usuario_id 
                            FROM estudiante_curso
                            WHERE course_code = ?
                        )";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $code);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4" style="width: 80%;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Matricular estudiante</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="color: rgb(78, 115, 223);">
                                            <th>Nombre</th>
                                            <th>Usuario</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '
                                                <tr>
                                                    <td>' . htmlspecialchars($row['nombre']) . '</td>
                                                    <td>' . htmlspecialchars($row['usuario']) . '</td>
                                                    <td>
                                                        <form id="form_' . $row['id'] . '" method="post">
                                                            <input type="hidden" name="student_id" value="' . $row['id'] . '">
                                                            <input type="hidden" name="course_code" value="' . $code . '">
                                                            <button type="button" class="btn btn-primary btn-icon-split" onclick="confirmarMatricula(' . $row['id'] . ', \'' . htmlspecialchars($row['nombre'], ENT_QUOTES) . '\')">
                                                                <span class="icon text-white-50">
                                                                    <i class="fas fa-user-plus"></i>
                                                                </span>
                                                                <span class="text">Matricular</span>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="3">No hay estudiantes disponibles para matricular.</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <a href="edit_course_teacher.php?code=<?php echo $code ?>" class="btn btn-secondary btn-icon-split" style="left: 5%; position: relative;">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Regresar</span>
                    </a>

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

    <!-- Core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom page script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar DataTable
            $('#dataTable').DataTable();

            // Mostrar mensaje si existe
            <?php if (isset($message)): ?>
                Swal.fire({
                    icon: '<?php echo $message['type']; ?>',
                    title: '<?php echo $message['title']; ?>',
                    text: '<?php echo $message['text']; ?>',
                    confirmButtonColor: '#4e73df'
                });
            <?php endif; ?>
        });

        function confirmarMatricula(studentId, nombre) {
            Swal.fire({
                title: '¿Confirmar matrícula?',
                text: `¿Está seguro que desea matricular a ${nombre} en el curso?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Sí, matricular',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form_' + studentId).submit();
                }
            });
        }
    </script>
</body>

</html>