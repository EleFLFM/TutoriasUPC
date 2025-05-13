<?php
// eliminar_docente.php
include "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_code = $_POST['course_code'];
    
    // Eliminar la asignación del docente
    $sql = "DELETE FROM docente_curso WHERE course_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $course_code);
    
    // HTML completo con los scripts necesarios
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                <?php
                if ($stmt->execute()) {
                    ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Docente removido',
                        text: 'Se ha eliminado la asignación del docente correctamente.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = 'edit_course_admin.php?code=<?php echo $course_code; ?>';
                    });
                    <?php
                } else {
                    ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al eliminar la asignación del docente.'
                    }).then(() => {
                        window.location.href = 'edit_calculoi.php?code=<?php echo $course_code; ?>';
                    });
                    <?php
                }
                ?>
            });
        </script>
    </body>
    </html>
    <?php
    
    $stmt->close();
    $conn->close();
}
?>