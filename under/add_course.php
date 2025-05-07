<?php
include "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = mysqli_real_escape_string($conn, $_POST["code"]);
    $nombre_curso = mysqli_real_escape_string($conn, $_POST["nombre_curso"]);
    $semestre = mysqli_real_escape_string($conn, $_POST["semestre"]);
    $docente_id = !empty($_POST["docente_id"]) ? mysqli_real_escape_string($conn, $_POST["docente_id"]) : null;

    // 1. Inserta el curso en la tabla courses
    $sql_curso = "INSERT INTO courses (code, descripcion, semestre, id_estado) VALUES ('$code', '$nombre_curso', '$semestre', 1)";

    if ($conn->query($sql_curso) === TRUE) {
        $curso_id = $conn->insert_id; // Obtiene el ID del curso recién insertado

        // 2. Si se seleccionó un docente, inserta la relación en docente_curso
        if ($docente_id) {
            $sql_docente_curso = "INSERT INTO docente_curso (docente_id, course_code) VALUES ('$docente_id', '$curso_id')";
            if ($conn->query($sql_docente_curso) === TRUE) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: '¡Éxito!',
                            html: '<b>Curso guardado exitosamente</b><br>El docente también ha sido asignado al curso.',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'create_curso.php';
                            }
                        });
                    });
                </script>";
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Error',
                            html: '<b>Error al asignar docente:</b><br>".str_replace("'", "\\'", $conn->error)."',
                            icon: 'error',
                            confirmButtonText: 'Entendido'
                        });
                    });
                </script>";
            }
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Curso guardado exitosamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'create_curso.php';
                        }
                    });
                });
            </script>";
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    html: '<b>Error al guardar el curso:</b><br>".str_replace("'", "\\'", $conn->error)."',
                    icon: 'error',
                    confirmButtonText: 'Entendido'
                });
            });
        </script>";
    }
}

$conn->close();
?>