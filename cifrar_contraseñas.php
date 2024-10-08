<?php
include "conexion.php";

// Consulta para obtener usuarios con contraseñas no cifradas
$consulta = "SELECT id, contraseña FROM usuarios WHERE contraseña NOT LIKE '\$2y\$%'";
$resultado = mysqli_query($conn, $consulta);

if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $id = $fila['id'];
        $contraseña = $fila['contraseña'];

        // Cifra la contraseña
        $contraseña_cifrada = password_hash($contraseña, PASSWORD_DEFAULT);

        // Actualiza la contraseña cifrada en la base de datos
        $sql_update = "UPDATE usuarios SET contraseña = '$contraseña_cifrada' WHERE id = $id";
        $resultado_update = mysqli_query($conn, $sql_update);

        if (!$resultado_update) {
            echo "Error al actualizar la contraseña para el usuario con ID $id: " . mysqli_error($conn) . "<br>";
        }
    }

    echo "Proceso completado.";
} else {
    echo "Error al realizar la consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
