<?php
// asignar_docente.php
include "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_code = $_POST['course_code'];
    $docente_id = $_POST['docente_id'];
    
    // Verificar si ya existe una asignación para este curso
    $sql_check = "SELECT id FROM docente_curso WHERE course_code = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $course_code);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    
    if ($result->num_rows > 0) {
        // Actualizar la asignación existente
        $sql = "UPDATE docente_curso SET docente_id = ? WHERE course_code = ?";
    } else {
        // Crear nueva asignación
        $sql = "INSERT INTO docente_curso (docente_id, course_code) VALUES (?, ?)";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $docente_id, $course_code);
    
    if ($stmt->execute()) {
        $mensaje = "success";
    } else {
        $mensaje = "error";
    }
    
    $stmt->close();
    $conn->close();
    
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
                if ('<?php echo $mensaje; ?>' === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Docente asignado',
                        text: 'El docente ha sido asignado correctamente al curso.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = 'edit_calculoi.php?code=<?php echo $course_code; ?>';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al asignar el docente al curso.'
                    }).then(() => {
                        window.location.href = 'edit_calculoi.php?code=<?php echo $course_code; ?>';
                    });
                }
            });
        </script>
    </body>
    </html>
    <?php
}
?>