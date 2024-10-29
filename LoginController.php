<?php
session_start();

// Capturar los datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

// Conexión a la base de datos
include "conexion.php";

// Consulta SQL para obtener el usuario
$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$resultado = mysqli_query($conn, $consulta);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
    // Obtener la fila del usuario
    $fila = mysqli_fetch_assoc($resultado);

    // Verificar si se encontró el usuario
    if ($fila) {
        // Verificar si el usuario está activo
        if ($fila['id_estado'] == 2) {
            echo '<script>alert("No tienes permisos para acceder a esta página. Este usuario está inactivo.");
            location.href = "login.html";</script>';
        } else {
            // Hash de la contraseña desde la base de datos
            $contraseña_hash = $fila['contraseña'];

            // Verificar si la contraseña ingresada coincide con el hash
            if (password_verify($contraseña, $contraseña_hash)) {
                // Guardar sesión del usuario
                $_SESSION['usuario'] = $usuario;
                $_SESSION['idcargo'] = $fila['idcargo'];
                $_SESSION['id_estado'] = $fila['id_estado'];

                $idcargo = $_SESSION['idcargo'];

                // Redirigir según el cargo del usuario
                if ($idcargo == 1) {
                    header("location: admin/home-admin.php");
                } elseif ($idcargo == 2) {
                    header("location:students/index_student.php ");
                } elseif ($idcargo == 3) {
                    header("location: admin/home_teach.php");
                }
            } 
            echo $idcargo;
            // else {
            //     // Contraseña incorrecta
            //     echo '<script>alert("Contraseña incorrecta.");
            //     location.href = "login.html";</script>';
            // }
        }
    } else {
        // Usuario no encontrado
        echo '<script>alert("Usuario no encontrado.");
        location.href = "login.html";</script>';
    }
} else {
    // Error en la consulta SQL
    echo "Error en la consulta: " . mysqli_error($conn);
}

// Liberar resultados y cerrar conexión
mysqli_free_result($resultado);
mysqli_close($conn);
?>
