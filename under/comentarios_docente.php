<?php
include "../conexion.php";

// Obtener lista de docentes
$docentes = mysqli_query($conn, "
    SELECT u.id, u.nombre 
    FROM usuarios u 
    INNER JOIN cargos c ON u.idcargo = c.id 
    WHERE c.nombre = 'Docente'
");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Comentarios a Docentes</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
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
                <div class="container-fluid mt-4">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Comentarios de estudiantes</h1>
                    </div>

                    <div class="row">
                        <?php while ($docente = mysqli_fetch_assoc($docentes)): ?>
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3" style="background-color:#198754;">
                                    <h6 class="m-0 font-weight-bold text-white">
                                        <i class="fas fa-chalkboard-teacher mr-2"></i>
                                        Docente: <?= htmlspecialchars($docente['nombre']) ?>
                                    </h6>
                                </div>
                                
                                <div class="card-body">
                                    <?php 
                                    $cursos = mysqli_query($conn, "
                                        SELECT DISTINCT c.code, c.descripcion AS nombre
                                        FROM comentarios_docentes cd
                                        INNER JOIN courses c ON cd.course_code = c.code
                                        WHERE cd.docente_id = {$docente['id']}
                                    ");
                                    
                                    while ($curso = mysqli_fetch_assoc($cursos)): 
                                        $promedio_result = mysqli_query($conn, "
                                            SELECT AVG(calificacion) AS promedio
                                            FROM comentarios_docentes
                                            WHERE docente_id = {$docente['id']} AND course_code = '{$curso['code']}'
                                        ");
                                        $promedio = mysqli_fetch_assoc($promedio_result)['promedio'];
                                    ?>
                                    <div class="mb-4">
                                        <button class="btn btn-light btn-block text-left d-flex justify-content-between align-items-center" 
                                                type="button" data-toggle="collapse"
                                                data-target="#curso<?= $docente['id'] ?>_<?= $curso['code'] ?>">
                                            <span>
                                                <i class="fas fa-book mr-2"></i>
                                                <?= htmlspecialchars($curso['nombre']) ?>
                                            </span>
                                            <span class="badge badge-primary">
                                                Promedio: <?= number_format($promedio, 2) ?>/5
                                            </span>
                                        </button>

                                        <div class="collapse mt-3" id="curso<?= $docente['id'] ?>_<?= $curso['code'] ?>">
                                            <div class="table-responsive">
                                              <!-- Dentro del while que muestra los comentarios, cambia la estructura de la tabla así: -->
<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th width="40%">Comentario</th>
            <th>Estudiante</th>
            <th class="w-25">Calificación</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $comentarios = mysqli_query($conn, "
            SELECT cd.*, c.nombre AS nombre_curso, u.nombre AS estudiante
            FROM comentarios_docentes cd
            INNER JOIN courses c ON cd.course_code = c.code
            INNER JOIN usuarios u ON cd.usuario_id = u.id
            WHERE cd.docente_id = {$docente['id']} AND cd.course_code = '{$curso['code']}'
            ORDER BY cd.fecha_creacion DESC
        ");
        
        while ($comentario = mysqli_fetch_assoc($comentarios)): 
        ?>
        <tr>
            <td><?= htmlspecialchars($comentario['comentario']) ?></td>
            <td><?= htmlspecialchars($comentario['estudiante']) ?></td>
            <td>
                <span class="badge badge-<?= $comentario['calificacion'] >= 3 ? 'success' : 'warning' ?>">
                    <?= $comentario['calificacion'] ?>/5
                </span>
            </td>
            <td><?= date('d/m/Y', strtotime($comentario['fecha_creacion'])) ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
                },
                "paging": true,
                "pageLength": 5,
                "lengthChange": false,
                "searching": true,
                "order": [[2, 'desc']]
            });
        });
    </script>
</body>
</html>