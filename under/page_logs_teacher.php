<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['idcargo'] != 3) {
    http_response_code(403);
    echo "Acceso denegado.";
    exit();
}

$docente_id = $_SESSION['usuario_id'];
include "../conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Tutorías UPC</title>

    <!-- Fonts y estilos -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- DataTables + Buttons -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include "sidebar_teacher.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "topbar.php"; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Registros de Ingreso por Curso</h1>

                    <?php
                    $query = "
                        SELECT c.code, c.descripcion AS nombre 
                        FROM docente_curso dc
                        JOIN courses c ON dc.course_code = c.code
                        WHERE dc.docente_id = ?
                    ";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $docente_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($curso = $result->fetch_assoc()) {
                        $course_code = $curso['code'];
                        $nombre_curso = $curso['nombre'];

                        echo "<div class='card shadow mb-4'>";
                        echo "<div style='background-color:#198754;' class='card-header bg py-3 d-flex justify-content-between align-items-center'>";
                        echo "<h6 class='m-0 font-weight-bold text-white'>Curso: " . htmlspecialchars($nombre_curso) . "</h6>";
                        echo "</div>";
                        echo "<div class='card-body'>";
                        echo "<div class='table-responsive'>";
                        echo "<table class='table dataTableCurso table-bordered tabla-ingresos' width='100%' cellspacing='0'>";
                        echo "<thead><tr><th>ID</th><th>Nombre del estudiante</th><th>Fecha de ingreso</th></tr></thead>";
                        echo "<tbody>";

                        $ingresos_query = "
                            SELECT ic.id, u.nombre, ic.fecha_ingreso
                            FROM ingresos_curso ic
                            JOIN usuarios u ON ic.usuario_id = u.id
                            WHERE ic.course_code = ?
                            ORDER BY ic.fecha_ingreso DESC
                        ";
                        $stmt2 = $conn->prepare($ingresos_query);
                        $stmt2->bind_param("s", $course_code);
                        $stmt2->execute();
                        $ingresos_result = $stmt2->get_result();

                        $hay_ingresos = false;
                        while ($row = $ingresos_result->fetch_assoc()) {
                            $hay_ingresos = true;
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['fecha_ingreso']) . "</td>";
                            echo "</tr>";
                        }

                        if (!$hay_ingresos) {
                            echo "<tr><td colspan='3'>No hay ingresos registrados para este curso.</td></tr>";
                        }

                        echo "</tbody></table></div></div></div>";

                        $stmt2->close();
                    }

                    $stmt->close();
                    $conn->close();
                    ?>
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Botones de exportación -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        $('.dataTableCurso').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success btn-sm',
                    text: '<i class="fas fa-file-excel"></i> Excel'
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger btn-sm',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    orientation: 'portrait',
                    pageSize: 'A4'
                },
                {
                    extend: 'print',
                    className: 'btn btn-info btn-sm',
                    text: '<i class="fas fa-print"></i> Imprimir'
                }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
            }
        });
    });
</script>
</body>

</html>
