<?php
// Iniciar sesión al principio del archivo
session_start();

// Conexión a la base de datos
include "../conexion.php";

// Manejar la eliminación de estudiantes
if (isset($_GET['action']) && $_GET['action'] == 'delete_student' && isset($_GET['usuario']) && isset($_GET['code'])) {
    $usuario = $_GET['usuario'];
    $code = $_GET['code'];
    
    // Primero obtenemos el ID del estudiante
    $sql_get_id = "SELECT id FROM usuarios WHERE usuario = ?";
    $stmt_get_id = $conn->prepare($sql_get_id);
    $stmt_get_id->bind_param("s", $usuario);
    $stmt_get_id->execute();
    $result_get_id = $stmt_get_id->get_result();
    
    if ($result_get_id->num_rows > 0) {
        $row = $result_get_id->fetch_assoc();
        $student_id = $row['id'];
        
        // Eliminar al estudiante del curso
        $sql_delete = "DELETE FROM estudiante_curso WHERE usuario_id = ? AND course_code = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("is", $student_id, $code);
        
        if ($stmt_delete->execute()) {
            $_SESSION['mensaje'] = [
                'icon' => 'success',
                'title' => 'Estudiante eliminado',
                'text' => 'El estudiante ha sido eliminado del curso correctamente.'
            ];
        } else {
            $_SESSION['mensaje'] = [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No se pudo eliminar al estudiante del curso.'
            ];
        }
    } else {
        $_SESSION['mensaje'] = [
            'icon' => 'error',
            'title' => 'Error',
            'text' => 'No se encontró el estudiante especificado.'
        ];
    }
    
    // Redirigir para evitar reenvío del formulario
    header("Location: edit_course_admin.php?code=" . urlencode($code));
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Tutorías UPC - Gestión de Curso">
    <meta name="author" content="Universidad Popular del Cesar">

    <title>Gestión de Curso | Tutorías UPC</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        .modal-content {
            color: #000;
        }
        .modal-content select {
            color: #000;
            background-color: #fff;
        }
        .card-header-primary {
            background-color: #4e73df;
            color: white;
        }
        .status-card {
            border-left: 5px solid;
        }
        .status-active {
            border-left-color: #1cc88a;
        }
        .status-inactive {
            border-left-color: #e74a3b;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        .scrollable-table {
            max-height: 400px;
            overflow-y: auto;
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
                    <?php
                    // Conexión a la base de datos
                    include "../conexion.php";

                    // Obtener el código del curso desde los parámetros
                    if (isset($_GET['code'])) {
                        $code = $_GET['code'];
           
                        if (isset($_GET['action']) && $_GET['action'] == 'delete_student' && isset($_GET['usuario'])) {
                            $usuario = $_GET['usuario'];
                        
                            $sql_delete = "DELETE FROM estudiante_curso WHERE course_code = ? AND usuario_id = (SELECT id FROM usuarios WHERE usuario = ?)";
                            $stmt_delete = $conn->prepare($sql_delete);
                            $stmt_delete->bind_param("ss", $code, $usuario);
                        
                            if ($stmt_delete->execute()) {
                                $_SESSION['mensaje'] = [
                                    'icon' => 'success',
                                    'title' => 'Estudiante Eliminado',
                                    'text' => 'El estudiante ha sido eliminado del curso correctamente.'
                                ];
                            } else {
                                $_SESSION['mensaje'] = [
                                    'icon' => 'error',
                                    'title' => 'Error',
                                    'text' => 'Error al eliminar al estudiante del curso.'
                                ];
                            }
                        echo "<script>
                            Swal.fire({
                                icon: '" . $_SESSION['mensaje']['icon'] . "',
                                title: '" . $_SESSION['mensaje']['title'] . "',
                                text: '" . $_SESSION['mensaje']['text'] . "',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = window.location.pathname + '?code=" . $code . "';
                            });
                        </script>";
                            exit();
                        }

                        // Obtener nombre del curso para mostrar en el título
                       // Obtener nombre del curso para mostrar en el título
$sql_nombre = "SELECT nombre FROM courses WHERE code = ?"; // Cambia "nombre" por el nombre real de tu columna
$stmt_nombre = $conn->prepare($sql_nombre);
$stmt_nombre->bind_param("s", $code);
$stmt_nombre->execute();
$result_nombre = $stmt_nombre->get_result();
$row_nombre = $result_nombre->fetch_assoc();
$nombre_curso = $row_nombre['nombre']; // Asegúrate de que coincida con el nombre de la columna

echo '<h1 class="h3 mb-4 text-gray-800">Gestión del Curso: ' . htmlspecialchars($nombre_curso) . '</h1>';
                    } else {
                        // Si no se proporciona el código, mostrar mensaje de error
                        echo '<div class="alert alert-danger">No se proporcionó el código del curso.</div>';
                        exit;
                    }

                    // Verificar si se han recibido parámetros para cambiar el estado
                    if (isset($_GET['estado'])) {
                        $estado = $_GET['estado']; // 1 para activo, 2 para inactivo
                        
                        // Actualizar el estado del curso en la base de datos
                        $sql = "UPDATE courses SET id_estado = ? WHERE code = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ii", $estado, $code);
                        
                        if ($stmt->execute()) {
                            echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Estado actualizado',
                                    text: 'El estado del curso ha sido actualizado correctamente.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.href = window.location.pathname + '?code=" . $code . "';
                                });
                            </script>";
                        } else {
                            echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error al actualizar el estado del curso.'
                                });
                            </script>";
                        }
                    }

                    // Obtener el estado actual del curso
                    $sql = "SELECT id_estado FROM courses WHERE code = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $code);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $estado_actual = $row['id_estado'];
                    ?>

                    <div class="row">
                        <!-- Estado del Curso -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2 status-card <?php echo $estado_actual == 1 ? 'status-active' : 'status-inactive'; ?>">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                Estado Actual del Curso</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $estado_actual == 1 ? 'Activo' : 'Inactivo'; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas <?php echo $estado_actual == 1 ? 'fa-check-circle' : 'fa-times-circle'; ?> fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cambiar Estado -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cambiar estado</h6>
                                </div>
                                <div class="card-body text-center">
                                    <?php if ($estado_actual == 2): ?>
                                        <a href="?code=<?php echo $code; ?>&estado=1" class="btn btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Activar</span>
                                        </a>
                                    <?php else: ?>
                                        <a href="?code=<?php echo $code; ?>&estado=2" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <span class="text">Desactivar</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Estudiantes Matriculados -->
                        <div class="col-lg-8">
                            <div class="card shadow mb-4 card-management">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-users mr-2"></i>Estudiantes Matriculados
                                    </h6>
                                    <a href="enroll_student_course_admin.php?code=<?= urlencode($code) ?>" 
                                       class="btn btn-primary btn-sm action-btn">
                                        <i class="fas fa-user-plus mr-1"></i> Matricular Estudiante
                                    </a>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Consulta para obtener estudiantes
                                    $sql = "SELECT u.nombre, u.usuario, u.id_estado 
                                            FROM estudiante_curso ec
                                            JOIN usuarios u ON ec.usuario_id = u.id
                                            WHERE ec.course_code = ? AND u.idcargo = 2
                                            ORDER BY u.nombre";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("s", $code);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    
                                    if ($result->num_rows > 0) {
                                        echo '
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="studentsTable" width="100%" cellspacing="0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Usuario</th>
                                                        <th>Estado</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                        
                                        while ($row = $result->fetch_assoc()) {
                                            echo '
                                            <tr>
                                                <td>'.htmlspecialchars($row['nombre']).'</td>
                                                <td>'.htmlspecialchars($row['usuario']).'</td>
                                                <td>
                                                    <span class="badge '.($row['id_estado'] == 1 ? 'badge-success' : 'badge-secondary').' status-badge">
                                                        '.($row['id_estado'] == 1 ? 'Activo' : 'Inactivo').'
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="?code='.urlencode($code).'&action=delete_student&usuario='.urlencode($row['usuario']).'" 
                                                       class="btn btn-danger btn-sm action-btn delete-student" 
                                                       data-student-name="'.htmlspecialchars($row['nombre']).'">
                                                        <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                                    </a>
                                                </td>
                                            </tr>';
                                        }
                                        
                                        echo '
                                                </tbody>
                                            </table>
                                        </div>';
                                    } else {
                                        echo '<div class="alert alert-info text-center">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                No hay estudiantes matriculados en este curso.
                                              </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Docente Asignado -->
                        <div class="col-lg-4 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Docente Asignado</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Consultar el docente asignado al curso
                                    $sql_docente = "SELECT u.nombre, u.usuario, u.id_estado 
                                                  FROM docente_curso dc 
                                                  JOIN usuarios u ON dc.docente_id = u.id 
                                                  WHERE dc.course_code = ? AND u.idcargo = 3";
                                    $stmt = $conn->prepare($sql_docente);
                                    $stmt->bind_param("s", $code);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0):
                                        $row = $result->fetch_assoc(); ?>
                                        <div class="mb-4">
                                            <h5 class="font-weight-bold"><?php echo htmlspecialchars($row['nombre']); ?></h5>
                                            <p class="mb-1"><strong>Usuario:</strong> <?php echo htmlspecialchars($row['usuario']); ?></p>
                                            <p>
                                                <strong>Estado:</strong> 
                                                <span class="badge badge-<?php echo $row['id_estado'] == 1 ? 'success' : 'danger'; ?>">
                                                    <?php echo $row['id_estado'] == 1 ? 'Activo' : 'Inactivo'; ?>
                                                </span>
                                            </p>
                                        </div>
                                        
                                        <div class="d-flex flex-column">
                                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#asignarDocenteModal">
                                                <i class="fas fa-chalkboard-teacher"></i> Cambiar Docente
                                            </button>
                                            
                                            <form id="formEliminarDocente" action="eliminar_docente.php" method="POST">
                                                <input type="hidden" name="course_code" value="<?php echo htmlspecialchars($code); ?>">
                                                <button type="button" class="btn btn-danger w-100" onclick="confirmarEliminacion()">
                                                    <i class="fas fa-user-minus"></i> Quitar Docente
                                                </button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-warning mb-4">No hay docente asignado a este curso.</div>
                                        <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#asignarDocenteModal">
                                            <i class="fas fa-chalkboard-teacher"></i> Asignar Docente
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para asignar docente -->
                    <div class="modal fade" id="asignarDocenteModal" tabindex="-1" role="dialog" aria-labelledby="asignarDocenteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="asignarDocenteModalLabel">Asignar Docente al Curso</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="formAsignarDocente" method="POST" action="asignar_docente.php">
                                    <div class="modal-body">
                                        <input type="hidden" name="course_code" value="<?php echo htmlspecialchars($code); ?>">
                                        <div class="form-group">
                                            <label class="d-block mb-3">Seleccione un Docente:</label>
                                            <div class="border p-3" style="max-height: 300px; overflow-y: auto;">
                                                <div class="custom-control custom-radio">
                                                    <?php
                                                    // Obtener el docente actualmente asignado
                                                    $sql_actual = "SELECT docente_id FROM docente_curso WHERE course_code = ?";
                                                    $stmt_actual = $conn->prepare($sql_actual);
                                                    $stmt_actual->bind_param("s", $code);
                                                    $stmt_actual->execute();
                                                    $result_actual = $stmt_actual->get_result();
                                                    $docente_actual = $result_actual->fetch_assoc();
                                                    $docente_actual_id = $docente_actual ? $docente_actual['docente_id'] : null;
                                                    $stmt_actual->close();

                                                    // Consultar todos los docentes activos
                                                    $sql_lista = "SELECT DISTINCT u.id, u.nombre 
                                                                FROM usuarios u 
                                                                WHERE u.idcargo = 3 
                                                                AND u.id_estado = 1 
                                                                ORDER BY u.nombre";
                                                    $result_lista = $conn->query($sql_lista);

                                                    $counter = 0;
                                                    while($row = $result_lista->fetch_assoc()):
                                                        // Verificar si el docente está asignado a algún curso
                                                        $sql_asignado = "SELECT course_code FROM docente_curso WHERE docente_id = ?";
                                                        $stmt_asignado = $conn->prepare($sql_asignado);
                                                        $stmt_asignado->bind_param("i", $row['id']);
                                                        $stmt_asignado->execute();
                                                        $result_asignado = $stmt_asignado->get_result();
                                                        
                                                        $esta_asignado = $result_asignado->num_rows > 0;
                                                        $es_docente_actual = ($docente_actual_id == $row['id']);
                                                        
                                                        $texto_asignado = ($esta_asignado && !$es_docente_actual) ? ' (Asignado a otro curso)' : '';
                                                        $checked = $es_docente_actual ? 'checked' : '';
                                                        ?>
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="docente_<?php echo $counter; ?>" name="docente_id" 
                                                                   class="custom-control-input" value="<?php echo htmlspecialchars($row['id']); ?>" 
                                                                   <?php echo $checked; ?> required>
                                                            <label class="custom-control-label" for="docente_<?php echo $counter; ?>">
                                                                <?php echo htmlspecialchars($row['nombre']); ?>
                                                                <small class="text-muted"><?php echo htmlspecialchars($texto_asignado); ?></small>
                                                            </label>
                                                        </div>
                                                        <?php
                                                        $counter++;
                                                        $stmt_asignado->close();
                                                    endwhile;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Asignar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de Regreso -->
                    <div class="action-buttons">
                        <a href="gestion_cursos.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Regresar
                        </a>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Universidad Popular del Cesar - Seccional Aguachica <?php echo date('Y'); ?></span>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- SweetAlert2 JS -->
   <!-- Agregar el script de SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">

    <script>
        function confirmarEliminacion() {
    Swal.fire({
        title: "¿Está seguro?",
        text: "¿Desea eliminar la asignación del docente a este curso?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formEliminarDocente").submit();
        }
    });
}
    $(document).ready(function() {
        // Inicializar DataTable
        $('#studentsTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
        
        // Confirmación para eliminar estudiante
        $(document).on('click', '.delete-student', function(e) {
            e.preventDefault();
            const studentName = $(this).data('student-name');
            const deleteUrl = $(this).attr('href');
            
            Swal.fire({
                title: '¿Está seguro?',
                html: `¿Desea eliminar a <strong>${studentName}</strong> del curso?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });
        
        // Mostrar mensajes de éxito/error
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'success'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Operación exitosa',
                    text: 'La acción se realizó correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });
            <?php elseif ($_GET['status'] == 'error'): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al realizar la acción'
                });
            <?php endif; ?>
        <?php endif; ?>
    });
    </script>
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>

<?php if (isset($_SESSION['mensaje'])): ?>
<script>
    Swal.fire({
        icon: '<?= $_SESSION['mensaje']['icon'] ?>',
        title: '<?= $_SESSION['mensaje']['title'] ?>',
        text: '<?= $_SESSION['mensaje']['text'] ?>',
        showConfirmButton: false,
        timer: 2000
    });
</script>
<?php unset($_SESSION['mensaje']); endif; ?>

</body>
</html>
  