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
         include "sidebar_admin.php"
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
                <?php
// Conexión a la base de datos
include "../conexion.php";

// Obtener el código del curso desde los parámetros
if (isset($_GET['code'])) {
    $code = $_GET['code'];
} else {
    // Si no se proporciona el código, puedes mostrar un mensaje de error o redirigir a otra página
    echo "No se proporcionó el código del curso.";
    exit;
}

// Manejar la eliminación de un estudiante del curso
if (isset($_GET['action']) && $_GET['action'] == 'delete_student' && isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    
    // Preparar la consulta para eliminar al estudiante del curso
    $sql_delete = "DELETE FROM estudiante_curso WHERE course_code = ? AND usuario_id = (SELECT id FROM usuarios WHERE usuario = ?)";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("ss", $code, $usuario);
    
    if ($stmt_delete->execute()) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Estudiante Eliminado',
                text: 'El estudiante ha sido eliminado del curso correctamente.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = window.location.pathname + '?code=" . $code . "';
            });
        </script>";
        exit;
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al eliminar al estudiante del curso.'
            });
        </script>";
        exit;
    }
}

// Verificar si se han recibido parámetros para cambiar el estado
if (isset($_GET['estado'])) {
    $estado = $_GET['estado']; // 1 para activo, 2 para inactivo
    
    // Actualizar el estado del curso en la base de datos
    $sql = "UPDATE courses SET id_estado = ? WHERE code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $estado, $code);
    
    if ($stmt->execute()) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js'></script>";
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
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js'></script>";
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

// Consulta para obtener los estudiantes matriculados en el curso
$sql = "SELECT u.nombre, u.usuario, u.id_estado 
        FROM estudiante_curso ec
        JOIN usuarios u ON ec.usuario_id = u.id
        WHERE ec.course_code = ? AND u.idcargo = 2";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Mostrar la tabla de estudiantes con opción de eliminar
    echo '
    <div class="card shadow mb-4" style="width: 80%;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Estudiantes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="color: rgb(78, 115, 223);">
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
            <td>' . htmlspecialchars($row['nombre']) . '</td>
            <td>' . htmlspecialchars($row['usuario']) . '</td>
            <td>' . ($row['id_estado'] == 1 ? 'Activo' : 'Inactivo') . '</td>
            <td>
                <a href="?code=' . urlencode($code) . '&action=delete_student&usuario=' . urlencode($row['usuario']) . '" 
                   class="btn btn-danger btn-sm delete-student" 
                   data-student-name="' . htmlspecialchars($row['nombre']) . '">
                    <i class="fas fa-trash"></i> 
                </a>
            </td>
        </tr>';
    }

    echo '
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".delete-student");
        
        deleteButtons.forEach(button => {
            button.addEventListener("click", function(e) {
                e.preventDefault();
                const studentName = this.getAttribute("data-student-name");
                const deleteUrl = this.getAttribute("href");
                
                Swal.fire({
                    title: "¿Está seguro?",
                    text: `¿Desea eliminar a ${studentName} del curso?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    });
    </script>';
} else {
    echo '<p>No hay estudiantes matriculados en este curso.</p>';
}
?>
<!-- Agregar el botón de matrícula -->
<?php
echo '
<div class="card shadow mb-4" style="width: 80%;">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Matrícula</h6>
    </div>
    <div class="card-body">
        <a href="enroll_student_course.php?code=' . $code . '" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Matricular estudiante</span>
        </a>
    </div>
</div>';
//SECCIÓN: Agregar la sección de docente asignado
echo '
<div class="card shadow mb-4" style="width: 80%;">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Docente Asignado</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive mb-3">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr style="color: rgb(78, 115, 223);">
                        <th>Nombre del Docente</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>';
                    
// Consultar el docente asignado al curso
$sql_docente = "SELECT u.nombre, u.usuario, u.id_estado 
              FROM docente_curso dc 
              JOIN usuarios u ON dc.docente_id = u.id 
              WHERE dc.course_code = ? AND u.idcargo = 3";
$stmt = $conn->prepare($sql_docente);
$stmt->bind_param("s", $code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<tr>
            <td>" . htmlspecialchars($row['nombre']) . "</td>
            <td>" . htmlspecialchars($row['usuario']) . "</td>
            <td>" . ($row['id_estado'] == 1 ? 'Activo' : 'Inactivo') . "</td>
        </tr>";
} else {
    echo "<tr><td colspan='3' class='text-center'>No hay docente asignado</td></tr>";
}

echo '          </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#asignarDocenteModal">
            <span class="icon text-white-50">
                <i class="fas fa-chalkboard-teacher"></i>
            </span>
            <span class="text">Asignar/Cambiar Docente</span>
        </button>
        ';
        
if ($result->num_rows > 0) {
    echo ' <form id="formEliminarDocente" action="eliminar_docente.php" method="POST" style="display: inline;">
                <input type="hidden" name="course_code" value="' . htmlspecialchars($code) . '">
                <button type="button" class="btn btn-danger btn-icon-split" onclick="confirmarEliminacion()">
                    <span class="icon text-white-50">
                        <i class="fas fa-user-minus"></i>
                    </span>
                    <span class="text">No Asignar Docente</span>
                </button>
            </form>';

} else {
    echo "";
}
$stmt->close();

          
            
   echo' </div>
</div>';


// Modal para asignar docente
echo '
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
                    <input type="hidden" name="course_code" value="' . htmlspecialchars($code) . '">
                    <div class="form-group">
                        <label class="d-block mb-3">Seleccione un Docente:</label>
                        <div class="border p-3" style="max-height: 300px; overflow-y: auto;">
                            <div class="custom-control custom-radio">';

// Consultar todos los docentes activos
$sql_lista = "SELECT DISTINCT u.id, u.nombre 
              FROM usuarios u 
              WHERE u.idcargo = 3 
              AND u.id_estado = 1 
              ORDER BY u.nombre";
$result_lista = $conn->query($sql_lista);

// Obtener el docente actualmente asignado
$sql_actual = "SELECT docente_id FROM docente_curso WHERE course_code = ?";
$stmt_actual = $conn->prepare($sql_actual);
$stmt_actual->bind_param("s", $code);
$stmt_actual->execute();
$result_actual = $stmt_actual->get_result();
$docente_actual = $result_actual->fetch_assoc();
$docente_actual_id = $docente_actual ? $docente_actual['docente_id'] : null;
$stmt_actual->close();

// Ahora listar todos los docentes como radio buttons
$counter = 0;
while($row = $result_lista->fetch_assoc()) {
    // Verificar si el docente está asignado a algún curso
    $sql_asignado = "SELECT course_code FROM docente_curso WHERE docente_id = ?";
    $stmt_asignado = $conn->prepare($sql_asignado);
    $stmt_asignado->bind_param("i", $row['id']);
    $stmt_asignado->execute();
    $result_asignado = $stmt_asignado->get_result();
    
    $esta_asignado = $result_asignado->num_rows > 0;
    $es_docente_actual = ($docente_actual_id == $row['id']);
    
    // Si el docente está asignado pero no es el docente actual del curso, agregar indicador
    $texto_asignado = ($esta_asignado && !$es_docente_actual) ? ' (Asignado a otro curso)' : '';
    
    // Seleccionar el docente actual del curso
    $checked = $es_docente_actual ? 'checked' : '';
    
    echo '<div class="custom-control custom-radio mb-2">
            <input type="radio" id="docente_' . $counter . '" name="docente_id" 
                   class="custom-control-input" value="' . htmlspecialchars($row['id']) . '" 
                   ' . $checked . ' required>
            <label class="custom-control-label" for="docente_' . $counter . '">
                ' . htmlspecialchars($row['nombre']) . 
                '<small class="text-muted">' . htmlspecialchars($texto_asignado) . '</small>
            </label>
          </div>';
    
    $counter++;
    $stmt_asignado->close();
}

echo '          </div>
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
</div>';
// Agregar la sección para cambiar el estado del curso
echo '
<div class="card shadow mb-4" style="width: 30%; left: 10%;">
    <div class="card-header py-3" style="background-color: rgb(58, 162, 86);">
        <h6 class="m-0 font-weight-bold" style="color: black;">Estado actual del curso</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                    <tr>
                        <td>
                            <center>
                                ' . ($estado_actual == 1 ? 'Activo' : 'Inactivo') . '
                            </center>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4" style="width: 400px; left: 10%;">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cambiar estado del curso</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                    <tr>
                        <td>
                            ' . ($estado_actual == 2 ? '
                            <a href="?code=' . $code . '&estado=1" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Activar</span>
                            </a>
                            ' : '
                            <a href="?code=' . $code . '&estado=2" class="btn btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-times"></i>
                                </span>
                                <span class="text">Desactivar</span>
                            </a>
                            ') . '
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>';

// Cerrar la conexión a la base de datos
$conn->close();
?>
<style>
    .modal-content {
    color: #000; /* Asegúrate de que el texto tenga un color oscuro para contrastar */
}
.modal-content select {
    color: #000; /* Color del texto de las opciones */
    background-color: #fff; /* Fondo claro para las opciones */
}

</style>
                <br>
                <a href="gestion_cursos.php" class="btn btn-secondary btn-icon-split" style="left: 5%; position: relative;">
                    <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Regresar</span>
                </a>
                <a href="#" class="btn btn-success btn-icon-split" style="left: 58%; position: relative;">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                   
                </a> 
                
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
</script>';
</body>

</html>