<?php
session_start();

// Conexión a la base de datos
require_once "conexion.php";

// Capturar y sanitizar datos
$usuario = isset($_POST['usuario']) ? mysqli_real_escape_string($conn, $_POST['usuario']) : '';
$contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

if (empty($usuario) || empty($contraseña)) {
    mostrarError("Todos los campos son requeridos");
    exit();
}

// Usar consultas preparadas para prevenir SQL Injection
$consulta = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = mysqli_prepare($conn, $consulta);
mysqli_stmt_bind_param($stmt, "s", $usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    
    if ($fila) {
        // Debug - Comentar en producción
        error_log("Usuario encontrado - ID Estado: " . $fila['id_estado']);
        
        // Verificar estado del usuario
        if ($fila['id_estado'] == 2) {
            mostrarError("Usuario Inactivo", "No tienes permisos para acceder. Este usuario está inactivo.");
            exit();
        }
        
        // Verificar contraseña
        if (password_verify($contraseña, $fila['contraseña'])) {
            // Guardar datos en sesión
            $_SESSION['usuario'] = $usuario;
            $_SESSION['idcargo'] = $fila['idcargo'];
            $_SESSION['id_estado'] = $fila['id_estado'];
            
            // Redirigir según el cargo
            switch ($fila['idcargo']) {
                case 1:
                    header("Location: under/index_admin.php");
                    break;
                case 2:
                    header("Location: under/index_student.php");
                    break;
                case 3:
                    header("Location: under/index_teacher.php");
                    break;
                default:
                    mostrarError("Error", "Tipo de usuario no válido");
                    exit();
            }
        } else {
            mostrarError("Error", "Contraseña incorrecta");
        }
    } else {
        mostrarError("Error", "Usuario no encontrado");
    }
} else {
    mostrarError("Error", "Error en la consulta: " . mysqli_error($conn));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

// Función para mostrar errores usando SweetAlert2
function mostrarError($titulo, $mensaje = "") {
    echo '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: "error",
                title: "' . $titulo . '",
                text: "' . $mensaje . '",
                allowOutsideClick: false
            }).then((result) => {
                window.location.href = "login.html";
            });
        </script>
    </body>
    </html>';
}
?>