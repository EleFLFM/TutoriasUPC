<?php
session_start();

// Verificación de autenticación y rol docente
if (!isset($_SESSION['usuario_id']) || $_SESSION['idcargo'] != 3) {
    header('Location: ../login.php');
    exit();
}

include "../conexion.php";

// Obtener código del curso
if (!isset($_GET['code'])) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se proporcionó el código del curso'
        }).then(() => {
            window.location.href = 'teacher_courses.php';
        });
    </script>";
    exit;
}
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

    header("Location: edit_course_teacher.php?code=" . urlencode($code));
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Gestión de Curso - Tutorías UPC">
    <meta name="author" content="Universidad Popular del Cesar">
    
    <title>Gestión de Curso | Tutorías UPC</title>

    <!-- Fuentes y estilos -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        .card-management {
            border-left: 4px solid #4e73df;
            transition: all 0.3s ease;
        }
        .card-management:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .action-btn {
            border-radius: 20px;
            padding: 0.25rem 1rem;
            font-size: 0.85rem;
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .section-title {
            color: #4e73df;
            border-bottom: 2px solid #f8f9fc;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body id="page-top">

    <!-- Contenedor principal -->
    <div id="wrapper">

        <!-- Barra lateral -->
        <?php include "sidebar_teacher.php"; ?>

        <!-- Contenido principal -->
        <div id="content-wrapper" class="d-flex flex-column">
            
            <!-- Barra superior -->
            <?php include "topbar.php"; ?>

            <!-- Contenido de la página -->
            <div id="content">
                <div class="container-fluid px-4">
                    
                    <!-- Encabezado -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Gestión del Curso</h1>
                        <div>
                            <?php
                            // Obtener información básica del curso
                            $sql_curso = "SELECT descripcion, semestre FROM courses WHERE code = ?";
                            $stmt = $conn->prepare($sql_curso);
                            $stmt->bind_param("s", $code);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $curso = $result->fetch_assoc();
                            
                            echo '<span class="badge badge-primary mr-2">Código: '.htmlspecialchars($code).'</span>';
                            echo '<span class="badge badge-info mr-2">Semestre: '.htmlspecialchars($curso['semestre']).'</span>';
                            echo '<span class="font-weight-bold">'.htmlspecialchars($curso['descripcion']).'</span>';
                            ?>
                        </div>
                    </div>
                    
                    <!-- Sección de Estudiantes Matriculados -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="card shadow mb-4 card-management">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-users mr-2"></i>Estudiantes Matriculados
                                    </h6>
                                    <a href="enroll_student_course.php?code=<?= urlencode($code) ?>" 
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
                        
                        <!-- Sección de Docente Asignado -->
                        <div class="col-lg-4">
                            <div class="card shadow mb-4 card-management">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-chalkboard-teacher mr-2"></i>Docente Asignado
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Consultar docente asignado
                                    $sql_docente = "SELECT u.nombre, u.usuario, u.id_estado 
                                                  FROM docente_curso dc 
                                                  JOIN usuarios u ON dc.docente_id = u.id 
                                                  WHERE dc.course_code = ? AND u.idcargo = 3";
                                    $stmt = $conn->prepare($sql_docente);
                                    $stmt->bind_param("s", $code);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    
                                    if ($result->num_rows > 0) {
                                        $docente = $result->fetch_assoc();
                                        echo '
                                        <div class="text-center mb-3">
                                            <div class="rounded-circle bg-primary p-3 d-inline-block mb-2">
                                                <i class="fas fa-user-tie fa-2x text-white"></i>
                                            </div>
                                            <h5 class="font-weight-bold">'.htmlspecialchars($docente['nombre']).'</h5>
                                            <p class="text-muted mb-1">'.htmlspecialchars($docente['usuario']).'</p>
                                            <span class="badge '.($docente['id_estado'] == 1 ? 'badge-success' : 'badge-secondary').' status-badge">
                                                '.($docente['id_estado'] == 1 ? 'Activo' : 'Inactivo').'
                                            </span>
                                        </div>';
                                    } else {
                                        echo '<div class="alert alert-warning text-center">
                                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                                No hay docente asignado
                                              </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            
                            <!-- Sección de Acciones del Curso -->
                            
                        </div>
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

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Agregar el script de SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">

    <script>
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